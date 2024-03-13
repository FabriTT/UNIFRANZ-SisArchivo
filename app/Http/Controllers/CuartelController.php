<?php

namespace App\Http\Controllers;

use App\Models\Cuartel;
use App\Models\Nichos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CuartelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $cuarteles = DB::table('cuartels as c')
                ->paginate(5);

        return view('cuartel.index',compact('cuarteles'),['id' => $id]);
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
        $cuartel = new Cuartel;
        $cuartel->nombres_cua = $request['nombre'];
        $cuartel->tipoPersona_cua = $request['tipo'];
        $cuartel->descuento_cua = $request['descuento'];
        $cuartel->capacidad_cua = $request['pisos']*$request['nfilas']*$request['ncolumnas'];
        $cuartel->pisos_cua = $request['pisos'];
        $cuartel->nfilas_cua = $request['nfilas'];
        $cuartel->ncolumnas_cua = $request['ncolumnas'];
        $cuartel->latitud_cua = $request['latitud'];
        $cuartel->longitud_cua = $request['longitud'];
        $cuartel->sector_cua = $request['sector'];
        $cuartel->calle_cua = $request['calle'];
        $cuartel->estado_cua = 1;
        $cuartel->save();
        
        for ($p = $request['pisos']; $p >= 1; $p--){
            for ($i = $request['nfilas']; $i >= 1; $i--){
                for ($j = 1; $j <=$request['ncolumnas']; $j++){
                    $nicho = new Nichos;
                    $nicho->id_cua = $cuartel->id_cua;
                    $nicho->piso_nic = $p;
                    $nicho->fila_nic = $i;
                    $nicho->columna_nic = $j;
                    $nicho->estado_nic = 0;
                    $nicho->save();
                }
            }
        }

        return 'ok';
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuartel $cuartel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $cuartel = Cuartel::find($request['id']);
        $cuartel->nombres_cua = $request['nombre'];
        $cuartel->tipoPersona_cua = $request['tipo'];
        $cuartel->descuento_cua = $request['descuento'];
        $cuartel->latitud_cua = $request['latitud'];
        $cuartel->longitud_cua = $request['longitud'];
        $cuartel->sector_cua = $request['sector'];
        $cuartel->calle_cua = $request['calle'];
        $cuartel->estado_cua = 1;

        $cuartel->save();
        return 'ok';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuartel $cuartel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuartel $cuartel)
    {
        //
    }

    public function disabled($id)
    {
        $cuartel = Cuartel::find($id);
        $cuartel->estado_cua = 0;
        $cuartel->save();
        return 'ok';
    }

    public function enabled($id)
    {
        $cuartel = Cuartel::find($id);
        $cuartel->estado_cua = 1;
        $cuartel->save();
        return 'ok';
    }
}
