<?php

namespace App\Http\Controllers;

use App\Models\Nichos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class NichosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id,$cod)
    {
        $nichos = DB::table('cuartels as c')
                ->join('nichos as n', 'c.id_cua', '=', 'n.id_cua')
                ->where('c.id_cua', '=', $cod)
                ->orderBy('n.id_nic')
                ->select('c.*', 'n.*')
                ->get();

        $alquileres = DB::table('tipos_alquilers as ta')
                ->get();

            
        return view('cuartel.nichos',compact('nichos','alquileres'),['id' => $id]);
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
    public function show(Nichos $nichos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nichos $nichos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nichos $nichos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nichos $nichos)
    {
        //
    }
}
