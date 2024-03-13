<?php

namespace App\Http\Controllers;

use App\Models\AlquilerNicho;
use App\Models\Nichos;
use App\Models\Actas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AlquilerNichoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function buscarCli(Request $request)
    {   
 
        $clientes = DB::table('users as u')
                ->join('asignacions as a', 'u.id', '=', 'a.id_use')
                ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
                ->join('actas as ac', 'ac.id_use', '=', 'u.id')
                ->where('u.carnet', '=', $request['carnet'])
                ->where('c.id_car', '=', 'CLIE')
                ->orderBy('u.id')
                ->select('u.*', 'c.*','ac.*')
                ->get();

        if($clientes==null){
            return 'mal';
        }else{
            return $clientes;
        }    
 
    }

    public function buscarEmp(Request $request)
    {   
 
        $empleado = DB::table('users as u')
                ->join('asignacions as a', 'u.id', '=', 'a.id_use')
                ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
                ->where('u.carnet', '=', $request['carnet'])
                ->where('c.id_car', '<>', 'CLIE')
                ->orderBy('u.id')
                ->select('u.*', 'c.*')
                ->first();

        if($empleado==null){
            return 'mal';
        }else{
            return $empleado;
        }    
 
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
        $buscar = DB::table('nichos as n')
                ->where('n.id_cua', '=', $request['cuartel'])
                ->where('n.piso_nic', '=', $request['piso'])
                ->where('n.fila_nic', '=', $request['fila'])
                ->where('n.columna_nic', '=', $request['columna'])
                ->first();

        $nicho = Nichos::find($buscar->id_nic);
        if($nicho->estado_nic == 1){
            return 'mal';
        }else{
            $nicho->estado_nic = 1;
            $nicho->save();
            
            $acta = Actas::find($request['familiar']);
            $acta->fosa_act =0;
            $acta->save();

            $alquiler = new AlquilerNicho;
            $alquiler->id_nic = $nicho->id_nic;
            $alquiler->id_cli = $request['cliente'];
            $alquiler->id_act = $request['familiar'];
            $alquiler->id_emp = $request['empleado'];
            $alquiler->id_alq = $request['alquiler'];
            $alquiler->estado_alni = 1;
            $alquiler->save();
            return 'ok';
        }
        
    }

    public function pdf(Request $request)
    {
        
        $actas = DB::table('actas as a')
            ->join('users as u', 'u.id', '=', 'a.id_use')
            ->get();

        $pdf = Pdf::setPaper('a4','landscape')->loadView('alquiler.certificado', compact('actas'));
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show(AlquilerNicho $alquilerNicho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlquilerNicho $alquilerNicho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AlquilerNicho $alquilerNicho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlquilerNicho $alquilerNicho)
    {
        //
    }
}
