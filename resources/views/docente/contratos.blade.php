@extends('dashboard.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ssitema Archivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    @section('content')
        <div class="card">
            <div class="card-header">
                <div class="card-title text-center"><span class="h2">ADMINISTRACION DE CONTRATOS</span>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('contratoBuscar') }}" class="form-inline" name="form-buscar"
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
                            <option value="{{ $cantidadDocentes }}">ALL</option>
                        </select>
                        <button type="submit" class="btn btn-icon btn-round btn-default herramientas">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('contratoExport') }}">
                        <button type="button" class="btn btn-icon btn-round btn-success herramientas">
                            <i class="fas fa-file-excel"></i>
                        </button>
                    </a>
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
                            <th scope="col">Contratos registrados</th>
                            <th scope="col">Estado</th>
                            <th scope="col" @can('historialDesactivacion') colspan="2"  @endcan>Acciones</th>
                            </tr>
                        </thead>
                        @forelse ($docentes as $docente)
                            <tbody>
                                <tr>
                                    <td>{{ $docente->Nombres_doc }}</td>
                                    <td>{{ $docente->Paterno_doc . ' ' . $docente->Materno_doc }}</td>
                                    <td>{{ $docente->Carnet_doc }}</td>
                                    <td>{{ $docente->cantidad_de_contratos }}</td>
                                    <td>
                                        @if ($docente->Estado_doc == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Desactivado</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-icon btn-round btn-warning"
                                            data-toggle="modal" data-target="#Contratos"
                                            onclick="Mostrar('{{ $docente->Nombres_doc . ' ' . $docente->Paterno_doc . ' ' . $docente->Materno_doc }}','{{ $docente->Carnet_doc }}','{{ route('historialContratos') }}','{{ asset('storage/') }}')">
                                            <i class="fa fa-pencil"></i>
                                        </button>

                                    </td>
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
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{ $docentes->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>




        <!-- Modificar -->
        <div class="modal" id="Contratos">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Registro de contrato</strong>
                        </h4>
                    </div>


                    <div class="modal-body">
                        <form method="POST" name="form-contrato" id="form-contrato">
                            @csrf
                            @can('saveContrato')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="motivo">*Materia:</label>
                                        <input type="text" class="form-control" name="materia" id="materia" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">*Fecha del contrato:</label>
                                        <input type="date" class="form-control" name="fechaContrato" id="fechaContrato" max="{{ now()->format('Y-m-d') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nombre">*Fecha fin del contrato:</label>
                                        <input type="date" class="form-control" name="fechaFinContrato"
                                            id="fechaFinContrato" min="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="nombre">*Fotocopia del contrato:</label>
                                        <input type="file" class="form-control" name="fotocopiaContrato"
                                            id="fotocopiaContrato" accept=".pdf, image/*">
                                    </div>
                                </div>
                            @endcan
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                style="display: none">
                            <input type="text" class="form-control" name="carnet" id="carnet"
                                style="display: none">
                            <hr>
                            <div class="table-responsive scroll" style="max-height: 400px;">
                                <table class="table table-striped text-center" id="TablaContratos" name="TablaContratos">
                                    <thead style="background: #222222; color: white">
                                        <tr>
                                            <th>MATERIA</th>
                                            <th>FECHA DEL CONTRATO</th>
                                            <th>FOTOCOPIA DEL CONTRATO</th>
                                            <th>FECHA DE LA EVALUACION DOCENTE</th>
                                            <th>FOTOCOPIA DE LA EVALUACION DOCENTE</th>
                                            <th>CALIFICACION DE LA EVALUACION</th>
                                            <th>ESTADO</th>
                                            @can('saveEvaluacion')
                                                <th @can('borrarContrato') colspan="2"  @endcan>ACCIONES</th>
                                            @endcan

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
                                @can('saveContrato')
                                    <button type="button" class="btn btn-success"
                                        onclick="InsertarContrato('{{ route('saveContrato') }}','{{ route('contrato') }}')">Guardar</button>
                                @endcan
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Evaluacion docente -->
        <div class="modal" id="Evaluaciones">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Registro de evaluacion docente</strong>
                        </h4>
                    </div>


                    <div class="modal-body">
                        <form method="POST" name="form-contrato" id="form-evaluacion">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="motivo">*Calificacion de la evaluacion:</label>
                                    <input type="text" class="form-control" name="calificacion" id="calificacion" maxlength="3">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Fecha de la evlauacion:</label>
                                    <input type="date" class="form-control" name="fechaEvaluacion"
                                        id="fechaEvaluacion" max="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre">*Fotocopia de la evaluacion:</label>
                                    <input type="file" class="form-control" name="fotocopiaEvaluacion"
                                        id="fotocopiaEvaluacion" accept=".pdf, image/*">
                                </div>
                            </div>
                            <input type="text" class="form-control" name="IdContrato" id="IdContrato"
                                style="display: none">
                            <input type="text" class="form-control" name="nombre2" id="nombre2"
                                style="display: none">
                            <input type="text" class="form-control" name="carnet2" id="carnet2"
                                style="display: none">

                        </form>
                    </div>


                    <div class="modal-footer">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center error-container w-50" id="divErrorEvaluacion"
                                name="divErrorEvaluacion">
                                <p class="text-danger" id="errorEvaluacion" name="errorEvaluacion"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                @can('saveDesactivacion')
                                    <button type="button" class="btn btn-success"
                                        onclick="InsertarEvaluacion('{{ route('saveEvaluacion') }}','{{ route('contrato') }}')">Guardar</button>
                                @endcan
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
        <script>
            var direccion = '{{ asset('storage/') }}';
            var historial = '{{ route('historialContratos') }}';
            var rutaBorrar = '{{ route('borrarContrato') }}';
            var rutaCargar = '{{ route('contrato') }}';
            var permisoBorrarContrato = ' {{ auth()->user()->hasPermissionTo('borrarContrato') }}';
            var permisoGuardarContrato = ' {{ auth()->user()->hasPermissionTo('saveEvaluacion') }}';
        </script>


        <script src="{{ asset('propio/Contratos.js') }}"></script>
        <script src="{{ asset('propio/HistorialDes.js') }}"></script>
    @endsection
</body>



</html>
