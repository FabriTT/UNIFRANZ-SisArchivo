<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidad;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nacionalidades = Nacionalidad::all();
        return response()->json(['nacionalidades' => $nacionalidades]);
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

        try {
            $nacionalidad = new Nacionalidad();
            $nacionalidad->Nombre_nac = ucwords($request->input('nacionalidad'));
            $nacionalidad->save();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                return 'Ya existe la nacionalidad '.ucwords($request->input('nacionalidad'));
            } else {
                return 'Error en la bsae de datos';
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nacionalidad $nacionalidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');
            $nacionalidad = Nacionalidad::find($id);
            $nacionalidad->delete();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return 'No se puede eliminar este registro porque algun docente esta registrado con esta nacionalidad';
            } else {
                return 'Error en la base de datos';
            }
        }
    }
}
