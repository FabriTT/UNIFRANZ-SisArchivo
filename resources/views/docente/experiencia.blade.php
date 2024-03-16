@extends('dashboard.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistema Archivo</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @section('content')
        <div class="card">
            <div class="card-header ">
                <div class="card-title text-center"><span class="h2">ADMINISTRACION DE EXPERIENCIA LABORAL</span>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ route('experienciaBuscar') }}" class="form-inline" name="form-buscar"
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
                            <th scope="col" colspan="2">Curriculum vitae</th>
                            <th scope="col">Años de experiencia</th>
                            <th scope="col" colspan="2">Respaldo de experiencia laboral</th>
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

                                    <td>
                                        @if ($docente->Foto_curriculum_doc == null)
                                        @else
                                            <a class="btn btn-default btn-round"
                                                href="{{ asset('storage/' . $docente->Foto_curriculum_doc) }}">ABRIR</a>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($docente->Foto_curriculum_doc == null)
                                        @else
                                            <button class="btn btn-default btn-border btn-round"
                                                onclick="HistoCurriculum('{{ json_encode($docente) }}','{{ route('histoCurriculum') }}','{{ asset('storage/') }}')"
                                                data-toggle="modal" data-target="#HistorialCurriculum">
                                                <span class="btn-label">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                                Historico
                                            </button>
                                        @endif

                                    </td>

                                    <td>{{ $docente->Años_experiencia_doc }}</td>
                                    <td>
                                        @if ($docente->Foto_experiencia_doc == null)
                                        @else
                                            <a class="btn btn-default btn-round"
                                                href="{{ asset('storage/' . $docente->Foto_experiencia_doc) }}">ABRIR</a>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($docente->Foto_experiencia_doc == null)
                                        @else
                                            <button class="btn btn-default btn-border btn-round"
                                                onclick="HistoExperiencia('{{ json_encode($docente) }}','{{ route('histoExperiencia') }}','{{ asset('storage/') }}')"
                                                data-toggle="modal" data-target="#HistorialExperiencia">
                                                <span class="btn-label">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                                Historico
                                            </button>
                                        @endif

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
                                                onclick="seleccionar('{{ json_encode($docente) }}')" data-toggle="modal"
                                                data-target="#Experiencia">
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




        <!-- Modificar -->
        <div class="modal" id="Experiencia">
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
                                    <label for="nombre">Docente:</label>
                                    <input type="text" class="form-control" name="Modnombre" id="Modnombre" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">Carnet:</label>
                                    <input type="text" class="form-control" name="Modcarnet" id="Modcarnet" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Fotocopia de curriculum:</label>
                                    <input type="file" class="form-control" name="Modfotocurriculum"
                                        id="Modfotocurriculum" accept=".pdf, image/*">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Años de experiencia:</label>
                                    <input type="text" class="form-control" name="Modaños" id="Modaños" maxlength="2">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="nombre">*Respaldo de experiencia laboral:</label>
                                    <input type="file" class="form-control" name="Modfotoexperiencia"
                                        id="Modfotoexperiencia" accept=".pdf, image/*">
                                </div>
                            </div>
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
                                    onclick="Modificar('{{ route('updateExperiencia') }}','{{ route('experiencia') }}','{{ route('clase_modelo') }}')">Editar</button>
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

        <!-- Historico experiencia -->
        <div class="modal" id="HistorialExperiencia">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Historial de respaldos de experiencia laboral</strong>
                        </h4>
                    </div>


                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="nombre">Carpeta:</label>
                            <input type="text" class="form-control" name="carpeta2" id="carpeta2" disabled>
                        </div>
                        <hr>

                        <div class="table-responsive scroll" style="max-height: 400px;">
                            <table class="table table-striped text-center" id="TablaExperiencia" name="TablaExperiencia">
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


        <!-- Historico experiencia -->
        <div class="modal" id="HistorialCurriculum">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title mx-auto"><strong>Historial de curriculums vitae</strong></h4>
                    </div>


                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="nombre">Carpeta:</label>
                            <input type="text" class="form-control" name="carpeta" id="carpeta" disabled>
                        </div>
                        <hr>

                        <div class="table-responsive scroll" style="max-height: 400px;">
                            <table class="table table-striped text-center" id="TablaCurriculum" name="TablaCurriculum">
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


        <script>
            var rutaBorrar = '{{ route('borrarArchivo') }}';
            var rutaCargar = '{{ route('docente') }}';
            var permisoArchivo = ' {{ auth()->user()->hasPermissionTo('borrarArchivo') }}';
            var buscar = ' {{ route('buscarDocente') }}';
        </script>
        <script src="{{ asset('propio/Experiencia.js') }}"></script>
        <script src="{{ asset('propio/HistorialDes.js') }}"></script>
    @endsection
</body>



</html>
