<?php

namespace App\Http\Controllers;

use App\Exports\ContratoExport;
use App\Models\Contrato;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Docente;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contratosVencidos = Contrato::where('Fecha_fin_con', '<', Carbon::now())->get();
        foreach ($contratosVencidos as $contrato) {
            $contrato->update(['Estado_con' => 0]);
        }
        

        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes')
        ->leftjoin('contratos', 'contratos.Id_doc', '=', 'docentes.Id_doc')
        ->select('docentes.*', DB::raw('COUNT(contratos.Id_con) as cantidad_de_contratos'))
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
        $historiales = DB::table('historial_desactivacions')->get();
        $cantidadDocentes = Docente::count();
        

        return view('docente.contratos', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function historial(Request $request)
    {

        $carnet = $request->input('carnet');
        $contratos = DB::table('docentes')
            ->join('contratos', 'contratos.Id_doc', '=', 'docentes.Id_doc')
            ->select('docentes.*', 'contratos.*')
            ->where('docentes.Carnet_doc', '=', $carnet)->get();

        return response()->json(['contratos' => $contratos]);
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
        $mensaje='<br>';
        $validado=1;
        $fechaActual = Carbon::now();

        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');

        $materia = $request->input('materia');
        $fecha = $request->input('fechaContrato');
        $fechafin = $request->input('fechaFinContrato');
        $fotocopia = $request->file('fotocopiaContrato');
        $carnet = $request->input('carnet');
        $nombre = $request->input('nombre');

        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta CONTRATOS del docente
        if (!Storage::exists($carpetaDestino . '/CONTRATOS')) {
            Storage::makeDirectory($carpetaDestino . '/CONTRATOS');
        }

        if (isset($fotocopia)) {
            $fotocopia->storeAs($carpetaDestino . '/CONTRATOS', 'CONTRATO ' . strtoupper($materia)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension());
        }
        
        $docente = Docente::where('Carnet_doc', $carnet)->first();
        
        if($docente->Foto_Carnet_doc==null){
            $validado=0;
            $mensaje='-El docente no cuenta con fotocopia de carnet<br>';
        }
        
        if($docente->Foto_Nacimiento_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con certificado de nacimiento<br>';
        }
        
        if($docente->Foto_Cuenta_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con fotocopia de numero de cuenta<br>';
        }
        if($docente->Foto_titulo_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con fotocopia titulo profesional<br>';
        }

        if($docente->Foto_provision_nacional_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con fotocopia tde provision nacional<br>';
        }

        if($docente->Foto_educacion_superior_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con fotocopia de educacion superior<br>';
        }

        if($docente->Foto_curriculum_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con curriculum vitae<br>';
        }

        if($docente->Foto_experiencia_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con respaldo de experiencia laboral<br>';
        }
        
        if($docente->Foto_clase_modelo_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con respaldo de la clase modelo<br>';
        }

        
        if($docente->Foto_evaluar_doc==null){
            $validado=0;
            $mensaje=$mensaje.'-El docente no cuenta con el evaluar<br>';
        }
        
        if($validado){
            $contrato = new Contrato();
            $contrato->Materia_con = strtoupper($materia);
            $contrato->Fecha_con = $fecha;
            $contrato->Fecha_fin_con = $fechafin;
            if ($fotocopia !== null) {
                $contrato->Foto_contrato_con = strtoupper($nombre) . " " . $carnet . '/CONTRATOS/' . 'CONTRATO ' . strtoupper($materia)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension();
            }
            $contrato->Id_doc = $docente->Id_doc;
            $contrato->Estado_con = 1;
            $contrato->save();
            return 'ok';
        }else{
            return $mensaje;
        }
        
    }


    public function storeEvaluacion(Request $request)
    {
        $fechaActual = Carbon::now();
        
        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');
        $disco = 'public';
        $id = $request->input('IdContrato');
        $calificacion = $request->input('calificacion');
        $fecha = $request->input('fechaEvaluacion');
        $fotocopia = $request->file('fotocopiaEvaluacion');
        $carnet = $request->input('carnet2');
        $nombre = $request->input('nombre2');
        $contrato = Contrato::where('Id_con', $id)->first();

        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta CONTRATOS del docente
        if (!Storage::exists($carpetaDestino . '/EVALUACIONES DOCENTE')) {
            Storage::makeDirectory($carpetaDestino . '/EVALUACIONES DOCENTE');
        }

        if($contrato->Foto_evaluacion_con !== null && $contrato->Foto_evaluacion_con !== ' '){
            Storage::disk($disco)->delete($contrato->Foto_evaluacion_con);
        }
        if (isset($fotocopia)) {
            $fotocopia->storeAs($carpetaDestino . '/EVALUACIONES DOCENTE', 'EVALUACION ' . strtoupper($contrato->Materia_con)  . ' ' . $fechaFormateada . '.' . $fotocopia->extension());
        }

        $contrato->Calificacion_evaluacion_con = $calificacion;
        $contrato->Fecha_evaluacion_con = $fecha;
        if ($fotocopia !== null) {
            $contrato->Foto_evaluacion_con = strtoupper($nombre) . " " . $carnet . '/EVALUACIONES DOCENTE/' . 'EVALUACION ' . strtoupper($contrato->Materia_con)   . ' ' . $fechaFormateada . '.' . $fotocopia->extension();
        }
        $contrato->save();
        return 'ok';
    }

    public function borrar(Request $request)
    {

        $disco = 'public';
        $id = $request->input('id');
        $contrato = Contrato::where('Id_con', $id)->first();
        if (Storage::disk($disco)->exists($contrato->Foto_contrato_con)) {
            Storage::disk($disco)->delete($contrato->Foto_contrato_con);
            if(!is_null($contrato->Foto_evaluacion_con)){
                if (Storage::disk($disco)->exists($contrato->Foto_evaluacion_con)) {
                    Storage::disk($disco)->delete($contrato->Foto_evaluacion_con);
                }
            }
            $contrato->delete();
            return 'ok';
        } else {
            return 'error' . $contrato;
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ContratoExport, 'docentes.xlsx');
    }
}
