@extends('dashboard.index2')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />



    <title>Actas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h1>Registros de Actas de defuncion</h1>
                        </center>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <form action=" {{route('actas',$id)}} " method="GET">
                                <label for="buscar">Buscar por paterno:&nbsp;</label>
                                <input type="text" class="" placeholder="Apellido" style="width: 200px;" name="buscar" id="buscar">
                                <button class="btn btn-secondary" type="submit"><i class="fas fa-sharp fa-solid fa-search"></i></button>
                                </form>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalPDF">PDF <i class="fas fa-solid fa-file-pdf"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="background:white;">
        <div class="table-responsive">
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Edad</th>
                        <th>Partida</th>
                        <th>Provincia</th>
                        <th>Departamento</th>
                        <th>Pais</th>
                        <th>Causa de Muerte</th>
                        <th>Familiar</th>
                        <th>Relacion</th>
                        <th>Doctor</th>
                        <th>CI Doctor</th>
                        <th>Fosa comun</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                @forelse ($actas as $acta)
                @php 
                $datos = 
                $acta->id_act."||"
                .$acta->nombres_act."||"
                .$acta->paterno_act."||"
                .$acta->materno_act."||"
                .$acta->edad_act."||"
                .$acta->partida_act."||"
                .$acta->provincia_act."||"
                .$acta->departamento_act."||"
                .$acta->pais_act."||"
                .$acta->causaMuerte_act."||"
                .$acta->carnet."||"
                .$acta->relacion_act."||"
                .$acta->drNombre_act."||"
                .$acta->drPaterno_act."||"
                .$acta->drMaterno_act."||"
                .$acta->drCarnet_act;
                @endphp
                <tbody>
                    <tr>
                        <td>{{ $acta->nombres_act }}</td>
                        <td>{{ $acta->paterno_act }}</td>
                        <td>{{ $acta->materno_act }}</td>
                        <td>{{ $acta->edad_act }}</td>
                        <td>{{ $acta->partida_act }}</td>
                        <td>{{ $acta->provincia_act }}</td>
                        <td>{{ $acta->departamento_act }}</td>
                        <td>{{ $acta->pais_act }}</td>
                        <td>{{ $acta->causaMuerte_act }}</td>
                        <td>{{ $acta->name." ".$acta->paterno." ".$acta->materno }}</td>
                        <td>{{ $acta->relacion_act }}</td>
                        <td>{{ $acta->drNombre_act." ".$acta->drPaterno_act." ".$acta->drMaterno_act }}</td>
                        <td>{{ $acta->drCarnet_act }}</td>
                        <td>
                            @if($acta->fosa_act == 1)
                            <span class="badge bg-danger">En fosa</span>
                            @else
                            <span class="badge bg-success">En nicho</span>
                            @endif
                        </td>
                        <td>
                            @if($acta->estado_act == 1)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Desactivado</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
                @empty
                <li>No hay ningun cliente</li>
                @endforelse
            </table>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{ $actas->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('propio/js/actas.js') }}"></script>

    @endsection
</body>


</html>