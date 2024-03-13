<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asignacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request){
        $contador = $request['contador'];
        $credenciales = [
            "email" => $request['correo'],
            "password" => sha1($request['password']),
            "estado" => 1,
        ];

        if(Auth::attempt($credenciales)){

            $users = DB::table('users as u')
                ->join('asignacions as a', 'u.id', '=', 'a.id_use')
                ->join('cargos as c', 'c.id_car', '=', 'a.id_car')
                ->where('u.email', '=', $request['correo'])
                ->where('a.estado_asi', '=', 1)
                ->orderBy('u.id')
                ->select('u.*', 'c.*')
                ->get();
            
            return redirect()->route('dashcli', ['id' => $users[0]->id]);
        }else{
            $contador++;
            return view('login.index')->with('variable', $contador);
        }
    }



}
