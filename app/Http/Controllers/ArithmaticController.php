<?php

namespace App\Http\Controllers;

use App\Arithmatic;
use Illuminate\Http\Request;

class ArithmaticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cit.arithmatic');
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
        print_r($request->first/$request->second);
        // print_r($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arithmatic  $arithmatic
     * @return \Illuminate\Http\Response
     */
    public function show(Arithmatic $arithmatic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arithmatic  $arithmatic
     * @return \Illuminate\Http\Response
     */
    public function edit(Arithmatic $arithmatic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arithmatic  $arithmatic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arithmatic $arithmatic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arithmatic  $arithmatic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arithmatic $arithmatic)
    {
        //
    }
}
