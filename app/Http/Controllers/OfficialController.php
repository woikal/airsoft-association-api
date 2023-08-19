<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreofficialRequest;
use App\Http\Requests\UpdateofficialRequest;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreofficialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreofficialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Official $official
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Official $official
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateofficialRequest $request
     * @param \App\Models\Official                      $official
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateofficialRequest $request, Official $official)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Official $official
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
        //
    }
}
