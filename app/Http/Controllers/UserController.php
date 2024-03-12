<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoVerificacion;
use App\Models\User;
use App\Exports\UserExport;
use App\Models\Contrato;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store']]);
    }

    public function login()
    {
        return view('login.index');
    }

    public function recuperarContra()
    {
        return view('login.recuperar');
    }

    public function perfil()
    {
        return view('usuario.perfil');
    }

    public function editar()
    {
        return view('usuario.editar');
    }

    public function check(Request $request)
    {
        $email = $request->email;
        $password = $request->pass;

        if (auth()->attempt(array('email' => $email, 'password' => $password, 'estado' => '1'))) {
            return response()->json([[1]]);
        } else {
            return response()->json([[3]]);
        }
    }

    public function validarCorreo(Request $request)
    {

        $email = $request->email;
        $user = User::where('email', $email)
            ->where('estado', '1')
            ->first();


        if ($user) {
            $codigoAleatorio = Str::random(8);
            $user->codigoVerificacion = $codigoAleatorio;
            $user->save();
            $datosCorreo = [
                'codigo' => $codigoAleatorio,
            ];
            Mail::to($user->email)->send(new CodigoVerificacion($datosCorreo));
            return 'ok';
        } else {
            return 'no encontrado';
        }
    }

    public function validarCodigo(Request $request)
    {

        $codigo = $request->codigo;
        $user = User::where('codigoVerificacion', $codigo)->first();

        if ($user) {
            return 'ok';
        } else {
            return 'no encontrado';
        }
    }

    public function actualizarContraseña(Request $request)
    {

        $email = $request->input('email');
        $pass = $request->input('pass');
        $user = User::where('email', $email)->first();
        $user->password = $pass;
        $user->save();
        return 'ok';
    }

    public function dashboard()
    {
        $usuarios = User::count();
        $usuariosA = User::where('estado', '1')->count();
        $usuariosI = User::where('estado', '0')->count();
        $docentes = Docente::count();
        $docentesA = Docente::where('Estado_doc', '1')->count();
        $docentesI = Docente::where('Estado_doc', '0')->count();
        $contratos = Contrato::count();
        $contratosA = Contrato::where('Estado_con', '1')->count();
        $contratosI = Contrato::where('Estado_con', '0')->count();
        return view('dashboard.index', compact('usuarios', 'usuariosA', 'usuariosI', 'docentes', 'docentesA', 'docentesI', 'contratos', 'contratosA', 'contratosI'));
    }

    public function logout(Request $resquest)
    {
        FacadesAuth::logout();
        $resquest->session()->flush();
        return redirect('/');
    }

    public function index(Request $request)
    {
        $dato = $request->input('dato');
        $filtro = $request->input('filtro');
        $cantidad = $request->input('cantidad', 5); // Valor predeterminado de 5 elementos por página

        $query = DB::table('users')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id');

        if (!empty($dato)) {
            if ($filtro == 'Nombres y Apellidos') {
                $query->where(DB::raw("CONCAT(users.name, ' ', paterno, ' ', materno)"), 'LIKE', "%$dato%");
            } elseif ($filtro == 'Carnet') {
                $query->where(DB::raw("carnet"), 'LIKE', "%$dato%");
            }
        }

        // Seleccionar las columnas necesarias, incluyendo el nombre del rol
        $query->select('users.*', 'roles.name as rol');

        // Aplicar paginación
        $usuarios = $query->paginate($cantidad);
        $cantidadUsuarios = User::count();
        return view('usuario.index', compact('usuarios','cantidadUsuarios'));
    }

    public function disabled($id)
    {
        $usuario = User::find($id);
        $usuario->estado = 0;
        $usuario->save();
        return 'ok';
    }

    public function enabled($id)
    {
        $usuario = User::find($id);
        $usuario->estado = 1;
        $usuario->save();
        return 'ok';
    }

    public function store(Request $request)
    {

        try {
            $usuario = new User();
            $usuario->name = ucwords(strtolower($request->input('nombres')));
            $usuario->paterno = ucwords(strtolower($request->input('paterno')));
            $usuario->materno = ucwords(strtolower($request->input('materno')));
            $usuario->carnet = $request->input('carnet');
            $usuario->email = $request->input('correo');
            $usuario->telefono = $request->input('celular');
            $usuario->password = $request->input('contraseña');
            $usuario->imagen = '';
            $usuario->codigoVerificacion = '';
            $usuario->estado = 1;
            $usuario->save();

            $usuario->roles()->sync($request->input('rol'));

            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                $errorMessage = $e->getMessage();
                if (strpos($errorMessage, 'users.users_telefono_unique') !== false) {
                    return 'Ya hay un usuario registrado con el telefono que ingreso';
                } elseif (strpos($errorMessage, 'users.users_carnet_unique') !== false) {
                    return 'Ya hay un usuario registrado con el carnet  que ingreso';
                } elseif (strpos($errorMessage, 'users.users_email_unique') !== false) {
                    return 'Ya hay un usuario registrado con el correo  que ingreso';
                } else {
                    return 'Error en la base de datos';
                }
            } else {
                return 'Error en la base de datos';
            }
        }
    }

    public function pdf()
    {
        $usuarios = User::with('roles')->get();
        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('usuario.pdf', compact('usuarios'));
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new UserExport, 'usuarios.xlsx');
    }

    public function edit(Request $request)
    {

        $rol = $request->input('Modrol');
        $usuario = User::find($request->input('id'));
        $usuario->roles()->sync([$rol]);
        $usuario->save();
        return 'ok';
    }

    public function actualizar(Request $request)
    {
        try {
            $usuario = User::find($request->input('id'));
            $usuario->name = ucwords(strtolower($request->input('nombres')));
            $usuario->paterno = ucwords(strtolower($request->input('paterno')));
            $usuario->materno = ucwords(strtolower($request->input('materno')));
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('correo');
            $usuario->carnet = $request->input('carnet');
            $contraseña = $request->input('contraseña');
            $imagen = $request->file('foto');


            if ($imagen !== null && $imagen !== '') {
                $usuario->imagen = 'PERFILES/IMAGEN ' . strtoupper($request->input('nombres') . ' ' . $request->input('paterno')) . ' ' . $request->input('carnet') . $imagen->extension();
            }
            if ($contraseña !== null && $contraseña !== '') {
                $usuario->password = $contraseña;
            }

            $usuario->save();

            $carpetaDestino = 'public/PERFILES';
            if (!Storage::exists($carpetaDestino)) {
                Storage::makeDirectory($carpetaDestino);
            }
            if (isset($imagen)) {
                $imagen->storeAs($carpetaDestino, 'IMAGEN ' . strtoupper($request->input('nombres') . ' ' . $request->input('paterno')) . ' ' . $request->input('carnet') . $imagen->extension());
            }

            return 'ok';
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) { // Código de error específico para duplicado de clave única
                $errorMessage = $e->getMessage();
                if (strpos($errorMessage, 'users.users_telefono_unique') !== false) {
                    return 'Ya hay un usuario registrado con el telefono que ingreso';
                } elseif (strpos($errorMessage, 'users.users_carnet_unique') !== false) {
                    return 'Ya hay un usuario registrado con el carnet  que ingreso';
                } elseif (strpos($errorMessage, 'users.users_email_unique') !== false) {
                    return 'Ya hay un usuario registrado con el correo  que ingreso';
                } else {
                    return 'Error en la bsae de datos';
                }
            } else {
                return 'Error en la bsae de datos';
            }
        }
    }
}
