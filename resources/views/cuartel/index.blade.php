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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h1>Registros de Cuarteles</h1>
                        </center>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <form action=" {{route('actas',$id)}} " method="GET">
                                <label for="buscar">Buscar por nombre:&nbsp;</label>
                                <input type="text" class="" placeholder="Nombre" style="width: 200px;" name="buscar" id="buscar">
                                <button class="btn btn-secondary" type="submit"><i class="fas fa-sharp fa-solid fa-search"></i></button>
                                </form>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalInsertar">Nuevo <i class="fas fa-solid fa-plus"></i></button>
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
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descuento</th>
                        <th>Capacidad</th>
                        <th>Pisos</th>
                        <th>Numeros de filas</th>
                        <th>Numeros de columnas</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Sector</th>
                        <th>Calle</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @forelse ($cuarteles as $cuartel)
                @php 
                $datos = 
                $cuartel->id_cua."||"
                .$cuartel->nombres_cua."||"
                .$cuartel->tipoPersona_cua."||"
                .$cuartel->descuento_cua."||"
                .$cuartel->capacidad_cua."||"
                .$cuartel->pisos_cua."||"
                .$cuartel->nfilas_cua."||"
                .$cuartel->ncolumnas_cua."||"
                .$cuartel->latitud_cua."||"
                .$cuartel->longitud_cua."||"
                .$cuartel->sector_cua."||"
                .$cuartel->calle_cua."||"
                .$cuartel->estado_cua
                @endphp
                <tbody>
                    <tr>
                        <td>{{ $cuartel->nombres_cua }}</td>
                        <td>{{ $cuartel->tipoPersona_cua }}</td>
                        <td>{{ $cuartel->descuento_cua }}</td>
                        <td>{{ $cuartel->capacidad_cua }}</td>
                        <td>{{ $cuartel->pisos_cua }}</td>
                        <td>{{ $cuartel->nfilas_cua }}</td>
                        <td>{{ $cuartel->ncolumnas_cua }}</td>
                        <td>{{ $cuartel->longitud_cua }}</td>
                        <td>{{ $cuartel->latitud_cua }}</td>
                        <td>{{ $cuartel->sector_cua }}</td>
                        <td>{{ $cuartel->calle_cua }}</td>
                        <td>
                            @if($cuartel->estado_cua == 1)
                            <span class="badge bg-success">Activo</span>
                            @else
                            <span class="badge bg-danger">Desactivado</span>
                            @endif
                        </td>
                        <td colspan="2">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar" onclick="seleccionar(' {{ $datos }} ')" ><i class="fas fa-pen" style="font-size: 15px; "></i></button>
                            @if($cuartel->estado_cua == 1)
                            <button type="button" class="btn btn-danger" onclick="desactivar('{{ route('disabledCuartel',$cuartel->id_cua) }}', '{{route('cuarteles',$id)}}' )"><i class="fas fa-solid fa-trash" style="font-size: 16px;"  ></i></button>
                            @else
                            <button type="button" class="btn btn-success" onclick="activar('{{ route('enabledCuartel',$cuartel->id_cua) }}', '{{route('cuarteles',$id)}}' )"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg></button>
                            @endif
                            <a type="button" class="btn btn-secondary" href=" {{  route('nichos',['cod' => $id, 'id' => $cuartel->id_cua]) }} " ><i class="fas fa-cross" style="font-size: 17px; "></i></a>
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
                        {{ $cuarteles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pantallas emergentes -->
    <div class="modal fade" id="ModalInsertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">NUEVO CUARTEL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                    <table >
                        <tr>
                            <td style="width:50%"><label class="label">*NOMBRE: </label></td>
                            <td style="width:50%"><input type="text" id="txtNombre" class="input-text" maxlength="50"></input></td>
                        </tr>

                        <tr>
                            <td><label class="label">*TIPO: </label></td>
                            <td>
                                <select class="select" id="txtTipo" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" value="Publico">Publico</option>
                                    <option class="opc" value="Privado">Privado</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*DESCUENTO:</label></td>
                            <td><input type="number" id="txtDescuento" class="input-text" maxlength="3"></td>
                        </tr>


                        <tr>
                            <td><label class="label">*PISOS: </label></td>
                            <td><input type="number" id="txtPisos" class="input-text" maxlength="10"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NUMEROS DE FILAS: </label></td>
                            <td><input type="number" id="txtNfilas" class="input-text" maxlength="30"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NUMEROS DE COLUMNAS:</label></td>
                            <td><input type="number" id="txtNcolumnas" class="input-text" maxlength="30"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*LATITUD: </label></td>
                            <td><input type="number" id="txtLatitud" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*LONGITUD: </label></td>
                            <td><input type="number" id="txtLongitud" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*SECTOR: </label></td>
                            <td>
                                <select class="select" id="txtSector" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" value="Turistico">Turistico</option>
                                    <option class="opc" value="Ensanche">Ensanche</option>
                                    <option class="opc" value="Ampliacion">Ampliacion</option>
                                    <option class="opc" value="Antiguo">Antiguo</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*CALLE: </label></td>
                            <td><input type="text" id="txtCalle" class="input-text" maxlength="50"></td>
                        </tr>

                    </table>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-success" id="btnGua" value="btnGuardar" onclick="guardar(' {{ route('saveCuartel') }} ','{{ route('cuarteles',$id) }}')">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">EDITAR DATOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                    <table>
                        <tr>
                            <td style="width:50%"><label class="label ">ID: </label> </td>
                            <td style="width:50%"><label id="ModtxtId" class="label"></td>
                        </tr>
                        <tr>
                            <td style="width:50%"><label class="label">*NOMBRE: </label></td>
                            <td style="width:50%"><input type="text" id="ModtxtNombre" class="input-text" maxlength="50"></input></td>
                        </tr>

                        <tr>
                            <td><label class="label">*TIPO: </label></td>
                            <td>
                                <select class="select" id="ModtxtTipo" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" value="Publico">Publico</option>
                                    <option class="opc" value="Privado">Privado</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*DESCUENTO:</label></td>
                            <td><input type="number" id="ModtxtDescuento" class="input-text" maxlength="3"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PISOS: </label></td>
                            <td><input type="number" id="ModtxtPisos" class="input-text" maxlength="10" disabled=""></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NUMEROS DE FILAS: </label></td>
                            <td><input type="number" id="ModtxtNfilas" class="input-text" maxlength="30" disabled=""></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NUMEROS DE COLUMNAS:</label></td>
                            <td><input type="number" id="ModtxtNcolumnas" class="input-text" maxlength="30" disabled=""></td>
                        </tr>

                        <tr>
                            <td><label class="label">*LATITUD: </label></td>
                            <td><input type="number" id="ModtxtLatitud" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*LONGITUD: </label></td>
                            <td><input type="number" id="ModtxtLongitud" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*SECTOR: </label></td>
                            <td>
                                <select class="select" id="ModtxtSector" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" value="Turistico">Turistico</option>
                                    <option class="opc" value="Ensanche">Ensanche</option>
                                    <option class="opc" value="Ampliacion">Ampliacion</option>
                                    <option class="opc" value="Antiguo">Antiguo</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*CALLE: </label></td>
                            <td><input type="text" id="ModtxtCalle" class="input-text" maxlength="50"></td>
                        </tr>


                    </table>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-warning" onclick="editar(' {{ route('updateCuartel') }} ','{{ route('cuarteles',$id) }}')" id="btnEdit" value="btnEditar">EDITAR</button>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="ModalPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">GENERAR REPORTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pdfActa') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <center>
                        <table>
                            <tr>
                                <td><label class="label">*FECHA DE INICIO: </label></td>
                                <td><input type="date" id="txtInicio" class="input-text" maxlength="10" name="inicio"></td>
                            </tr>
                            <tr>
                                <td><label class="label">*FECHA FINAL: </label></td>
                                <td><input type="date" id="txtFinal" class="input-text" maxlength="10" name="fin"></td>
                            </tr>

                            
                        </table>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <button type="submit" class="btn btn-danger"  id="" value="">GENERAR PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  

  

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('propio/js/cuarteles.js') }}"></script>

    @endsection
</body>


</html>