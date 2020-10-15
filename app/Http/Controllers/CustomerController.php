<?php

namespace App\Http\Controllers;


use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;


class CustomerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(25);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('customers.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CustomerRequest $request, Customer $customer)
    {
        $customer->create($request->all());
        
        return redirect()->route('customers.index')->withStatus('Successfully registered customer.');
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\CustomerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()
            ->route('customers.index')
            ->withStatus('Successfully modified customer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->withStatus('Customer successfully removed.');
    }

}
