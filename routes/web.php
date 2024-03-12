<?php

use App\Http\Controllers\BancoController;
use App\Http\Controllers\ContratoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocumentosComplementariosController;
use App\Http\Controllers\HistorialDesactivacionController;
use App\Http\Controllers\HistorialFacturaController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\TitulosComplementariosController;
use App\Http\Controllers\ZipController;
use App\Models\HistorialFactura;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[UserController::class, 'login'])->name('login');
Route::get('/recuperar',[UserController::class, 'recuperarContra'])->name('recuperar');
Route::post('/validarCorreo',[UserController::class, 'validarCorreo'])->name('validarCorreo');
Route::get('/validarCorreo', function (Request $request) {
    abort(404);
});
Route::post('/validarCodigo',[UserController::class, 'validarCodigo'])->name('validarCodigo');
Route::get('/validarCodigo', function (Request $request) {
    abort(404);
});
Route::post('/actualizarContraseña',[UserController::class, 'actualizarContraseña'])->name('actualizarContraseña');
Route::get('/actualizarContraseña', function (Request $request) {
    abort(404);
});
Route::post('/check',[UserController::class, 'check']);
Route::get('/check', function (Request $request) {
    abort(404);
});
Route::get('/sis/dashboard',[UserController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout',[UserController::class, 'logout']);


// Administrar usuarios
Route::get('/sis/usuario',[UserController::class, 'index'])->name('usuario')->middleware('can:usuario');
Route::post('/sis/usuario',[UserController::class, 'index'])->name('usuarioBuscar');
Route::post('/sis/usuario/store',[UserController::class, 'store'])->name('saveUsuario');
Route::get('/sis/usuario/store', function (Request $request) {
    abort(404);
});
Route::post('/sis/usuario/update',[UserController::class, 'edit'])->name('updateUsuario');
Route::get('/sis/usuario/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/usuario/disabled/{id}',[UserController::class, 'disabled'])->name('disabledUsuario')->middleware('can:usuario');
Route::get('/sis/usuario/enabled/{id}',[UserController::class, 'enabled'])->name('enabledUsuario')->middleware('can:usuario');
Route::get('/sis/usuario/export',[UserController::class, 'export'])->name('usuarioExport')->middleware('can:usuario');
Route::get('/sis/usuario/pdf',[UserController::class, 'pdf'])->name('usuarioPDF')->middleware('can:usuario');
Route::get('/sis/usuario/perfil',[UserController::class, 'perfil'])->name('perfil')->middleware('auth');
Route::get('/sis/usuario/editar',[UserController::class, 'editar'])->name('editar')->middleware('auth');
Route::post('/sis/usuario/actualizar',[UserController::class, 'actualizar'])->name('actualizarUsuario');
Route::get('/sis/usuario/actualizar', function (Request $request) {
    abort(404);
});


// Administrar docentes
Route::get('/sis/docente',[DocenteController::class, 'index'])->name('docente')->middleware('auth');
Route::post('/sis/docente',[DocenteController::class, 'index'])->name('docenteBuscar');
Route::post('/sis/docente/store',[DocenteController::class, 'store'])->name('saveDocente');
Route::get('/sis/docente/store', function (Request $request) {
    abort(404);
});
Route::post('/sis/docente/update',[DocenteController::class, 'edit'])->name('updateDocente');
Route::get('/sis/docente/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoCarnet',[DocenteController::class, 'historialCarnet'])->name('histoCarnet')->middleware('auth');
Route::post('/sis/docente/borrarCarnet',[DocenteController::class, 'borrarArchivo'])->name('borrarArchivo');
Route::get('/sis/docente/borrarCarnet', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoNacimiento',[DocenteController::class, 'historialNacimiento'])->name('histoNacimiento')->middleware('auth');
Route::get('/sis/docente/export',[DocenteController::class, 'export'])->name('docenteExport')->middleware('auth');
Route::get('/sis/docente/pdf',[DocenteController::class, 'pdf'])->name('docentePDF')->middleware('auth');
Route::post('/sis/docente/busqueda',[DocenteController::class, 'buscarDocente'])->name('buscarDocente');
Route::get('/sis/docente/busqueda', function (Request $request) {
    abort(404);
});

Route::get('/sis/nacionalidad',[NacionalidadController::class, 'index'])->name('nacionalidad')->middleware('auth');
Route::post('/sis/nacionalidad/store',[NacionalidadController::class, 'store'])->name('saveNacionalidad');
Route::get('/sis/nacionalidad/store', function (Request $request) {
    abort(404);
});
Route::post('/sis/nacionalidad/borrar',[NacionalidadController::class, 'destroy'])->name('borrarNacionalidad');
Route::get('/sis/nacionalidad/borrar', function (Request $request) {
    abort(404);
});

// Administrar bancos
Route::get('/sis/banco',[BancoController::class, 'index'])->name('mostrarBanco')->middleware('auth');
Route::post('/sis/banco/store',[BancoController::class, 'store'])->name('saveBanco');
Route::get('/sis/banco/store', function (Request $request) {
    abort(404);
});
Route::post('/sis/banco/borrar',[BancoController::class, 'destroy'])->name('borrarBanco');
Route::get('/sis/banco/borrar', function (Request $request) {
    abort(404);
});
Route::get('/sis/facturacion',[HistorialFacturaController::class, 'index'])->name('mostrarFacturacion')->middleware('auth');

Route::get('/sis/docente/banco',[DocenteController::class, 'banco'])->name('banco')->middleware('auth');
Route::post('/sis/docente/banco',[DocenteController::class, 'banco'])->name('bancoBuscar');
Route::post('/sis/docente/banco/update',[DocenteController::class, 'editBanco'])->name('updateBanco');
Route::get('/sis/docente/banco/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoCuenta',[DocenteController::class, 'historialCuenta'])->name('histoCuenta')->middleware('auth');


// Administrar formaicon academica
Route::get('/sis/docente/formacion',[DocenteController::class, 'formacion'])->name('formacion')->middleware('auth');
Route::post('/sis/docente/formacion',[DocenteController::class, 'formacion'])->name('formacionBuscar');
Route::post('/sis/docente/formacion/update',[DocenteController::class, 'editFormacion'])->name('updateFormacion');
Route::get('/sis/docente/formacion/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoTitulo',[DocenteController::class, 'historialTitulo'])->name('histoTitulo')->middleware('auth');
Route::get('/sis/docente/histoProvision',[DocenteController::class, 'historialProvision'])->name('histoProvision')->middleware('auth');
Route::get('/sis/docente/histoEducacion',[DocenteController::class, 'historialEducacion'])->name('histoEducacion')->middleware('auth');

// Administrar titulos
Route::get('/sis/docente/titulos',[TitulosComplementariosController::class, 'index'])->name('titulo')->middleware('auth');
Route::post('/sis/docente/titulos',[TitulosComplementariosController::class, 'index'])->name('tituloBuscar');
Route::get('/sis/docente/titulos/show',[TitulosComplementariosController::class, 'historial'])->name('historialTitulos')->middleware('auth');
Route::post('/sis/docente/titulos/save',[TitulosComplementariosController::class, 'store'])->name('saveTitulo');
Route::get('/sis/docente/titulos/save', function (Request $request) {
    abort(404);
});
Route::post('/sis/docente/titulos/borrar',[TitulosComplementariosController::class, 'borrar'])->name('borrarTitulo');
Route::get('/sis/docente/titulos/borrar', function (Request $request) {
    abort(404);
});

// Administrar experiencia
Route::get('/sis/docente/experiencia',[DocenteController::class, 'experiencia'])->name('experiencia')->middleware('auth');
Route::post('/sis/docente/experiencia',[DocenteController::class, 'experiencia'])->name('experienciaBuscar');
Route::post('/sis/docente/experiencia/update',[DocenteController::class, 'editExperiencia'])->name('updateExperiencia');
Route::get('/sis/docente/experiencia/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoCurriculum',[DocenteController::class, 'historialCurriculum'])->name('histoCurriculum')->middleware('auth');
Route::get('/sis/docente/histoExperiencia',[DocenteController::class, 'historialExperiencia'])->name('histoExperiencia')->middleware('auth');


// Administrar clase modelo
Route::get('/sis/docente/clase_modelo',[DocenteController::class, 'clase_modelo'])->name('clase_modelo')->middleware('auth');
Route::post('/sis/docente/clase_modelo',[DocenteController::class, 'clase_modelo'])->name('claseBuscar');
Route::post('/sis/docente/clase_modelo/update',[DocenteController::class, 'editClase_modelo'])->name('updateClase_modelo');
Route::get('/sis/docente/clase_modelo/update', function (Request $request) {
    abort(404);
});
Route::get('/sis/docente/histoClaseModelo',[DocenteController::class, 'historialClaseModelo'])->name('histoClaseModelo')->middleware('auth');
Route::get('/sis/docente/histoEvaluar',[DocenteController::class, 'historialEvaluar'])->name('histoEvaluar')->middleware('auth');


// Administrar documentos
Route::get('/sis/docente/documentos_complementarios',[DocumentosComplementariosController::class, 'index'])->name('documento_complementario')->middleware('auth');
Route::post('/sis/docente/documentos_complementarios',[DocumentosComplementariosController::class, 'index'])->name('documentoBuscar');
Route::get('/sis/docente/documentos_complementarios/show',[DocumentosComplementariosController::class, 'historial'])->name('historialDocumentos')->middleware('auth');
Route::post('/sis/docente/documentos_complementarios/save',[DocumentosComplementariosController::class, 'store'])->name('saveDocumento');
Route::get('/sis/docente/documentos_complementarios/save', function (Request $request) {
    abort(404);
});
Route::post('/sis/docente/documentos_complementarios/borrar',[DocumentosComplementariosController::class, 'borrar'])->name('borrarDocumento');
Route::get('/sis/docente/documentos_complementarios/borrar', function (Request $request) {
    abort(404);
});

// Administrar contratos
Route::get('/sis/contratos',[ContratoController::class, 'index'])->name('contrato')->middleware('auth');
Route::post('/sis/docente/contratos',[ContratoController::class, 'index'])->name('contratoBuscar');
Route::get('/sis/contratos/show',[ContratoController::class, 'historial'])->name('historialContratos')->middleware('auth');
Route::post('/sis/contratos/save',[ContratoController::class, 'store'])->name('saveContrato');
Route::get('/sis/contratos/save', function (Request $request) {
    abort(404);
});
Route::post('/sis/contratos/saveEvaluacion',[ContratoController::class, 'storeEvaluacion'])->name('saveEvaluacion');
Route::get('/sis/contratos/saveEvaluacion', function (Request $request) {
    abort(404);
});
Route::post('/sis/contratos/borrar',[ContratoController::class, 'borrar'])->name('borrarContrato');
Route::get('/sis/contratos/borrar', function (Request $request) {
    abort(404);
});
Route::get('/sis/export',[ContratoController::class, 'export'])->name('contratoExport')->middleware('auth');


// Administrar historial de desactivacion
Route::get('/sis/historial',[HistorialDesactivacionController::class, 'historial'])->name('historialDesactivacion')->middleware('auth');
Route::post('/sis/historial/store',[HistorialDesactivacionController::class, 'disabled'])->name('saveDesactivacion');
Route::get('/sis/historial/store', function (Request $request) {
    abort(404);
});
Route::get('/sis/historial/enabled/{id}',[HistorialDesactivacionController::class, 'enabled'])->name('enabledDocente')->middleware('can:enabledDocente');


// Administrar backup enabledDocente
Route::get('/sis/backup',[ZipController::class, 'createBackup'])->name('backup')->middleware('can:backup');