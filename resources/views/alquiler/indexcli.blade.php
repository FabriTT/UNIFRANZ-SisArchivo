@extends('dashboard.index2')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />



    <title>Alquiler</title>

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
                            <h1>Registros de Alquileres</h1>
                        </center>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <form action=" {{route('actas',$id)}} " method="GET">
                                <label for="buscar">Buscar por fecha:&nbsp;</label>
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
                        <th>Cliente</th>
                        <th>Familiar</th>
                        <th>Cuartel</th>
                        <th>Sector</th>
                        <th>Calle</th>
                        <th>Nicho</th>
                        <th>Empleado</th>
                        <th>Alquiler</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                @forelse ($results as $result)
                <tbody>
                    <tr>
                        <td>{{ $result->c_name." ".$result->c_paterno." ".$result->c_materno }}</td>
                        <td>{{ $result->nombres_act." ".$result->paterno_act." ".$result->materno_act }}</td>
                        <td>{{ $result->nombres_cua }}</td>
                        <td>{{ $result->sector_cua}}</td>
                        <td>{{ $result->calle_cua }}</td>
                        <td>{{ "Piso: ".$result->piso_nic }} <br> {{ "Fila: ".$result->fila_nic }} <br> {{ "Columna: ".$result->columna_nic }} </td>
                        <td>{{ $result->name." ".$result->paterno." ".$result->materno }}</td>
                        <td>{{ $result->nombre_alq }}</td>
                        <td>{{ $result->precio_alq }}</td>
                        <td>
                            @if($result->estado_alni == 1)
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
                        {{ $results->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('propio/js/alquiler.js') }}"></script>

    @endsection
</body>


</html>