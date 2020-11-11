<?php

namespace App\Http\Controllers;

use App\Dmaddreturn;
use App\Purpose;
use App\Product;
use Carbon\Carbon;
use App\AddreturnProduct;
use Illuminate\Http\Request;

class DmaddreturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $dmaddreturns = Dmaddreturn::paginate(25);

        return view('dmaddreturns.index', compact('dmaddreturns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purposes = Purpose::all();

        return view('dmaddreturns.create', compact('purposes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dmaddreturn $dmaddreturn)
    {
        $dmaddreturn = $dmaddreturn->create($request->all());

        return redirect()
            ->route('dmaddreturns.show', $dmaddreturn)
            ->withStatus('DM registered successfully, you can start adding the products.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dmaddreturn $dmaddreturn)
    {
        return view('dmaddreturns.show', compact('dmaddreturn'));
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
    public function destroy(Dmaddreturn $dmaddreturn)
    {
        $dmaddreturn->delete();

        return redirect()
            ->route('dmaddreturns.index')
            ->withStatus('DM successfully removed.');
    }
/**
     * Finalize the dmaddreturn for stop adding products.
     *
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function finalize(Dmaddreturn $dmaddreturn)
    {
        $dmaddreturn->finalized_at = Carbon::now()->toDateTimeString();
        $dmaddreturn->save();

        foreach($dmaddreturn->products as $addreturnproduct) {
            $addreturnproduct->product->stock += $addreturnproduct->stock;
            $addreturnproduct->product->save();
        }

        return back()->withStatus('DM successfully completed.');
    }

    /**
     * Add product on dmaddreturn.
     *
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function addproduct(Dmaddreturn $dmaddreturn)
    {
        $products = Product::all();

        return view('dmaddreturns.addproduct', compact('dmaddreturn', 'products'));
    }

    /**
     * Add product on dmaddreturn.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function storeproduct(Request $request, Dmaddreturn $dmaddreturn, Addreturnproduct $addreturnproduct)
    {
        $addreturnproduct->create($request->all());

        return redirect()
            ->route('dmaddreturns.show', $dmaddreturn)
            ->withStatus('Product added successfully.');
    }

    /**
     * Editor product on dmaddreturn.
     *
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function editproduct(Dmaddreturn $dmaddreturn, Addreturnproduct $addreturnproduct)
    {
        $products = Product::all();

        return view('dmaddreturns.editproduct', compact('dmaddreturn', 'addreturnproduct', 'products'));
    }

    /**
     * Update product on dmaddreturn.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function updateproduct(Request $request, Dmaddreturn $dmaddreturn, Addreturnproduct $addreturnproduct)
    {
        $addreturnproduct->update($request->all());

        return redirect()
            ->route('dmaddreturns.show', $dmaddreturn)
            ->withStatus('Product edited successfully.');
    }

    /**
     * Add product on dmaddreturn.
     *
     * @param  dmaddreturn  $dmaddreturn
     * @return \Illuminate\Http\Response
     */
    public function destroyproduct(Dmaddreturn $dmaddreturn, Addreturnproduct $addreturnproduct)
    {
        $addreturnproduct->delete();

        return redirect()
            ->route('dmaddreturns.show', $dmaddreturn)
            ->withStatus('Product removed successfully.');
    }

    public function addcustomer(Dmaddreturn $dmaddreturn)
    {
        $customers = Customer::all();

        return view('dmaddreturn.addcustomer', compact('dmform', 'customers'));
    }

    public function storecustomer(Request $request, Dmaddreturn $dmaddreturn, AddCustomer $addCustomer)
    {


        $addCustomer->create($request->all());

        return redirect()
            ->route('dmaddreturn.show', ['dmaddreturn' => $dmaddreturn])
            ->withStatus('Customer successfully registered.');
    }


    
}

