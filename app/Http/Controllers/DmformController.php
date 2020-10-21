<?php

namespace App\Http\Controllers;

use App\Purpose;
use App\Dmform;
use App\Product;
use Carbon\Carbon;
use App\TakenProduct;
use Illuminate\Http\Request;

class DmformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dmforms = Dmform::latest()->paginate(25);

        return view('dmform.index', compact('dmforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purposes = Purpose::all();

        return view('dmform.create', compact('purposes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dmform $model)
    {
        $existent = Dmform::where('purpose_id', $request->get('purpose_id'))->where('finalized_at', null)->get();

        if($existent->count()) {
            return back()->withError('There is already an unfinished form belonging to this purpose. <a href="'.route('dmform.show', $existent->first()).'">Click here to go to it</a>');
        }

        $dmform = $model->create($request->all());
        
        return redirect()
            ->route('dmform.show', ['dmform' => $dmform->id])
            ->withStatus('Purpose registered successfully, you can start registering products.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dmform $dmform)
    {
        return view('dmform.show', ['dmform' => $dmform]);
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
    public function destroy(Dmform $dmform)
    {
        $dmform->delete();

        return redirect()
        ->route('dmform.index')
        ->withStatus('The purpose record has been successfully deleted.');
    }

    public function finalize(Dmform $dmform)
    {
        $dmform->total_qty = $dmform->products->sum('total_qty');

        foreach ($dmform->products as $taken_product) {
            $product_name = $taken_product->product->name;
            $product_stock = $taken_product->product->stock;
            if($taken_product->qty > $product_stock) return back()->withError("The product '$product_name' does not have enough stock. Only has $product_stock units.");
        }

        foreach ($dmform->products as $taken_product) {
            $taken_product->product->stock -= $taken_product->qty;
            $taken_product->product->save();
        }

        $dmform->finalized_at = Carbon::now()->toDateTimeString();
      
        $dmform->save();
       

        return back()->withStatus('The dm has been successfully completed.');
    }


  public function addproduct(Dmform $dmform)
    {
        $products = Product::all();

        return view('dmform.addproduct', compact('dmform', 'products'));
    }

    public function storeproduct(Request $request, Dmform $dmform, TakenProduct $takenProduct)
    {

        $request->merge(['total_qty' => $request->get('qty')]);

        $takenProduct->create($request->all());

        return redirect()
            ->route('dmform.show', ['dmform' => $dmform])
            ->withStatus('Product successfully registered.');
    }

    public function editproduct(Dmform $dmform, TakenProduct $takenProduct)
    {
        $products = Product::all();

        return view('dmform.editproduct', compact('dmform', 'takenproduct', 'products'));
    }

    public function updateproduct(Request $request, Dmform $dmform, TakenProduct $takenProduct)
    {
        
        $takenproduct->update($request->all());

        return redirect()->route('dmform.show', $onsite)->withStatus('Product successfully modified.');
    }

    public function destroyproduct(Dmform $dmform, TakenProduct $takenProduct)
    {
        $takenproduct->delete();

        return back()->withStatus('The product has been disposed of successfully.');
    }

    


}

