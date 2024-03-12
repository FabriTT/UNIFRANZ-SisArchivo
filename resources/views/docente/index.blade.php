@extends('dashboard.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistema Archivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    @section('content')
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center"><span class="h2"> ADMINISTRACION DE DOCENTES</span>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('docenteBuscar') }}" class="form-inline" name="form-buscar"
                        id="form-buscar">
                        @csrf
                        <label for="dato" class="herramientas">Buscar por:</label>
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
                            <option value="{{ $cantidadDocentes }}">ALL</option>
                        </select>
                        <button type="submit" class="btn btn-icon btn-round btn-default herramientas">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('docenteExport') }}">
                        <button type="button" class="btn btn-icon btn-round btn-success herramientas">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </a>
                    @can('saveDocente')
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
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col">Carnet</th>
                            <th scope="col">Vencimiento Carnet</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Tel. Particular</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Correo Personal</th>
                            <th scope="col">Correo Coorporativo</th>
                            <th scope="col" colspan="2">Fotocopia carnet</th>
                            <th scope="col" colspan="2">Fotocopia certificado nac.</th>
                            <th scope="col">Contacto de emergencia</th>
                            <th scope="col">Estado</th>
                            <th scope="col" @can('historialDesactivacion') colspan="2"  @endcan>
                                Acciones</th>
                            </tr>
                        </thead>
                        @forelse ($docentes as $docente)
                            <tbody>
                                <tr
                                    class="
                                @if (strtotime($docente->VencimientoCarnet_doc) <= strtotime('+1 week', strtotime('now'))) rojo
                                @elseif (strtotime($docente->VencimientoCarnet_doc) <= strtotime('+1 month', strtotime('now')))  amarillo @endif
                                ">
                                    <td>{{ $docente->Nombres_doc }}</td>
                                    <td>{{ $docente->Paterno_doc . ' ' . $docente->Materno_doc }}</td>
                                    <td>{{ $docente->Fecha_Nacimiento_doc }}</td>
                                    <td>{{ $docente->Carnet_doc }}</td>
                                    <td>{{ $docente->VencimientoCarnet_doc }}</td>
                                    <td>{{ $docente->Nombre_nac }}</td>
                                    <td>{{ $docente->Sexo_doc }}</td>
                                    <td>{{ $docente->Direccion_doc }}</td>
                                    <td>{{ $docente->TelefonoParticular_doc }}</td>
                                    <td>{{ $docente->Celular_doc }}</td>
                                    <td>{{ $docente->CorreoPersonal_doc }}</td>
                                    <td>{{ $docente->CorreoCoorporativo_doc }}</td>
                                    <td><a class="btn btn-default btn-round"
                                            href="{{ asset('storage/' . $docente->Foto_Carnet_doc) }}">ABRIR</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-default btn-border btn-round"
                                            onclick="HistoCarnet('{{ json_encode($docente) }}','{{ route('histoCarnet') }}','{{ asset('storage/') }}')"
                                            data-toggle="modal" data-target="#HistorialCarnet">
                                            <span class="btn-label">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                            Historico
                                        </button>
                                    </td>
                                    <td><a class="btn btn-default btn-round"
                                            href="{{ asset('storage/' . $docente->Foto_Nacimiento_doc) }}">ABRIR</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-default btn-border btn-round"
                                            onclick="HistoNacimiento('{{ json_encode($docente) }}','{{ route('histoNacimiento') }}','{{ asset('storage/') }}')"
                                            data-toggle="modal" data-target="#HistorialNacimiento">
                                            <span class="btn-label">
                                                <i class="fas fa-file-alt"></i>
                                            </span>
                                            Historico
                                        </button>
                                    </td>
                                    <td>{{ $docente->EmergenciaNombres_doc . ' ' . $docente->EmergenciaPaterno_doc . ' ' . $docente->EmergenciaMaterno_doc . ' ' . $docente->EmergenciaGrado_doc . ' ' . $docente->EmergenciaCelular_doc }}
                                    </td>
                                    <td>
                                        @if ($docente->Estado_doc == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Desactivado</span>
                                        @endif
                                    </td>
                                    @can('updateDocente')
                                        <td>

                                            <button type="button" class="btn btn-icon btn-round btn-warning"
                                                onclick="seleccionar('{{ json_encode($docente) }}'); " data-toggle="modal"
                                                data-target="#Modificar">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                        </td>
                                    @endcan
                                    @can('historialDesactivacion')
                                        <td>
                                            @if ($docente->Estado_doc == 1)
                                                <button type="button" class="btn btn-icon btn-round btn-danger"
                                                    data-toggle="modal" data-target="#Eliminar"
                                                    onclick="HistorialDesactivacion('{{ $docente->Id_doc }}','{{ route('historialDesactivacion') }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                @can('enabledDocente')
                                                    <button type="button" class="btn btn-icon btn-round btn-success"
                                                        onclick="activar('{{ route('enabledDocente', $docente->Id_doc) }}','{{ route('docente') }}')">
                                                        <i class="fa fa-trash-arrow-up"></i>
                                                    </button>
                                                @endcan
                                            @endif

                                        </td>
                                    @endcan
                                </tr>
                            </tbody>
                        @empty
                            <li>No hay ningun registro de docentes</li>
                        @endforelse
                    </table>
                </div>
                <hr>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{ $docentes->appends(request()->input())->links() }}
                    </div>
                </div>

            </div>
        </div>

        <!-- Insertar -->
        <div class="modal" id="Insertar" style="overflow-y: scroll;">
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
                                    <input type="text" class="form-control" name="nombres" id="nombres"
                                        maxlength="50">

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
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" name="nacimiento" id="nacimiento"
                                        max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                        min="{{ now()->subYears(80)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Carnet:</label>
                                    <input type="text" class="form-control" name="carnet" id="carnet"
                                        maxlength="8">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Vencimiento:</label>
                                    <input type="date" class="form-control" name="vencimiento" id="vencimiento"
                                        min="{{ now()->addWeek()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Nacionalidad:</label>
                                    <div class="d-flex">
                                        <select class="form-control mr-2" id="ciudadania" name="ciudadania">
                                            <option disabled selected></option>

                                        </select>
                                        <button type="button" class="btn btn-icon btn-round btn-primary"
                                            onclick="MostrarNacionalidades()" data-toggle="modal"
                                            data-target="#Nacionalidad">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-check" id="divRadio" name="divRadio">
                                        <label>*Genero</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input prueba" type="radio" name="sexo"
                                                id="sexo" value="M">
                                            <span class="form-radio-sign">Masculino</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="sexo" id="sexo"
                                                value="F">
                                            <span class="form-radio-sign">Femenino</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Direccion:</label>
                                    <input type="text" class="form-control" name="direccion" id="direccion"
                                        maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Correo Personal:</label>
                                    <input type="text" class="form-control" name="correoPersonal" id="correoPersonal"
                                        maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Correo Coorporativo:</label>
                                    <input type="text" class="form-control" name="correoCoorporativo"
                                        id="correoCoorporativo" maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Tel. Particular:</label>
                                    <input type="text" class="form-control" name="telparticular" id="telparticular"
                                        maxlength="7">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Celular:</label>
                                    <input type="text" class="form-control" name="celular" id="celular"
                                        maxlength="8">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Fotocopia de carnet:</label>
                                    <input type="file" class="form-control" name="fotocarnet" id="fotocarnet"
                                        accept=".pdf, image/*">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Fotocopia de certificado de nacimiento:</label>
                                    <input type="file" class="form-control" name="fotonacimiento" id="fotonacimiento"
                                        accept=".pdf, image/*">
                                </div>
                            </div>
                            <hr>
                            <h4 class="modal-title mx-auto text-center"><strong>Contacto de emergencia</strong></h4>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">*Nombres:</label>
                                    <input type="text" class="form-control" name="nombresEmergencia"
                                        id="nombresEmergencia" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">*Paterno:</label>
                                    <input type="text" class="form-control" name="paternoEmergencia"
                                        id="paternoEmergencia" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">*Materno:</label>
                                    <input type="text" class="form-control" name="maternoEmergencia"
                                        id="maternoEmergencia" maxlength="50">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Grado de parentesco:</label>
                                    <select class="form-control" id="gradoEmergencia" name="gradoEmergencia">
                                        <option disabled selected></option>
                                        <option>Padre</option>
                                        <option>Madre</option>
                                        <option>Hermano/a</option>
                                        <option>Abuelo/a</option>
                                        <option>Tio/a</option>
                                        <option>Hijo/a</option>
                                        <option>Primo/a</option>
                                        <option>Amigo/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Celular:</label>
                                    <input type="text" class="form-control" name="celularEmergencia"
                                        id="celularEmergencia" maxlength="8">
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
                                    onclick="Guardar('{{ route('saveDocente') }}','{{ route('docente') }}','{{ route('banco') }}')">Guardar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modificar -->
        <div class="modal" id="Modificar" style="overflow-y: scroll;">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Editar Datos</strong></h4>
                    </div>


                    <div class="modal-body">
                        <form name="form-modificar" id="form-modificar">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">Nombres:</label>
                                    <input type="text" class="form-control" name="Modnombres" id="Modnombres"
                                        maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">Paterno:</label>
                                    <input type="text" class="form-control" name="Modpaterno" id="Modpaterno"
                                        maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">Materno:</label>
                                    <input type="text" class="form-control" name="Modmaterno" id="Modmaterno"
                                        maxlength="50">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" name="Modnacimiento" id="Modnacimiento"
                                        max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                        min="{{ now()->subYears(80)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Carnet:</label>
                                    <input type="text" class="form-control" name="Modcarnet" id="Modcarnet"
                                        maxlength="8">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">Vencimiento:</label>
                                    <input type="date" class="form-control" name="Modvencimiento" id="Modvencimiento"
                                        min="{{ now()->addWeek()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nacionalidad:</label>
                                    <div class="d-flex">
                                        <select class="form-control mr-2" id="Modciudadania" name="Modciudadania">
                                            <option disabled selected></option>
                                        </select>
                                        <button type="button" class="btn btn-icon btn-round btn-primary"
                                            onclick="MostrarNacionalidades()" data-toggle="modal"
                                            data-target="#Nacionalidad">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-check" id="ModdivRadio" name="ModdivRadio">
                                        <label>Genero</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="Modsexo" id="ModsexoM"
                                                value="M">
                                            <span class="form-radio-sign">Masculino</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="Modsexo" id="ModsexoF"
                                                value="F">
                                            <span class="form-radio-sign">Femenino</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Direccion:</label>
                                    <input type="text" class="form-control" name="Moddireccion" id="Moddireccion"
                                        maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Correo Personal:</label>
                                    <input type="text" class="form-control" name="ModcorreoPersonal"
                                        id="ModcorreoPersonal" maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Correo Coorporativo:</label>
                                    <input type="text" class="form-control" name="ModcorreoCoorporativo"
                                        id="ModcorreoCoorporativo" maxlength="100">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Tel. Particular:</label>
                                    <input type="text" class="form-control" name="Modtelparticular"
                                        id="Modtelparticular" maxlength="7">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">Celular:</label>
                                    <input type="text" class="form-control" name="Modcelular" id="Modcelular"
                                        maxlength="8">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Fotocopia de carnet:</label>
                                    <input type="file" class="form-control" name="Modfotocarnet" id="Modfotocarnet"
                                        accept=".pdf, image/*">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Fotocopia de certificado de nacimiento:</label>
                                    <input type="file" class="form-control" name="Modfotonacimiento"
                                        id="Modfotonacimiento" accept=".pdf, image/*">
                                </div>
                            </div>
                            <hr>
                            <h4 class="modal-title mx-auto text-center"><strong>Contacto de emergencia</strong></h4>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nombre">Nombres:</label>
                                    <input type="text" class="form-control" name="ModnombresEmergencia"
                                        id="ModnombresEmergencia" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">Paterno:</label>
                                    <input type="text" class="form-control" name="ModpaternoEmergencia"
                                        id="ModpaternoEmergencia" maxlength="50">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nombre">Materno:</label>
                                    <input type="text" class="form-control" name="ModmaternoEmergencia"
                                        id="ModmaternoEmergencia" maxlength="50">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Grado de parentesco:</label>
                                    <select class="form-control" id="ModgradoEmergencia" name="ModgradoEmergencia">
                                        <option disabled selected></option>
                                        <option>Padre</option>
                                        <option>Madre</option>
                                        <option>Hermano/a</option>
                                        <option>Abuelo/a</option>
                                        <option>Tio/a</option>
                                        <option>Hijo/a</option>
                                        <option>Primo/a</option>
                                        <option>Amigo/a</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">Celular:</label>
                                    <input type="text" class="form-control" name="ModcelularEmergencia"
                                        id="ModcelularEmergencia" maxlength="8">
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
                                    onclick="Modificar('{{ route('updateDocente') }}','{{ route('docente') }}')">Editar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Desactivaciones -->
        <div class="modal" id="Eliminar">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Motivos para la desactivacion del registro</strong>
                        </h4>
                    </div>


                    <div class="modal-body">

                        <form method="POST" name="form-desactivar" id="form-desactivar">
                            @csrf

                            <div class="form-row">
                                @can('saveDesactivacion')
                                    <div class="form-group col-md-12">
                                        <label for="motivo">Motivo:</label>
                                        <input type="text" class="form-control" name="motivo" id="motivo">
                                    </div>
                                    <div class="form-group col-md-12" id="divClasificacion" name="divClasificacion">
                                        <div class="form-check" id="divClasificacion" name="divClasificacion">
                                            <label class="form-label" for="clasificacion">Clasificacion:</label>
                                            <div class="selectgroup selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="clasificacion" id="clasificacion"
                                                        value="BUENO" class="selectgroup-input">
                                                    <span class="selectgroup-button"
                                                        style="color: #28a745; border: 1px solid #28a745;">Motivo
                                                        bueno</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="clasificacion" id="clasificacion"
                                                        value="REGULAR" class="selectgroup-input">
                                                    <span class="selectgroup-button"
                                                        style="color: #ffc107; border: 1px solid #ffc107;">Motivo
                                                        regular</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="clasificacion" id="clasificacion"
                                                        value="MALO" class="selectgroup-input">
                                                    <span class="selectgroup-button"
                                                        style="color: #dc3545; border: 1px solid #dc3545;">Motivo
                                                        malo</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="idDesactivacion" id="idDesactivacion"
                                    style="display:none">
                            </div>
                            <hr>


                            <div class="table-responsive scroll" style="max-height: 230px;">
                                <table class="table table-striped text-center" id="TablaDesactivacion"
                                    name="TablaDesactivacion">
                                    <thead style="background: #222222; color: white">
                                        <tr>
                                            <th>MOTIVO</th>
                                            <th>CLASIFICACION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </form>
                    </div>


                    <div class="modal-footer">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center error-container w-50" id="divErrorDesactivar"
                                name="divErrorDesactivar">
                                <p class="text-danger" id="errorDesactivar" name="errorDesactivar"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                @can('saveDesactivacion')
                                    <button type="button" class="btn btn-success"
                                        onclick="Desactivar('{{ route('saveDesactivacion') }}','{{ route('docente') }}')">Guardar</button>
                                @endcan
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- Historico carnet -->
        <div class="modal" id="HistorialCarnet">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Historial Carnet</strong></h4>
                    </div>


                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="nombre">Carpeta:</label>
                            <input type="text" class="form-control" name="carpeta" id="carpeta" disabled>
                        </div>
                        <hr>

                        <div class="table-responsive scroll" style="max-height: 400px;">
                            <table class="table table-striped text-center" id="TablaCarnet" name="TablaCarnet">
                                <thead style="background: #222222; color: white">
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th @can('borrarArchivo') colspan="2"  @endcan>ACCIONES</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Historico nacimiento -->
        <div class="modal" id="HistorialNacimiento">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Historial Certificados de Nacimiento</strong></h4>
                    </div>


                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="nombre">Carpeta:</label>
                            <input type="text" class="form-control" name="carpeta2" id="carpeta2" disabled>
                        </div>
                        <hr>

                        <div class="table-responsive scroll" style="max-height: 400px;">
                            <table class="table table-striped text-center" id="TablaNacimiento" name="TablaNacimiento">
                                <thead style="background: #222222; color: white">
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th @can('borrarArchivo') colspan="2"  @endcan>ACCIONES</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Nacionalidades -->
        <div class="modal" id="Nacionalidad">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Agregar nacionalidad</strong></h4>
                    </div>

                    <form name="form-nacionalidad" id="form-nacionalidad">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nacionalidad" id="nacionalidad">
                            </div>
                    </form>
                    <hr>

                    <div class="table-responsive scroll" style="max-height: 300px;">
                        <table class="table table-striped text-center" id="TablaNacionalidad" name="TablaNacionalidad">
                            <thead style="background: #222222; color: white">
                                <tr>
                                    <th>NOMBRE</th>
                                    @can('borrarNacionalidad')
                                        <th>ACCIONES</th>
                                    @endcan

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center error-container w-50" id="divErrorNac" name="divErrorNac">
                            <p class="text-danger" id="errorNac" name="errorNac"></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-success"
                                onclick="InsertarNacionalidad('{{ route('saveNacionalidad') }}')">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <script>
            var rutaBorrar = '{{ route('borrarArchivo') }}';
            var rutaCargar = '{{ route('docente') }}';
            var permisoArchivo = ' {{ auth()->user()->hasPermissionTo('borrarArchivo') }}';
            var nacionalidades = ' {{ route('nacionalidad') }}';
            var eliminarNacionalidad = ' {{ route('borrarNacionalidad') }}';
            var permisoBorrarNacionalidad = ' {{ auth()->user()->hasPermissionTo('borrarNacionalidad') }}';
        </script>
        <script src="{{ asset('propio/Docente.js') }}"></script>
        <script src="{{ asset('propio/HistorialDes.js') }}"></script>
    @endsection
</body>

</html>
