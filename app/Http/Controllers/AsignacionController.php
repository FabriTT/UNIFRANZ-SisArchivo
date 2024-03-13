<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexCli($id)
    {

        $clientes = DB::table('users as u')
                ->join('asignacions as a', 'u.id', '=', 'a.id_use')
                ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
                ->where('u.estado', '=', 1)
                ->where('c.id_car', '=', 'CLIE')
                ->orderBy('u.id')
                ->select('u.*', 'a.*', 'c.*')
                ->paginate(5);


        return view('usuario.indexCli',compact('clientes'),['id' => $id]);
    }

    public function indexEmp($id)
    {

        $empleados = DB::table('users as u')
                ->join('asignacions as a', 'u.id', '=', 'a.id_use')
                ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
                ->where('u.estado', '=', 1)
                ->where('c.id_car', '<>', 'CLIE')
                ->orderBy('u.id')
                ->select('u.*', 'a.*', 'c.*')
                ->paginate(5);


        return view('usuario.indexEmp',compact('empleados'),['id' => $id]);
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

    public function storeCli(Request $request)
    {   

        $cliente = User::select('users.*')
        ->join('asignacions', 'users.id', '=', 'asignacions.id_use')
        ->join('cargos', 'asignacions.id_car', '=', 'cargos.id_car')
        ->where('cargos.id_car', 'CLIE')
        ->where('users.carnet', $request['carnet'])
        ->first();

        if($cliente==null){
            $asig = new Asignacion;
            $asig->id_use = $request['id'];
            $asig->id_car = 'CLIE';
            $asig->estado_asi = 1;
            $asig->save();
            return 'ok';
            
        }else{
            return 'mal';
        }
                
    }

    public function storeEmp(Request $request)
    {   

        $empleado = User::select('users.*')
        ->join('asignacions', 'users.id', '=', 'asignacions.id_use')
        ->join('cargos', 'asignacions.id_car', '=', 'cargos.id_car')
        ->where('cargos.id_car','<>', 'CLIE')
        ->where('users.carnet', $request['carnet'])
        ->first();

        if($empleado==null){
            $asig = new Asignacion;
            $asig->id_use = $request['id'];
            $asig->id_car = $request['cargo'];
            $asig->estado_asi = 1;
            $asig->save();
            return 'ok';
            
        }else{
            return 'mal';
        }
                
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }

    public function disabledCli($id)
    {
        $asi = Asignacion::find($id);
        $asi->estado_asi = 0;
        $asi->save();
        return 'ok';
    }

    public function enabledCli($id)
    {
        $asi = Asignacion::find($id);
        $asi->estado_asi = 1;
        $asi->save();
        return 'ok';
    }

    public function disabledEmp($id)
    {
        $asi = Asignacion::find($id);
        $asi->estado_asi = 0;
        $asi->save();
        return 'ok';
    }

    public function enabledEmp($id)
    {
        $asi = Asignacion::find($id);
        $asi->estado_asi = 1;
        $asi->save();
        return 'ok';
    }
}
