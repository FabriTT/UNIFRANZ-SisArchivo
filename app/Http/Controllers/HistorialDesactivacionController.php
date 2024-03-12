<?php

namespace App\Http\Controllers;

use App\Models\HistorialDesactivacion;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialDesactivacionController extends Controller
{

    public function historial(Request $request)
    {

        $id = $request->input('id');
        $historiales = HistorialDesactivacion::where('Id_doc', $id)->get();
        return response()->json(['historiales' => $historiales]);
    }

    public function disabled(Request $request)
    {   
        $historial = new HistorialDesactivacion();
        $historial->Id_doc = $request->input('idDesactivacion');
        $historial->Motivo_des = $request->input('motivo');
        $historial->Clasificacion_des = $request->input('clasificacion');
        $historial->save();

        $docente = Docente::find( $request->input('idDesactivacion'));
        $docente->Estado_doc = 0;
        $docente->save();
        return 'ok';
    }

    public function enabled($id)
    {
        $docente= Docente::find($id);
        $docente->Estado_doc = 1;
        $docente->save();
        return 'ok';
    }

}
