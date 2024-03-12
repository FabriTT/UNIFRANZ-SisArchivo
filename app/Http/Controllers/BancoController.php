<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bancos = Banco::all();
        return response()->json(['bancos' => $bancos]);
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
            $banco = new Banco();
            $banco->Nombre_ban =  ucwords($request->input('banco'));
            $banco->save();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                return 'Ya esta registrado el ' . ucwords($request->input('banco'));
            } else {
                return 'Error en la bsae de datos';
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banco $banco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banco $banco)
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
            $banco = Banco::find($id);
            $banco->delete();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return 'No se puede eliminar este registro porque algun docente esta registrado con este banco';
            } else {
                return 'Error en la base de datos';
            }
        }
    }
}
