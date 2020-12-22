<?php

namespace App\Http\Controllers;

use App\Purpose;
use App\Customer;
use App\AddCustomer;
use App\Dmform;
use App\Product;
use Carbon\Carbon;
use App\TakenProduct;
use App\Trigger;
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

        foreach ($dmform->products as $taken_product) {
            $product_name = $taken_product->product->name;
            $product_stock = $taken_product->product->stock;
            if($taken_product->qty > $product_stock) return back()->withError("The product '$product_name' does not have enough stock. Only has $product_stock units.");
        }

        foreach ($dmform->products as $taken_product) {
            $taken_product->product->stock -= $taken_product->qty;
            $taken_product->product->save();

            if ($taken_product->product->product_category_id == 7 || $taken_product->product->product_category_id == 8) {
                $message = 'IGNORE (VITROX Item)';
                Dmform::where('id', $dmform->id)->update([
                    'status' => $message,
                ]);
            }
        }

        if($dmform->purpose_id == 10 || $dmform->purpose_id == 9) {
            $message = 'IGNORE (PURCHASING/CHECK STOCK)';
            Dmform::where('id', $dmform->id)->update([
                'status' => $message,
            ]);
        }

        Trigger::where('id', '1')->update([ 'value' => '1', ]);
        $dmform->total_qty = $dmform->products->sum('total_qty');
        $dmform->finalized_at = Carbon::now()->toDateTimeString();
        $dmform->save();
       
        return back()->withStatus('The DM has been successfully completed.');
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

    public function editproduct(Dmform $dmform, TakenProduct $takenproduct)
    {
        $products = Product::all();

        return view('dmform.editproduct', compact('dmform', 'takenproduct', 'products'));
    }

    public function updateproduct(Request $request, Dmform $dmform, TakenProduct $takenproduct)
    {
        
        $takenproduct->update($request->all());

        return redirect()->route('dmform.show', $dmform)->withStatus('Product successfully modified.');
    }

    public function destroyproduct(Dmform $dmform, TakenProduct $takenproduct)
    {
        $takenproduct->delete();

        return back()->withStatus('The product has been disposed of successfully.');
    }

    public function addcustomer(Dmform $dmform)
    {
        $customers = Customer::all();

        return view('dmform.addcustomer', compact('dmform', 'customers'));
    }

    public function editcustomer(Dmform $dmform, AddCustomer $addcustomer)
    {
        $customers = Customer::all();

        return view('dmform.editcustomer', compact('dmform', 'addcustomer', 'customers'));
    }

    public function updatecustomer(Request $request, Dmform $dmform, AddCustomer $addcustomer)
    {
        
        $addcustomer->update($request->all());

        return redirect()->route('dmform.show', $dmform)->withStatus('Customer successfully modified.');
    }

    public function destroycustomer(Dmform $dmform, AddCustomer $addcustomer)
    {
        $addcustomer->delete();

        return back()->withStatus('The Customer has been disposed of successfully.');
    }

    public function storecustomer(Request $request, Dmform $dmform, AddCustomer $addCustomer)
    {


        $addCustomer->create($request->all());

        return redirect()
            ->route('dmform.show', ['dmform' => $dmform])
            ->withStatus('Customer successfully registered.');
    }

    


}

