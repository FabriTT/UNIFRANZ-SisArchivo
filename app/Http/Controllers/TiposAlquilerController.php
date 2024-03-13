<?php

namespace App\Http\Controllers;

use App\Models\TiposAlquiler;
use App\Models\AlquilerNicho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class TiposAlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$id)
    {
        $alquileres = DB::table('tipos_alquilers as ta')
                ->paginate(5);

                $query = AlquilerNicho::query();

                $query->join('users as c', 'c.id', '=', 'alquiler_nichos.id_cli')
                    ->join('users as e', 'e.id', '=', 'alquiler_nichos.id_emp')
                    ->join('nichos as n', 'n.id_nic', '=', 'alquiler_nichos.id_nic')
                    ->join('cuartels as cu', 'cu.id_cua', '=', 'n.id_cua')
                    ->join('tipos_alquilers as ta', 'ta.id_alq', '=', 'alquiler_nichos.id_alq')
                    ->join('actas as a', 'a.id_act', '=', 'alquiler_nichos.id_act')
                    ->select('alquiler_nichos.*',
                    'c.name as c_name',
                    'c.paterno as c_paterno',
                    'c.materno as c_materno',
                    'a.*',
                    'cu.*',
                    'n.*',
                    'e.*',
                    'ta.*');
                
                $results = $query->paginate(5);

        return view('alquiler.index',compact('alquileres','results'),['id' => $id]);
    }

    public function indexCli(Request $request,$id)
    {

        $query = AlquilerNicho::query();

        $query->join('users as c', 'c.id', '=', 'alquiler_nichos.id_cli')
            ->join('users as e', 'e.id', '=', 'alquiler_nichos.id_emp')
            ->join('nichos as n', 'n.id_nic', '=', 'alquiler_nichos.id_nic')
            ->join('cuartels as cu', 'cu.id_cua', '=', 'n.id_cua')
            ->join('tipos_alquilers as ta', 'ta.id_alq', '=', 'alquiler_nichos.id_alq')
            ->join('actas as a', 'a.id_act', '=', 'alquiler_nichos.id_act')
            ->where('a.id_use', '=', $id)
            ->select('alquiler_nichos.*',
                  'c.name as c_name',
                  'c.paterno as c_paterno',
                  'c.materno as c_materno',
                  'a.*',
                  'cu.*',
                  'n.*',
                  'e.*',
                  'ta.*');
                
            $results = $query->paginate(5);

        return view('alquiler.indexcli',compact('results'),['id' => $id]);
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
        $alquiler = new TiposAlquiler;
        $alquiler->nombre_alq = $request['nombre'];
        $alquiler->descripcion_alq = $request['descripcion'];
        $alquiler->precio_alq = $request['precio'];
        $alquiler->duracion_alq = $request['duracion'];
        $alquiler->estado_alq = 1;

        $alquiler->save();
        return 'ok';
    }

    /**
     * Display the specified resource.
     */
    public function show(TiposAlquiler $tiposAlquiler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $alquiler = TiposAlquiler::find($request['id']);
        $alquiler->nombre_alq = $request['nombre'];
        $alquiler->descripcion_alq = $request['descripcion'];
        $alquiler->precio_alq = $request['precio'];
        $alquiler->duracion_alq = $request['duracion'];
        $alquiler->estado_alq = 1;

        $alquiler->save();
        return 'ok';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TiposAlquiler $tiposAlquiler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TiposAlquiler $tiposAlquiler)
    {
        //
    }

    public function disabled($id)
    {
        $alquiler = TiposAlquiler::find($id);
        $alquiler->estado_alq = 0;
        $alquiler->save();
        return 'ok';
    }

    public function enabled($id)
    {
        $alquiler = TiposAlquiler::find($id);
        $alquiler->estado_alq = 1;
        $alquiler->save();
        return 'ok';
    }
}
