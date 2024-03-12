<?php

namespace App\Http\Controllers;

use App\Models\DocumentosComplementarios;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Docente;

class DocumentosComplementariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes')
        ->leftjoin('documentos_complementarios', 'documentos_complementarios.Id_doc', '=', 'docentes.Id_doc')
        ->select('docentes.*',  DB::raw('COUNT(documentos_complementarios.Id_com) as cantidad_de_documentos'))
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

        return view('docente.documentos_complementarios', compact('docentes', 'historiales', 'cantidadDocentes'));
    }


    public function historial(Request $request)
    {

        $carnet = $request->input('carnet');
        $historiales = DB::table('docentes')
            ->join('documentos_complementarios', 'documentos_complementarios.Id_doc', '=', 'docentes.Id_doc')
            ->select('docentes.*', 'documentos_complementarios.*')
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

        // Crea la carpeta DOCUMENTOS COMPLEMENTARIOS del docente
        if (!Storage::exists($carpetaDestino . '/DOCUMENTOS COMPLEMENTARIOS')) {
            Storage::makeDirectory($carpetaDestino . '/DOCUMENTOS COMPLEMENTARIOS');
        }

        if (isset($fotocopia)) {
            $fotocopia->storeAs($carpetaDestino . '/DOCUMENTOS COMPLEMENTARIOS', strtoupper($tipo)  . ' ' . strtoupper($descripcion)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension());
        }

        $docente = Docente::where('Carnet_doc', $carnet)->first();
        $titulo = new DocumentosComplementarios();
        $titulo->Tipo_com = ucwords(strtolower($tipo));
        $titulo->Descripcion_com = ucwords(strtolower($descripcion));
        $titulo->Fecha_com = $fecha;
        if ($fotocopia !== null) {
            $titulo->Fotocopia_com = strtoupper($nombre) . " " . $carnet . '/DOCUMENTOS COMPLEMENTARIOS/' . strtoupper($tipo)  . ' ' . strtoupper($descripcion)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension();
        }
        $titulo->Id_doc = $docente->Id_doc;
        $titulo->save();
        return 'ok';
    }

    public function borrar(Request $request)
    {

        $disco = 'public';
        $archivo = $request->input('archivo');
        $documento = DocumentosComplementarios::where('Fotocopia_com', $archivo)->first();
        if (Storage::disk($disco)->exists($archivo)) {


            Storage::disk($disco)->delete($archivo);
            $documento->delete();
            return 'ok';
        } else {
            return 'error' . $documento;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentosComplementarios $documentosComplementarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentosComplementarios $documentosComplementarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentosComplementarios $documentosComplementarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentosComplementarios $documentosComplementarios)
    {
        //
    }
}
