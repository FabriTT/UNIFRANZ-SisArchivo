<?php

namespace App\Http\Controllers;

use App\Models\TitulosComplementarios;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Docente;

class TitulosComplementariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query= DB::table('docentes')
            ->leftjoin('titulos_complementarios', 'titulos_complementarios.Id_doc', '=', 'docentes.Id_doc')
            ->select('docentes.*',  DB::raw('COUNT(titulos_complementarios.Id_tit) as cantidad_de_titulos'))
            ->groupBy('docentes.Id_doc', 'docentes.Nombres_doc');



        if (!empty($dato)) {
            if ($filtro == 'Nombres y Apellidos') {
                $query->where(DB::raw("CONCAT(Nombres_doc, ' ', Paterno_doc, ' ', Materno_doc)"), 'LIKE', "%$dato%");
            } elseif ($filtro == 'Carnet') {
                $query->where(DB::raw("Carnet_doc"), 'LIKE', "%$dato%");
            }
        }

        // Aplicar paginación
        $docentes = $query->paginate($cantidad);
        $historiales = DB::table('historial_desactivacions')->get();;
        $cantidadDocentes = Docente::count();

        return view('docente.titulos_complementarios', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function historial(Request $request)
    {

        $carnet = $request->input('carnet');
        $historiales = DB::table('docentes')
            ->join('titulos_complementarios', 'titulos_complementarios.Id_doc', '=', 'docentes.Id_doc')
            ->select('docentes.*', 'titulos_complementarios.*')
            ->where('docentes.Carnet_doc', '=', $carnet)->get();

        return response()->json(['historiales' => $historiales]);
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
        $fechaActual = Carbon::now();

        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');

        $tipo = $request->input('tipo');
        $descripcion = $request->input('descripcion');
        $fecha = $request->input('fecha');
        $fotocopia = $request->file('fotocopia');
        $carnet = $request->input('carnet');
        $nombre = $request->input('nombre');

        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta TITULOS COMPLEMENTARIOS del docente
        if (!Storage::exists($carpetaDestino . '/TITULOS COMPLEMENTARIOS')) {
            Storage::makeDirectory($carpetaDestino . '/TITULOS COMPLEMENTARIOS');
        }

        if (isset($fotocopia)) {
            $fotocopia->storeAs($carpetaDestino . '/TITULOS COMPLEMENTARIOS', strtoupper($tipo)  . ' ' . strtoupper($descripcion)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension());
        }

        $docente = Docente::where('Carnet_doc', $carnet)->first();
        $titulo = new TitulosComplementarios();
        $titulo->Tipo_tit = ucwords(strtolower($tipo));
        $titulo->Descripcion_tit = ucwords(strtolower($descripcion));
        $titulo->Fecha_tit = $fecha;
        if ($fotocopia !== null) {
            $titulo->Fotocopia_tit = strtoupper($nombre) . " " . $carnet . '/TITULOS COMPLEMENTARIOS/' . strtoupper($tipo)  . ' ' . strtoupper($descripcion)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension();
        }
        $titulo->Id_doc = $docente->Id_doc;
        $titulo->save();
        return 'ok';
    }

    public function borrar(Request $request)
    {

        $disco = 'public';
        $archivo = $request->input('archivo');
        $titulo = TitulosComplementarios::where('Fotocopia_tit', $archivo)->first();
        if (Storage::disk($disco)->exists($archivo)) {


            Storage::disk($disco)->delete($archivo);
            $titulo->delete();
            return 'ok';
        } else {
            return 'error' . $titulo;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TitulosComplementarios $titulosComplementarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TitulosComplementarios $titulosComplementarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TitulosComplementarios $titulosComplementarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TitulosComplementarios $titulosComplementarios)
    {
        //
    }
}
