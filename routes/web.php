<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ActasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\CuartelController;
use App\Http\Controllers\TiposAlquilerController;
use App\Http\Controllers\NichosController;
use App\Http\Controllers\AlquilerNichoController;

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

Route::get('/', function () {
    return view('inicio.index');
})->name('inicio');

Route::get('/log-in', function () {
    return view('login.index')->with('variable', 0);
})->name('login');


Route::get('/dashboard1/{id}', function ($id) {
    return view('dashboard.index1',['id' => $id]);
})->name('dashemp');


Route::get('/dashboard2/{id}', function ($id) {
    return view('dashboard.index2',['id' => $id]);
})->name('dashcli');


//Rutas para validar
Route::post('/inicio-sesion',[LoginController::class,'login'])->name('inicio_sesion');




//Rutas para las actas
Route::get('/{id}/acta',[ActasController::class,'index'])->name('actas');
Route::post('/acta/pdf',[ActasController::class,'pdf'])->name('pdfActa');
Route::post('/acta/store',[ActasController::class, 'store'])->name('saveActa');
Route::post('/acta/update',[ActasController::class, 'edit'])->name('updateActa');
Route::get('/acta/disabled/{id}',[ActasController::class, 'disabled'])->name('disabledActa');
Route::get('/acta/enabled/{id}',[ActasController::class, 'enabled'])->name('enabledActa');

Route::get('/{id}/acta/cliente',[ActasController::class,'indexCli'])->name('actasCliente');


//Ruta para usuario
Route::get('/{id}/usuario',[UserController::class,'indexUse'])->name('usuarios');
Route::post('/usuario/pdf',[UserController::class,'pdfUse'])->name('pdfUsuario');
Route::post('/usuario/store',[UserController::class, 'storeUse'])->name('saveUsuario');
Route::post('/usuario/update',[UserController::class, 'editUse'])->name('updateUsuario');
Route::get('/usuario/disabled/{id}',[UserController::class, 'disabledUse'])->name('disabledUsuario');
Route::get('/usuario/enabled/{id}',[UserController::class, 'enabledUse'])->name('enabledUsuario');
Route::post('/usuario/buscar',[UserController::class,'buscarUse'])->name('buscarUsuario');
Route::get('/{id}/acta/auditoria',[UserController::class,'auditoria'])->name('usuarioAuditoria');


//Ruta para clientes
Route::get('/{id}/cliente',[AsignacionController::class,'indexCli'])->name('clientes');
Route::post('/cliente/store',[AsignacionController::class, 'storeCli'])->name('saveCliente');
Route::get('/cliente/disabled/{id}',[AsignacionController::class, 'disabledCli'])->name('disabledCliente');
Route::get('/cliente/enabled/{id}',[AsignacionController::class, 'enabledCli'])->name('enabledCliente');


//Ruta para Empleados
Route::get('/{id}/empleado',[AsignacionController::class,'indexEmp'])->name('empleados');
Route::post('/empleado/store',[AsignacionController::class, 'storeEmp'])->name('saveEmpleado');
Route::get('/empleado/disabled/{id}',[AsignacionController::class, 'disabledEmp'])->name('disabledEmpleado');
Route::get('/empelado/enabled/{id}',[AsignacionController::class, 'enabledEmp'])->name('enabledEmpleado');

//Ruta para cuarteles
Route::get('/{id}/cuartel',[CuartelController::class,'index'])->name('cuarteles');
Route::post('/cuartel/pdf',[CuartelController::class,'pdf'])->name('pdfCuartel');
Route::post('/cuartel/store',[CuartelController::class, 'store'])->name('saveCuartel');
Route::post('/cuartel/update',[CuartelController::class, 'edit'])->name('updateCuartel');
Route::get('/cuartel/disabled/{id}',[CuartelController::class, 'disabled'])->name('disabledCuartel');
Route::get('/cuartel/enabled/{id}',[CuartelController::class, 'enabled'])->name('enabledCuartel');




//Ruta para alquileres
Route::get('/{id}/alquiler',[TiposAlquilerController::class,'index'])->name('alquileres');
Route::post('/alquiler/pdf',[TiposAlquilerController::class,'pdf'])->name('pdfAlquiler');
Route::post('/alquiler/store',[TiposAlquilerController::class, 'store'])->name('saveAlquiler');
Route::post('/alquiler/update',[TiposAlquilerController::class, 'edit'])->name('updateAlquiler');
Route::get('/alquiler/disabled/{id}',[TiposAlquilerController::class, 'disabled'])->name('disabledAlquiler');
Route::get('/alquiler/enabled/{id}',[TiposAlquilerController::class, 'enabled'])->name('enabledAlquiler');

Route::get('/{id}/alquiler/cliente',[TiposAlquilerController::class,'indexCli'])->name('alquileresCliente');

//Ruta nichos
Route::get('/{cod}/cuartel/nicho/{id}',[NichosController::class, 'index'])->name('nichos');
Route::post('/cuartel/nicho/buscar/cliente',[AlquilerNichoController::class,'buscarCli'])->name('buscarCliente');
Route::post('/cuartel/nicho/buscar/empleado',[AlquilerNichoController::class,'buscarEmp'])->name('buscarEmpleado');



//Ruta alquileres de nichos
Route::post('/alquiler-nicho/store',[AlquilerNichoController::class, 'store'])->name('saveAlquilerNicho');
Route::get('/alquiler/pdf',[AlquilerNichoController::class,'pdf'])->name('pdfAlquiler');