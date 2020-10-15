<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Onsite;
use App\Product;
use Carbon\Carbon;
use App\TakenProduct;
use Illuminate\Http\Request;

class OnsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onsites = Onsite::latest()->paginate(25);

        return view('dmform.onsites.index', compact('onsites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();

        return view('dmform.onsites.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Onsite $model)
    {
        $existent = Onsite::where('customer_id', $request->get('customer_id'))->where('finalized_at', null)->get();

        if($existent->count()) {
            return back()->withError('There is already an unfinished form belonging to this customer. <a href="'.route('onsites.show', $existent->first()).'">Click here to go to it</a>');
        }

        $onsite = $model->create($request->all());
        
        return redirect()
            ->route('dmform.onsites.show', ['onsite' => $onsite->id])
            ->withStatus('Onsite registered successfully, you can start registering products and transactions.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Onsite $onsite)
    {
        return view('dmform.onsites.show', ['onsite' => $onsite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Onsite $onsite)
    {
        $onsite->delete();

        return redirect()
            ->route('dmform.onsites.index')
            ->withStatus('The onsite record has been successfully deleted.');
    }

    public function finalize(Onsite $onsite)
    {
        $onsite->total_qty = $onsite->products->sum('total_qty');

        foreach ($onsite->products as $taken_product) {
            $product_name = $taken_product->product->name;
            $product_stock = $taken_product->product->stock;
            if($taken_product->qty > $product_stock) return back()->withError("The product '$product_name' does not have enough stock. Only has $product_stock units.");
        }

        foreach ($onsite->products as $taken_product) {
            $taken_product->product->stock -= $taken_product->qty;
            $taken_product->product->save();
        }

        $onsite->finalized_at = Carbon::now()->toDateTimeString();
        $onsite->customer->balance -= $onsite->total_qty;
        $onsite->save();
        $onsite->customer->save();

        return back()->withStatus('The onsite has been successfully completed.');
    }


    public function addproduct(Onsite $onsite)
    {
        $products = Product::all();

        return view('dmform.onsites.addproduct', compact('onsite', 'products'));
    }

    public function storeproduct(Request $request, Onsite $onsite, TakenProduct $takenProduct)
    {

        $request->merge(['total_qty' => $request->get('qty')]);

        $takenProduct->create($request->all());

        return redirect()
            ->route('dmform.onsites.show', ['onsite' => $onsite])
            ->withStatus('Product successfully registered.');
    }

    public function editproduct(Onsite $onsite, TakenProduct $takenProduct)
    {
        $products = Product::all();

        return view('dmform.onsites.editproduct', compact('onsite', 'takenproduct', 'products'));
    }

    public function updateproduct(Request $request, Onsite $onsite, TakenProduct $takenProduct)
    {
        
        $takenproduct->update($request->all());

        return redirect()->route('dmform.onsites.show', $onsite)->withStatus('Product successfully modified.');
    }

    public function destroyproduct(Onsite $onsite, TakenProduct $takenProduct)
    {
        $takenproduct->delete();

        return back()->withStatus('The product has been disposed of successfully.');
    }

    


}
