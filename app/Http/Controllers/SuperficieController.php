<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuperficieRequest;
use App\Http\Requests\UpdateSuperficieRequest;
use App\Models\Superficie;

class SuperficieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuperficieRequest $request)
    {
        $tipo = $request->input('tipo');

        $superficie = new Superficie();
        $superficie->tipo = $tipo;
        $superficie->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Superficie $superficie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Superficie $superficie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuperficieRequest $request, Superficie $superficie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Superficie $superficie)
    {
        //
    }
}
