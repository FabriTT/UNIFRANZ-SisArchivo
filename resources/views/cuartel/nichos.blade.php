@extends('dashboard.index1')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />



    <title>Cuartel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>
    
    @section('content')
    <label for="" id="Latitud" style="display:none">{{ $nichos[0]->latitud_cua }}</label>
    <label for="" id="Longitud" style="display:none">{{ $nichos[0]->longitud_cua }}</label>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card" >
                    <div class="card-body">
                        <center>
                            <h1>Registros de alquiler de nicho</h1>
                        </center>
                        <hr>
                        <div class="">
                            <table>
                                <tr>
                                    <td style="width:200px"> <label class="label">*NOMBRE DEL CUARTEL: </label></td>
                                    <td style="width:200px"> <label class="label" >{{ $nichos[0]->nombres_cua }}</label></td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*UBICACION DEL CUARTEL: </label></td>
                                    <td> <label class="label">{{ $nichos[0]->sector_cua.", ".$nichos[0]->calle_cua }}</label></td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*PISO DEL NICHO: </label></td>
                                    <td> <label class="label" id="txtPiso">---</label></td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*FILA DEL NICHO: </label></td>
                                    <td> <label class="label" id="txtFila">---</label></td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*COLUMNA DEL NICHO: </label></td>
                                    <td> <label class="label" id="txtColumna">---</label></td>
                                </tr>
                                <tr>
                                    <td><label class="label">*CARNET DEL CLIENTE: </label></td>
                                    <td><input type="number" id="txtCarnetCli" class="input-text" maxlength="3"></td>
                                    <td><button class="btn btn-secondary" type="button" onclick="buscarCliente(' {{route('buscarCliente')}} ')"><i class="fas fa-sharp fa-solid fa-search"></i></button></td>
                                </tr>
                                <tr>
                                    <td> <label class="label" style="margin-top:10px">*CLIENTE: </label></td>
                                    <td> <label class="label" style="margin-top:10px" id="txtCliente">---</label></td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*FAMILIAR DEL CLIENTE: </label></td>
                                    <td>
                                        <select class="select" id="txtActa" >
                                            <option selected disabled></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label class="label">*TIPO ALQUILER: </label></td>
                                    <td>
                                        <select class="select" id="txtAlquiler" value="" onchange="total({{$alquileres}})" >
                                            
                                            <option selected disabled></option>
                                            @foreach($alquileres as $alquiler)
                                            <option class="opc" value="{{ $alquiler->id_alq}}" >{{ $alquiler->nombre_alq }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td> <label class="label" style="margin-top:10px">*TOTAL: </label></td>
                                    <td> <label class="label" style="margin-top:10px" id="txtTotal">---</label></td>
                                </tr>
                            </table>
                            <hr>
                            <td><button class="btn btn-success" type="button" onclick="Guardar('{{ route('saveAlquilerNicho')}}','{{ route('alquileres',$id)}}')">REGISTRAR</button></td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <label for="" id="ECuartel" style="display:none">{{ $nichos[0]->id_cua }}</label>
    <label for="" id="EPiso" style="display:none"></label>
    <label for="" id="EFila" style="display:none"></label>
    <label for="" id="EColumna" style="display:none"></label>
    <label for="" id="ECliente" style="display:none"></label>
    <label for="" id="EActa" style="display:none"></label>
    <label for="" id="EEmpleado" style="display:none">{{ $id }}</label>
    <label for="" id="EAlquiler" style="display:none"></label>


    <div style="background:white;">
            <hr>
            <div class="table-responsive">
                @php 
                    $cont=0;
                @endphp
                @for ($p = $nichos[0]->pisos_cua; $p >= 1; $p--)
                <h1>PISO {{ $p }}</h1>
                    <table class="table table-hover my-0">
                        <thead>
                        </thead>
                        <tbody>        
                        @for ($i = $nichos[0]->nfilas_cua; $i >= 1; $i--)
                            <tr>
                                @for ($j = 1; $j <= $nichos[0]->ncolumnas_cua; $j++)
                                @php 
                                    $cont++;
                                @endphp 
                                <td>
                                    @if($nichos[($cont)-1]->estado_nic == 1)
                                     
                                    <img src="{{ asset('propio/img/nicho.png') }}"  width="40px" style="background:red" onclick="seleccionar('{{ $p }}','{{ $i }}','{{ $j }}')">
                                    @else
                                    <img src="{{ asset('propio/img/nicho.png') }}" id="{{ $p.''.$i.''.$j}}" width="40px" onclick="seleccionar('{{ $p }}','{{ $i }}','{{ $j }}')">
                                    @endif
                                </td>
                            @endfor
                            </tr>
                        @endfor        
                        </tbody>
                    </table>
                @endfor

        </div>
    </div>

    <br>
    <hr>
    <br>

    <div id="map">

    </div>
                        


  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('propio/js/nichos.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
    @endsection
</body>


</html>