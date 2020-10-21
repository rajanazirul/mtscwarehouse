<?php

namespace App\Http\Controllers;

use App\Purpose;
use Illuminate\Http\Request;
use App\Http\Requests\PurposeRequest;


class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purposes = Purpose::paginate(25);

        return view('purposes.index', compact('purposes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purposes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurposeRequest $request, Purpose $purpose)
    {
        $purpose->create($request->all());
        
        return redirect()->route('purposes.index')->withStatus('Successfully registered purpose.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purpose $purpose)
    {
        return view('purposes.show', compact('purpose'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purpose $purpose)
    {
        return view('purposes.edit', compact('purpose'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurposeRequest $request, Purpose $purpose)
    {
        $purpose->update($request->all());

        return redirect()
            ->route('purposes.index')
            ->withStatus('Successfully modified purpose.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purpose $purpose)
    {
        $purpose->delete();

        return redirect()
            ->route('purposes.index')
            ->withStatus('Purpose successfully removed.');
    }
}
