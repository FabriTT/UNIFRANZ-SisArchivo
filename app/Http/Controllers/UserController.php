<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asignacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexUse($id)
    {

        $usuarios = DB::table('users as u')
                ->paginate(5);


        return view('usuario.indexUse',compact('usuarios'),['id' => $id]);
    }

    public function auditoria($id)
    {

        $usuarios = DB::table('audi_users')
                ->paginate(5);


        return view('usuario.auditoriaUse',compact('usuarios'),['id' => $id]);
    }



    public function pdfUse(Request $request)
    {
        

        $usuarios = DB::table('users as u')
            ->whereBetween(DB::raw('DATE(created_at)'), [$request['inicio'], $request['fin']])
            ->get();

        $pdf = Pdf::setPaper('a4','landscape')->loadView('usuario.pdf', compact('usuarios'));
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

    public function buscarUse(Request $request)
    {   
        $clientes = DB::table('users as u')
        ->where('u.estado', '=', 1)
        ->where('u.carnet', '=', $request['carnet'])
        ->first();

        if($clientes==null){
            return 'mal';
        }else{
            return $clientes;
        }    
 
    }

    public function storeUse(Request $request)
    {   
        $fechaActual = date('Y-m-d');

        $user = new User;
        $user->name = $request['nombres'];
        $user->paterno = $request['paterno'];
        $user->materno = $request['materno'];
        $user->carnet = $request['carnet'];
        $user->nacimiento = $request['nacimiento'];
        $user->telefono = $request['telefono'];
        $user->imagen = $request['imagen'];
        $user->email = $request['correo'];
        $user->email_verified_at = $fechaActual;
        $user->password = sha1($request['contraseña']);
        $user->remember_token = "";
        $user->estado = 1;


        $user->save();
        return 'ok';
        
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
    public function editUse(Request $request)
    {
        $fechaActual = date('Y-m-d');

        $user = User::find($request['id']);
        $user->name = $request['nombres'];
        $user->paterno = $request['paterno'];
        $user->materno = $request['materno'];
        $user->carnet = $request['carnet'];
        $user->nacimiento = $request['nacimiento'];
        $user->telefono = $request['telefono'];
        $user->imagen = $request['imagen'];
        $user->email = $request['correo'];
        $user->email_verified_at = $fechaActual;
        $user->password = $user->password ;
        $user->remember_token = "";
        $user->estado = 1;
        $user->save();
        return 'ok';
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

    public function disabledUse($id)
    {
        $user = User::find($id);
        $user->estado = 0;
        $user->save();
        return 'ok';
    }

    public function enabledUse($id)
    {
        $user = User::find($id);
        $user->estado = 1;
        $user->save();
        return 'ok';
    }

    public function buscar($id)
    {   
        $usuario = DB::table('users as u')
        ->join('asignacions as a', 'u.id', '=', 'a.id_use')
        ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
        ->where('u.id', '=', $id)
        ->select('u.*', 'c.*')
        ->get();


        return $usuario;
          
 
    }
}
