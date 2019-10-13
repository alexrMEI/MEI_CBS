<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductFile;
use Illuminate\Http\Request;

class ProductFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ProductFile::all(), 200);
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
        $file = new ProductFile();
        $file->fill($request->all());
        $file->save();

        return response(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductFile  $file
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFile $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductFile  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductFile $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductFile  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFile $file)
    {
        $license->fill($request->all());
        $license->save();

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductFile  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductFile $file)
    {
        $license->delete();

        return response(null, 200);
    }
}
