@extends('dashboard.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Unifranz</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body>
    @section('content')
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center"><span class="h2"> ADMINISTRACION DE USUARIOS</span>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('usuarioBuscar') }}" class="form-inline" name="form-buscar"
                        id="form-buscar">
                        @csrf
                        <label for="buscar" class="herramientas">Buscar por:</label>
                        <select class="form-control herramientas" id="filtro" name="filtro" style="width: 185px">
                            <option>Nombres y Apellidos</option>
                            <option>Carnet</option>
                        </select>
                        <input type="text" class="form-control herramientas" id="dato" name="dato"
                            placeholder="Datos">
                        <label for="buscar" class="herramientas">Cant.:</label>
                        <select class="form-control herramientas" id="cantidad" name="cantidad" style="width: 80px">
                            <option selected>5</option>
                            <option>10</option>
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                            <option value="{{ $cantidadUsuarios }}">ALL</option>
                        </select>
                        <button type="submit" class="btn btn-icon btn-round btn-default herramientas">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('usuarioExport') }}">
                        <button type="button" class="btn btn-icon btn-round btn-success herramientas">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </a>
                    @can('saveUsuario')
                        <button type="button" class="btn btn-icon btn-round btn-primary herramientas" data-toggle="modal"
                            data-target="#Insertar">
                            <i class="fa fa-user-plus"></i>
                        </button>
                    @endcan

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead style="background: #222222; color: white">
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Carnet</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                            @can('disabledUsuario')
                                <th scope="col" colspan="2">Acciones</th>
                            @endcan

                            </tr>
                        </thead>
                        @forelse ($usuarios as $usuario)
                            <tbody>
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->paterno . ' ' . $usuario->materno }}</td>
                                    <td>{{ $usuario->carnet }}</td>
                                    <td>{{ $usuario->telefono }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->rol }}</td>
                                    </td>
                                    <td>
                                        @if ($usuario->estado == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Desactivado</span>
                                        @endif
                                    </td>
                                    @can('updateUsuario')
                                        <td>

                                            <button type="button" class="btn btn-icon btn-round btn-warning"
                                                onclick="seleccionar('{{ json_encode($usuario) }}')" data-toggle="modal"
                                                data-target="#Modificar">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                        </td>
                                    @endcan
                                    @can('disabledUsuario')
                                        <td>
                                            @if ($usuario->estado == 1)
                                                <button type="button" class="btn btn-icon btn-round btn-danger"
                                                    onclick="desactivar('{{ route('disabledUsuario', $usuario->id) }}','{{ route('usuario') }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-icon btn-round btn-success"
                                                    onclick="activar('{{ route('enabledUsuario', $usuario->id) }}','{{ route('usuario') }}')">
                                                    <i class="fa fa-trash-arrow-up"></i>
                                                </button>
                                            @endif

                                        </td>
                                    @endcan
                                </tr>
                            </tbody>
                        @empty
                            <li>No hay ningun registro de usuarios</li>
                        @endforelse
                    </table>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{ $usuarios->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>


        <!-- Insertar -->
        <div class="modal" id="Insertar">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Nuevo Docente</strong></h4>
                    </div>


                    <div class="modal-body">
                        <form name="form-insertar" id="form-insertar">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">

                                    <label for="nombres">*Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" maxlength="50">

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="paterno">*Paterno:</label>
                                    <input type="text" class="form-control" name="paterno" id="paterno"
                                        maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">*Materno:</label>
                                    <input type="text" class="form-control" name="materno" id="materno"
                                        maxlength="50">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Carnet:</label>
                                    <input type="text" class="form-control" name="carnet" id="carnet"
                                        maxlength="8">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Celular:</label>
                                    <input type="text" class="form-control" name="celular" id="celular"
                                        maxlength="8">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Correo:</label>
                                    <input type="text" class="form-control" name="correo" id="correo"
                                        maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Contraseña:</label>
                                    <input type="password" class="form-control" name="contraseña" id="contraseña">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="check1" id="check1" onchange="mostrarContrasena()">
                                            <span class="form-check-sign">Mostrar</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Confirmar Contraseña:</label>
                                    <input type="password" class="form-control" name="confirmar" id="confirmar">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="check2" id="check2" onchange="mostrarConfirmar()">
                                            <span class="form-check-sign">Mostrar</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check" id="divRadio" name="divRadio">
                                    <label>*Rol:</label><br>

                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="rol" id="rol1"
                                            value="1">
                                        <span class="form-radio-sign">Administrador</span>
                                    </label>

                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="rol" id="rol2"
                                            value="2">
                                        <span class="form-radio-sign">Escritor</span>
                                    </label>

                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="rol" id="rol3"
                                            value="3">
                                        <span class="form-radio-sign">Lector</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center error-container w-50" id="divErrorGuardar"
                                name="divErrorGuardar">
                                <p class="text-danger" id="errorGuardar" name="errorGuardar"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success"
                                    onclick="Guardar('{{ route('saveUsuario') }}','{{ route('usuario') }}')">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal" id="Modificar">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Editar Datos</strong></h4>
                    </div>


                    <div class="modal-body">
                        <form name="form-modificar" id="form-modificar">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Usuario:</label>
                                    <input type="text" class="form-control" name="Modnombre" id="Modnombre" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Carnet:</label>
                                    <input type="text" class="form-control" name="Modcarnet" id="Modcarnet" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">Celular:</label>
                                    <input type="number" class="form-control" name="Modcelular" id="Modcelular"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Correo:</label>
                                    <input type="text" class="form-control" name="Modcorreo" id="Modcorreo" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check" id="ModdivRadio" name="ModdivRadio">
                                    <label>*Rol:</label><br>

                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="Modrol" id="Modrol1"
                                            value="1">
                                        <span class="form-radio-sign">Administrador</span>
                                    </label>

                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="Modrol" id="Modrol2"
                                            value="2">
                                        <span class="form-radio-sign">Escritor</span>
                                    </label>

                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="Modrol" id="Modrol3"
                                            value="3">
                                        <span class="form-radio-sign">Lector</span>
                                    </label>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="id" id="id"
                                style="display: none">
                        </form>
                    </div>


                    <div class="modal-footer">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center error-container w-50" id="divErrorModificar"
                                name="divErrorMorificar">
                                <p class="text-danger" id="errorModificar" name="errorModificar"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-warning"
                                    onclick="Modificar('{{ route('updateUsuario') }}','{{ route('usuario') }}')">Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <script src="{{ asset('propio/Usuario.js') }}"></script>
    @endsection
</body>



</html>
