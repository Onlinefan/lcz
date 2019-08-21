<?php

namespace App\Http\Controllers;

use App\Opening;
use Illuminate\Http\Request;

class OpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('openings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Opening::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opening  $openings
     * @return \Illuminate\Http\Response
     */
    public function show(Opening $openings)
    {
        return $openings;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function edit(Opening $opening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opening $opening)
    {
        if($opening->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opening $opening)
    {
        if($opening->delete()){
            return true;
        }
    }
}
