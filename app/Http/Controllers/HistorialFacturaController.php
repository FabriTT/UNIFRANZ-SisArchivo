<?php

namespace App\Http\Controllers;

use App\Models\HistorialFactura;
use Illuminate\Http\Request;

class HistorialFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $facturas = HistorialFactura::where('Id_doc', $request->input('id'))->get();
        return response()->json(['facturas' => $facturas]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialFactura $historialFactura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialFactura $historialFactura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialFactura $historialFactura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialFactura $historialFactura)
    {
        //
    }
}
