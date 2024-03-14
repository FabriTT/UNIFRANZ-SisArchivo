<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Exports\DocenteExport;
use App\Models\HistorialFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Nacionalidad;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DocenteController extends Controller
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
            ->join('nacionalidads', 'docentes.Id_nac', '=', 'nacionalidads.Id_nac')
            ->select('docentes.*', 'nacionalidads.Nombre_nac');


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

        return view('docente.index', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function banco(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes')
            ->leftjoin('bancos', 'docentes.Id_ban', '=', 'bancos.Id_ban')
            ->select('docentes.*', 'bancos.Nombre_ban');

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
        return view('docente.banco', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function formacion(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes');

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
        return view('docente.formacion', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function experiencia(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes');

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
        return view('docente.experiencia', compact('docentes', 'historiales', 'cantidadDocentes'));
    }

    public function clase_modelo(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('docentes');

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
        return view('docente.clase_modelo', compact('docentes', 'historiales', 'cantidadDocentes'));
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
            $fechaActual = Carbon::now();
            $docente = new Docente();
            // Obtener la fecha en formato 'Y-m-d'
            $fechaFormateada = $fechaActual->format('Y-m-d H-i');

            $nombres = $request->input('nombres');
            $paterno = $request->input('paterno');
            $materno = $request->input('materno');
            $nacimiento = $request->input('nacimiento');
            $carnet = $request->input('carnet');
            $vencimiento = $request->input('vencimiento');
            $ciudadania = $request->input('ciudadania');
            $sexo = $request->input('sexo');
            $direccion = $request->input('direccion');
            $correoPersonal = $request->input('correoPersonal');
            $correoCoorporativo = $request->input('correoCoorporativo');
            $telefonoPar = $request->input('telparticular');
            $celular = $request->input('celular');
            $fotocarnet = $request->file('fotocarnet');
            $fotonacimiento = $request->file('fotonacimiento');
            $nombresEmergencia = $request->input('nombresEmergencia');
            $paternoEmergencia = $request->input('paternoEmergencia');
            $maternoEmergencia = $request->input('maternoEmergencia');
            $gradoEmergencia = $request->input('gradoEmergencia');
            $celularEmergencia = $request->input('celularEmergencia');


            $carpetaDestino = 'public/' . strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet;

            // Crea la carpeta si no existe
            if (!Storage::exists($carpetaDestino)) {
                Storage::makeDirectory($carpetaDestino);
            }

            // Crea la carpeta CARNETS del docente
            if (!Storage::exists($carpetaDestino . '/FOTOCOPIAS DE CARNET')) {
                Storage::makeDirectory($carpetaDestino . '/FOTOCOPIAS DE CARNET');
            }

            // Crea la carpeta CERTI. NAC. del docente
            if (!Storage::exists($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO')) {
                Storage::makeDirectory($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO');
            }

            // Guarda el archivo en la carpeta destino con el nuevo nombre
            $fotocarnet->storeAs($carpetaDestino . '/FOTOCOPIAS DE CARNET', 'CARNET ' . $fechaFormateada . '.' . $fotocarnet->extension());
            $fotonacimiento->storeAs($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO', 'CERTIFICADO NACIMIENTO ' . $fechaFormateada . '.' . $fotonacimiento->extension());

            $docente = new Docente;
            $docente->Nombres_doc = ucwords(strtolower($nombres));
            $docente->Paterno_doc =  ucwords(strtolower($paterno));
            $docente->Materno_doc =  ucwords(strtolower($materno));
            $docente->Fecha_Nacimiento_doc = $nacimiento;
            $docente->Carnet_doc = $carnet;
            $docente->VencimientoCarnet_doc = $vencimiento;
            $docente->Id_nac = $ciudadania;
            $docente->Sexo_doc = $sexo;
            $docente->Direccion_doc = ucwords(strtolower($direccion));
            $docente->CorreoPersonal_doc = $correoPersonal;
            $docente->CorreoCoorporativo_doc = $correoCoorporativo;
            $docente->TelefonoParticular_doc = $telefonoPar;
            $docente->Celular_doc = $celular;
            $docente->Foto_Carnet_doc = strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet . '/FOTOCOPIAS DE CARNET/' . 'CARNET ' . $fechaFormateada . '.' . $fotocarnet->extension();
            $docente->Foto_Nacimiento_doc = strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet . '/CERTIFICADOS DE NACIMIENTO/' . 'CERTIFICADO NACIMIENTO ' . $fechaFormateada . '.' . $fotocarnet->extension();
            $docente->EmergenciaNombres_doc = ucwords(strtolower($nombresEmergencia));
            $docente->EmergenciaPaterno_doc = ucwords(strtolower($paternoEmergencia));
            $docente->EmergenciaMaterno_doc = ucwords(strtolower($maternoEmergencia));
            $docente->EmergenciaGrado_doc = $gradoEmergencia;
            $docente->EmergenciaCelular_doc = $celularEmergencia;
            $docente->Estado_doc = 1;
            $docente->save();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                $errorMessage = $e->getMessage();
                if (strpos($errorMessage, 'docentes.docentes_carnet_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el carnet que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_correopersonal_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el correo personal que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_correocoorporativo_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el correo coorporativo que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_telefonoparticular_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el telefono particular que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_celular_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el celular que ingreso';
                } else {
                    return 'Error en la bsae de datos';
                }
            } else {
                return 'Error en la bsae de datos'.$e;
            }
        }catch (Exception $e){
            Log::error($e);
            return 'Error en el servidor'.$e;
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $fechaActual = Carbon::now();

            // Obtener la fecha en formato 'Y-m-d'
            $fechaFormateada = $fechaActual->format('Y-m-d H-i');

            $nombres = $request->input('Modnombres');
            $paterno = $request->input('Modpaterno');
            $materno = $request->input('Modmaterno');
            $nacimiento = $request->input('Modnacimiento');
            $carnet = $request->input('Modcarnet');
            $vencimiento = $request->input('Modvencimiento');
            $ciudadania = $request->input('Modciudadania');
            $sexo = $request->input('Modsexo');
            $direccion = $request->input('Moddireccion');
            $correoPersonal = $request->input('ModcorreoPersonal');
            $correoCoorporativo = $request->input('ModcorreoCoorporativo');
            $telefonoPar = $request->input('Modtelparticular');
            $celular = $request->input('Modcelular');
            $fotocarnet = $request->file('Modfotocarnet');
            $fotonacimiento = $request->file('Modfotonacimiento');
            $nombresEmergencia = $request->input('ModnombresEmergencia');
            $paternoEmergencia = $request->input('ModpaternoEmergencia');
            $maternoEmergencia = $request->input('ModmaternoEmergencia');
            $gradoEmergencia = $request->input('ModgradoEmergencia');
            $celularEmergencia = $request->input('ModcelularEmergencia');

            $carpetaDestino = 'public/' . strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet;

            // Crea la carpeta si no existe
            if (!Storage::exists($carpetaDestino)) {
                Storage::makeDirectory($carpetaDestino);
            }

            // Crea la carpeta CARNETS del docente
            if (!Storage::exists($carpetaDestino . '/FOTOCOPIAS DE CARNET')) {
                Storage::makeDirectory($carpetaDestino . '/FOTOCOPIAS DE CARNET');
            }

            // Crea la carpeta CERTI. NAC. del docente
            if (!Storage::exists($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO')) {
                Storage::makeDirectory($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO');
            }

            if (isset($fotocarnet)) {
                $fotocarnet->storeAs($carpetaDestino . '/FOTOCOPIAS DE CARNET', 'CARNET ' . $fechaFormateada . '.' . $fotocarnet->extension());
            }

            if (isset($fotonacimiento)) {
                $fotonacimiento->storeAs($carpetaDestino . '/CERTIFICADOS DE NACIMIENTO', 'CERTIFICADO NACIMIENTO ' . $fechaFormateada . '.' . $fotonacimiento->extension());
            }

            $docente = Docente::find($request->input('id'));
            $docente->Nombres_doc = $nombres;
            $docente->Paterno_doc = $paterno;
            $docente->Materno_doc = $materno;
            $docente->Fecha_Nacimiento_doc = $nacimiento;
            $docente->Carnet_doc = $carnet;
            $docente->VencimientoCarnet_doc = $vencimiento;
            $docente->Id_nac = $ciudadania;
            $docente->Sexo_doc = $sexo;
            $docente->Direccion_doc = $direccion;
            $docente->CorreoPersonal_doc = $correoPersonal;
            $docente->CorreoCoorporativo_doc = $correoCoorporativo;
            $docente->TelefonoParticular_doc = $telefonoPar;
            $docente->Celular_doc = $celular;
            if ($fotocarnet !== null) {
                $docente->Foto_Carnet_doc = strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet . '/FOTOCOPIAS DE CARNET/' . 'CARNET ' . $fechaFormateada . '.' . $fotocarnet->extension();
            }

            if ($fotonacimiento !== null) {
                $docente->Foto_Nacimiento_doc = strtoupper($nombres) . " " . strtoupper($paterno) . " " . strtoupper($materno) . " " . $carnet . '/CERTIFICADOS DE NACIMIENTO/' . 'CERTIFICADO NACIMIENTO ' . $fechaFormateada . '.' . $fotonacimiento->extension();
            }

            $docente->EmergenciaNombres_doc = $nombresEmergencia;
            $docente->EmergenciaPaterno_doc = $paternoEmergencia;
            $docente->EmergenciaMaterno_doc = $maternoEmergencia;
            $docente->EmergenciaGrado_doc = $gradoEmergencia;
            $docente->EmergenciaCelular_doc = $celularEmergencia;
            $docente->Estado_doc = 1;
            $docente->save();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                $errorMessage = $e->getMessage();
                if (strpos($errorMessage, 'docentes.docentes_carnet_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el carnet que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_correopersonal_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el correo personal que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_correocoorporativo_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el correo coorporativo que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_telefonoparticular_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el telefono particular que ingreso';
                } elseif (strpos($errorMessage, 'docentes.docentes_celular_doc_unique') !== false) {
                    return 'Ya hay un docente registrado con el celular que ingreso';
                } else {
                    return 'Error en la bsae de datos';
                }
            } else {
                return 'Error en la bsae de datos';
            }
        }
    }

    public function editBanco(Request $request)
    {
        try {
            $fechaActual = Carbon::now();

            // Obtener la fecha en formato 'Y-m-d'
            $fechaFormateada = $fechaActual->format('Y-m-d H-i');
            $fechaFactura = $fechaActual->format('Y-m-d');

            $nombre = $request->input('Modnombre');
            $carnet = $request->input('Modcarnet');
            $cuenta = $request->input('Modcuenta');
            $banco = $request->input('Modbanco');
            $factura = $request->input('factura');
            $fotobanco = $request->file('Modfotobanco');


            $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

            // Crea la carpeta si no existe
            if (!Storage::exists($carpetaDestino)) {
                Storage::makeDirectory($carpetaDestino);
            }

            // Crea la carpeta BANCOS del docente
            if (!Storage::exists($carpetaDestino . '/CUENTAS BANCARIAS')) {
                Storage::makeDirectory($carpetaDestino . '/CUENTAS BANCARIAS');
            }

            if (isset($fotobanco)) {
                $fotobanco->storeAs($carpetaDestino . '/CUENTAS BANCARIAS', 'BANCO ' . $fechaFormateada . '.' . $fotobanco->extension());
            }

            $docente = Docente::where('Carnet_doc', $carnet)->first();
            $docente->NumeroCuenta_doc = $cuenta;
            $docente->Id_ban = $banco;

            $historialFactura = HistorialFactura::where('Id_doc', $docente->Id_doc)
                ->orderBy('created_at', 'DESC')
                ->take(1)
                ->first();



            if ($historialFactura) {
                if ($factura !== $historialFactura->Estado_hfac) {
                    //Completa campo
                    $historialFactura->FechaFin_hfac = $fechaFactura;
                    $historialFactura->save();
                    //Crea nuevo registro
                    $nuevoHistorial = new HistorialFactura;
                    $nuevoHistorial->FechaInicio_hfac = $fechaFactura;
                    $nuevoHistorial->Estado_hfac = $factura;
                    $nuevoHistorial->Id_doc = $docente->Id_doc;
                    $nuevoHistorial->save();
                }
            } else {
                $nuevoHistorial = new HistorialFactura;
                $nuevoHistorial->FechaInicio_hfac = $fechaFactura;
                $nuevoHistorial->Estado_hfac = $factura;
                $nuevoHistorial->Id_doc = $docente->Id_doc;
                $nuevoHistorial->save();
            }

            $docente->Factura_doc = $factura;
            if ($fotobanco !== null) {
                $docente->Foto_Cuenta_doc = strtoupper($nombre) . " " . $carnet . '/CUENTAS BANCARIAS/' . 'BANCO ' . $fechaFormateada . '.' . $fotobanco->extension();
            }
            $docente->save();
            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                return 'Ya existe un docente registrado con el numero de cuenta que ingreso';
            } else {
                return 'Error en la bsae de datos';
            }
        }
    }


    public function editFormacion(Request $request)
    {
        $fechaActual = Carbon::now();

        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');

        $nombre = $request->input('Modnombre');
        $carnet = $request->input('Modcarnet');
        $profesion = $request->input('Modprofesion');
        $fechatitulo = $request->input('Modfechatitulo');
        $fototitulo = $request->file('Modfototitulo');
        $grado = $request->input('Modgrado');
        $fechaprovision = $request->input('Modfechaprovision');
        $fotoprovision = $request->file('Modfotoprovision');
        $fechaeducacion = $request->input('Modfechaeducacion');
        $fotoeducacion = $request->file('Modfotoeducacion');


        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta BANCOS del docente
        if (!Storage::exists($carpetaDestino . '/TITULOS PROFESIONALES')) {
            Storage::makeDirectory($carpetaDestino . '/TITULOS PROFESIONALES');
        }

        if (!Storage::exists($carpetaDestino . '/PROVISIONES NACIONALES')) {
            Storage::makeDirectory($carpetaDestino . '/PROVISIONES NACIONALES');
        }

        if (!Storage::exists($carpetaDestino . '/TITULOS DE EDUCACION SUPERIOR')) {
            Storage::makeDirectory($carpetaDestino . '/TITULOS DE EDUCACION SUPERIOR');
        }

        if (isset($fototitulo)) {
            $fototitulo->storeAs($carpetaDestino . '/TITULOS PROFESIONALES', 'TITULO ' . $fechaFormateada . '.' . $fototitulo->extension());
        }
        if (isset($fotoprovision)) {
            $fotoprovision->storeAs($carpetaDestino . '/PROVISIONES NACIONALES', 'PROVISION NACIONAL ' . $fechaFormateada . '.' . $fotoprovision->extension());
        }
        if (isset($fotoeducacion)) {
            $fotoeducacion->storeAs($carpetaDestino . '/TITULOS DE EDUCACION SUPERIOR', 'EDUCACION SUPERIOR ' . $fechaFormateada . '.' . $fotoeducacion->extension());
        }

        $docente = Docente::where('Carnet_doc', $carnet)->first();
        $docente->Profesion_doc = $profesion;
        $docente->Fecha_titulo_doc = $fechatitulo;
        if ($fototitulo !== null) {
            $docente->Foto_titulo_doc = strtoupper($nombre) . " " . $carnet . '/TITULOS PROFESIONALES/' . 'TITULO ' . $fechaFormateada . '.' . $fototitulo->extension();
        }
        $docente->GradoAcademico_doc = $grado;
        $docente->Fecha_provision_nacional_doc = $fechaprovision;
        if ($fotoprovision !== null) {
            $docente->Foto_provision_nacional_doc = strtoupper($nombre) . " " . $carnet . '/PROVISIONES NACIONALES/' . 'PROVISION NACIONAL ' . $fechaFormateada . '.' . $fotoprovision->extension();
        }
        $docente->Fecha_educacion_superior_doc = $fechaeducacion;
        if ($fotoeducacion !== null) {
            $docente->Foto_educacion_superior_doc = strtoupper($nombre) . " " . $carnet . '/TITULOS DE EDUCACION SUPERIOR/' . 'EDUCACION SUPERIOR ' . $fechaFormateada . '.' . $fotoeducacion->extension();
        }
        $docente->save();
        return 'ok';
    }

    public function editExperiencia(Request $request)
    {
        $fechaActual = Carbon::now();

        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');

        $nombre = $request->input('Modnombre');
        $carnet = $request->input('Modcarnet');
        $fotocurriculum = $request->file('Modfotocurriculum');
        $años = $request->input('Modaños');
        $fotoexperiencia = $request->file('Modfotoexperiencia');


        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta EXPERIENCIA LABORAL del docente
        if (!Storage::exists($carpetaDestino . '/CURRICULUMS VITAE')) {
            Storage::makeDirectory($carpetaDestino . '/CURRICULUMS VITAE');
        }

        if (!Storage::exists($carpetaDestino . '/RESPALDOS DE EXPERIENCIA LABORAL')) {
            Storage::makeDirectory($carpetaDestino . '/RESPALDOS DE EXPERIENCIA LABORAL');
        }

        if (isset($fotocurriculum)) {
            $fotocurriculum->storeAs($carpetaDestino . '/CURRICULUMS VITAE', 'CURRICULUM VITAE ' . $fechaFormateada . '.' . $fotocurriculum->extension());
        }

        if (isset($fotoexperiencia)) {
            $fotoexperiencia->storeAs($carpetaDestino . '/RESPALDOS DE EXPERIENCIA LABORAL', 'RESPALDO EXPERIENCIA LABORAL ' . $fechaFormateada . '.' . $fotoexperiencia->extension());
        }

        $docente = Docente::where('Carnet_doc', $carnet)->first();
        if ($fotocurriculum !== null) {
            $docente->Foto_curriculum_doc = strtoupper($nombre) . " " . $carnet . '/CURRICULUMS VITAE/' . 'CURRICULUM VITAE ' . $fechaFormateada . '.' . $fotocurriculum->extension();
        }
        $docente->Años_experiencia_doc = $años;
        if ($fotoexperiencia !== null) {
            $docente->Foto_experiencia_doc = strtoupper($nombre) . " " . $carnet . '/RESPALDOS DE EXPERIENCIA LABORAL/' . 'RESPALDO EXPERIENCIA LABORAL ' . $fechaFormateada . '.' . $fotoexperiencia->extension();
        }
        $docente->save();
        return 'ok';
    }

    public function editClase_modelo(Request $request)
    {
        $fechaActual = Carbon::now();

        // Obtener la fecha en formato 'Y-m-d'
        $fechaFormateada = $fechaActual->format('Y-m-d H-i');

        $nombre = $request->input('Modnombre');
        $carnet = $request->input('Modcarnet');
        $fechaclase = $request->input('Modfechaclase');
        $fotoclase = $request->file('Modfotoclase');
        $fechaevaluar = $request->input('Modfechaevaluar');
        $fotoevaluar = $request->file('Modfotoevaluar');
        $calificacion = $request->input('Modcalificacion');


        $carpetaDestino = 'public/' . strtoupper($nombre) . " " . $carnet;

        // Crea la carpeta si no existe
        if (!Storage::exists($carpetaDestino)) {
            Storage::makeDirectory($carpetaDestino);
        }

        // Crea la carpeta CLASE MODELO del docente
        if (!Storage::exists($carpetaDestino . '/CLASES MODELO')) {
            Storage::makeDirectory($carpetaDestino . '/CLASES MODELO');
        }

        if (!Storage::exists($carpetaDestino . '/RESPALDOS DE EVALUAR')) {
            Storage::makeDirectory($carpetaDestino . '/RESPALDOS DE EVALUAR');
        }

        if (isset($fotoclase)) {
            $fotoclase->storeAs($carpetaDestino . '/CLASES MODELO', 'CLASE MODELO ' . $fechaFormateada . '.' . $fotoclase->extension());
        }

        if (isset($fotoevaluar)) {
            $fotoevaluar->storeAs($carpetaDestino . '/RESPALDOS DE EVALUAR', 'EVALUAR ' . $fechaFormateada . '.' . $fotoevaluar->extension());
        }

        $docente = Docente::where('Carnet_doc', $carnet)->first();
        $docente->Fecha_clase_modelo_doc = $fechaclase;
        if ($fotoclase !== null) {
            $docente->Foto_clase_modelo_doc = strtoupper($nombre) . " " . $carnet . '/CLASES MODELO/' . 'CLASE MODELO ' . $fechaFormateada . '.' . $fotoclase->extension();
        }
        $docente->Fecha_evaluar_doc = $fechaevaluar;
        if ($fotoevaluar !== null) {
            $docente->Foto_evaluar_doc = strtoupper($nombre) . " " . $carnet . '/RESPALDOS DE EVALUAR/' . 'EVALUAR ' . $fechaFormateada . '.' . $fotoevaluar->extension();
        }
        $docente->Calificacion_evaluar_doc = $calificacion;
        $docente->save();
        return 'ok';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        //
    }

    public function historialCarnet(Request $request)
    {
        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/FOTOCOPIAS DE CARNET';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres con extensiones
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos con extensiones
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }


    public function historialNacimiento(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/CERTIFICADOS DE NACIMIENTO';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function historialCuenta(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/CUENTAS BANCARIAS';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function historialTitulo(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/TITULOS PROFESIONALES';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }


    public function historialProvision(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/PROVISIONES NACIONALES';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }


    public function historialEducacion(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/TITULOS DE EDUCACION SUPERIOR';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function historialCurriculum(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/CURRICULUMS VITAE';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function historialExperiencia(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/RESPALDOS DE EXPERIENCIA LABORAL';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function historialClaseModelo(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/CLASES MODELO';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }


    public function historialEvaluar(Request $request)
    {

        $carpeta = $request->input('carpeta');

        // Ruta completa al directorio de almacenamiento
        $rutaDirectorio = 'public/' . $carpeta . '/RESPALDOS DE EVALUAR';

        // Verifica que el directorio exista
        if (Storage::exists($rutaDirectorio)) {
            // Obtén la lista de archivos en el directorio
            $archivos = Storage::files($rutaDirectorio);

            // Puedes iterar sobre $archivos para obtener los nombres
            $infoArchivos = [];
            foreach ($archivos as $archivo) {
                $infoArchivo = pathinfo($archivo);
                $infoArchivos[] = [
                    'nombre' => $infoArchivo['filename'],
                    'extension' => $infoArchivo['extension']
                ];
            }

            // Devuelve la lista de nombres de archivos
            return response()->json(['archivos' => $infoArchivos]);
        } else {
            // El directorio no existe
            abort(404, 'Página no encontrada');
        }
    }

    public function borrarArchivo(Request $request)
    {
        $disco = 'public';
        $archivo = $request->input('archivo');
        if (Storage::disk($disco)->exists($archivo)) {
            // Borra el archivo
            Storage::disk($disco)->delete($archivo);

            return 'ok';
        } else {
            return 'error' . $archivo;
        }
    }

    public function export()
    {
        return Excel::download(new DocenteExport, 'docentes.xlsx');
    }

    public function pdf()
    {
        $docentes = Docente::all();
        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('docente.pdf', compact('docentes'));
        return $pdf->stream();
    }

    public function buscarDocente(Request $request)
    {
        $docente = Docente::where('Carnet_doc', $request->input('carnet'))->get();
        return response()->json(['docente' => $docente]);
    }
}
