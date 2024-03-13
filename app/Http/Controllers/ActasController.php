<?php

namespace App\Http\Controllers;

use App\Models\Actas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ActasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$id)
    {
        //$actas = Actas::all();

        $actas = DB::table('actas as a')
            ->join('users as u', 'u.id', '=', 'a.id_use')
            ->where('a.paterno_act', 'like', '%'.$request['buscar'].'%')
            ->select('a.*', 'u.*')
            ->paginate(5);


        return view('acta.index',compact('actas'),['id' => $id]);
    }

    public function indexCli(Request $request,$id)
    {
        //$actas = Actas::all();

        $actas = DB::table('actas as a')
            ->join('users as u', 'u.id', '=', 'a.id_use')
            ->where('a.id_use', '=', $id)
            ->where('a.paterno_act', 'like', '%'.$request['buscar'].'%')
            ->select('a.*', 'u.*')
            ->paginate(5);


        return view('acta.indexcli',compact('actas'),['id' => $id]);
    }

    public function pdf(Request $request)
    {
        

        $actas = DB::table('actas as a')
            ->join('users as u', 'u.id', '=', 'a.id_use')
            ->whereBetween(DB::raw('DATE(a.created_at)'), [$request['inicio'], $request['fin']])
            ->get();

        $pdf = Pdf::setPaper('a4','landscape')->loadView('acta.pdf', compact('actas'));
        return $pdf->stream();
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
        $cliente = DB::table('users as u')
        ->join('asignacions as a', 'u.id', '=', 'a.id_use')
        ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
        ->where('c.id_car', '=', 'CLIE')
        ->where('u.carnet', '=', $request['familiar'])
        ->orderBy('u.id')
        ->select('u.*', 'c.*')
        ->first();
        
        if($cliente==null){
            return 'mal';
        }else{


            $acta = new Actas;
            $acta->id_use = $cliente->id;
            $acta->nombres_act = $request['nombres'];
            $acta->paterno_act = $request['paterno'];
            $acta->materno_act = $request['materno'];
            $acta->edad_act = $request['edad'];
            $acta->partida_act = $request['partida'];
            $acta->provincia_act = $request['provincia'];
            $acta->departamento_act = $request['departamento'];
            $acta->pais_act = $request['pais'];
            $acta->causaMuerte_act = $request['causaMuerte'];
            $acta->drNombre_act = $request['nombreDr'];
            $acta->drPaterno_act = $request['paternoDr'];
            $acta->drMaterno_act = $request['maternoDr'];
            $acta->drCarnet_act = $request['carnetDr'];
            $acta->relacion_act = $request['relacion'];
            $acta->fosa_act = 1;
            $acta->estado_act = 1;
            $acta->save();
            return 'ok';
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Actas $actas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $cliente = DB::table('users as u')
        ->join('asignacions as a', 'u.id', '=', 'a.id_use')
        ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
        ->where('c.id_car', '=', 'CLIE')
        ->where('u.carnet', '=', $request['familiar'])
        ->orderBy('u.id')
        ->select('u.*', 'c.*')
        ->first();
        
        if($cliente==null){
            return 'mal';
        }else{
            
            $acta = Actas::find($request['id']);
            $acta->id_use = $cliente->id;
            $acta->nombres_act = $request['nombres'];
            $acta->paterno_act = $request['paterno'];
            $acta->materno_act = $request['materno'];
            $acta->edad_act = $request['edad'];
            $acta->partida_act = $request['partida'];
            $acta->provincia_act = $request['provincia'];
            $acta->departamento_act = $request['departamento'];
            $acta->pais_act = $request['pais'];
            $acta->causaMuerte_act = $request['causaMuerte'];
            $acta->drNombre_act = $request['nombreDr'];
            $acta->drPaterno_act = $request['paternoDr'];
            $acta->drMaterno_act = $request['maternoDr'];
            $acta->drCarnet_act = $request['carnetDr'];
            $acta->relacion_act = $request['relacion'];
            $acta->fosa_act = 1;
            $acta->estado_act = 1;
            $acta->save();
            return 'ok';
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actas $actas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actas $actas)
    {
        //
    }

    public function disabled($id)
    {
        $acta = Actas::find($id);
        $acta->estado_act = 0;
        $acta->save();
        return 'ok';
    }

    public function enabled($id)
    {
        $acta= Actas::find($id);
        $acta->estado_act = 1;
        $acta->save();
        return 'ok';
    }
}
