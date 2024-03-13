@extends('dashboard.index1')
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
                        <th>Acciones</th>
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
                        <td colspan="2">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalEditar" onclick="seleccionar(' {{ $datos }} ')" ><i class="fas fa-pen" style="font-size: 15px; "></i></button>
                            @if($acta->estado_act == 1)
                            <button type="button" class="btn btn-danger" onclick="desactivar('{{ route('disabledActa',$acta->id_act) }}', '{{route('actas',$id)}}' )"><i class="fas fa-solid fa-trash" style="font-size: 16px;"  ></i></button>
                            @else
                            <button type="button" class="btn btn-success" onclick="activar('{{ route('enabledActa',$acta->id_act) }}', '{{route('actas',$id)}}' )"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M105.1 202.6c7.7-21.8 20.2-42.3 37.8-59.8c62.5-62.5 163.8-62.5 226.3 0L386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H463.5c0 0 0 0 0 0h.4c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5zM39 289.3c-5 1.5-9.8 4.2-13.7 8.2c-4 4-6.7 8.8-8.1 14c-.3 1.2-.6 2.5-.8 3.8c-.3 1.7-.4 3.4-.4 5.1V448c0 17.7 14.3 32 32 32s32-14.3 32-32V396.9l17.6 17.5 0 0c87.5 87.4 229.3 87.4 316.7 0c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.5 62.5-163.8 62.5-226.3 0l-.1-.1L125.6 352H176c17.7 0 32-14.3 32-32s-14.3-32-32-32H48.4c-1.6 0-3.2 .1-4.8 .3s-3.1 .5-4.6 1z"/></svg></button>
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
    
    <!-- Pantallas emergentes -->
    <div class="modal fade" id="ModalInsertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">NUEVA ACTA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                    <table >
                        <tr>
                            <td style="width:50%"><label class="label">*NOMBRES: </label></td>
                            <td style="width:50%"><input type="text" id="txtNombres" class="input-text" maxlength="25"></input></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PATERNO: </label></td>
                            <td><input type="text" id="txtPaterno" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*MATERNO:</label></td>
                            <td><input type="text" id="txtMaterno" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*EDAD:</label></td>
                            <td><input type="number" id="txtEdad" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PARTIDA: </label></td>
                            <td><input type="date" id="txtPartida" class="input-date" maxlength="10"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PROVINCIA: </label></td>
                            <td><input type="text" id="txtProvincia" class="input-text" maxlength="30"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*DEPARTAMENTO:</label></td>
                            <td>
                                <select class="select" id="txtDepartamento" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" value="Beni">Beni</option>
                                    <option class="opc" value="Cochabamba">Cochabamba</option>
                                    <option class="opc" value="Chuquisaca">Chuquisaca</option>
                                    <option class="opc" value="La Paz">La Paz</option>
                                    <option class="opc" value="Oruro">Oruro</option>
                                    <option class="opc" value="Pando">Pando</option>
                                    <option class="opc" value="Potosi">Potosi</option>
                                    <option class="opc" value="Tarija">Tarija</option>
                                    <option class="opc" value="Santa Cruz">Santa Cruz</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*PAIS: </label></td>
                            <td><input type="text" id="txtPais" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*CAUSA DE MUERTE: </label></td>
                            <td><input type="text" id="txtCausaMuerte" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*CI FAMILIAR: </label></td>
                            <td><input type="text" id="txtFamiliar" class="input-text" maxlength="8"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*RELACION: </label></td>
                            <td><input type="text" id="txtRelacion" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NOMBRE DR: </label></td>
                            <td><input type="text" class="input-text" id="txtNombresDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PATERNO DR: </label></td>
                            <td><input type="text" class="input-text" id="txtPaternoDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*MATERNO DR: </label></td>
                            <td><input type="text" class="input-text" id="txtMaternoDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label ">*CARNET DR: </label></td>
                            <td><input type="text" class="input-text" id="txtCarnetDr"></td>
                        </tr>
                    </table>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-success" id="btnGua" value="btnGuardar" onclick="guardar(' {{ route('saveActa') }} ','{{ route('actas',$id) }}','{{ route('cuarteles',$id) }}')">GUARDAR</button>
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
                            <td><label class="label">*NOMBRES: </label></td>
                            <td><input type="text" id="ModtxtNombres" class="input-text" maxlength="25"></input></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PATERNO: </label></td>
                            <td><input type="text" id="ModtxtPaterno" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*MATERNO:</label></td>
                            <td><input type="text" id="ModtxtMaterno" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*EDAD:</label></td>
                            <td><input type="number" id="ModtxtEdad" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PARTIDA: </label></td>
                            <td><input type="date" id="ModtxtPartida" class="input-text" maxlength="10"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PROVINCIA: </label></td>
                            <td><input type="text" id="ModtxtProvincia" class="input-text" maxlength="25"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*DEPARTAMENTO:</label></td>
                            <td>
                                <select class="select" id="ModtxtDepartamento" value="" >
                                    <option selected disabled></option>
                                    <option class="opc" >Beni</option>
                                    <option class="opc" >Cochabamba</option>
                                    <option class="opc" >Chuquisaca</option>
                                    <option class="opc" >La Paz</option>
                                    <option class="opc" >Oruro</option>
                                    <option class="opc" >Pando</option>
                                    <option class="opc" >Potosi</option>
                                    <option class="opc" >Tarija</option>
                                    <option class="opc" >Santa Cruz</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label class="label">*PAIS: </label></td>
                            <td><input type="text" id="ModtxtPais" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*CAUSA DE MUERTE: </label></td>
                            <td><input type="text" id="ModtxtCausaMuerte" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*CI FAMILIAR: </label></td>
                            <td><input type="text" id="ModtxtFamiliar" class="input-text" maxlength="8"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*RELACION: </label></td>
                            <td><input type="text" id="ModtxtRelacion" class="input-text" maxlength="50"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*NOMBRE DR: </label></td>
                            <td><input type="text" class="input-text" id="ModtxtNombresDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*PATERNO DR: </label></td>
                            <td><input type="text" class="input-text" id="ModtxtPaternoDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*MATERNO DR: </label></td>
                            <td><input type="text" class="input-text" id="ModtxtMaternoDr"></td>
                        </tr>

                        <tr>
                            <td><label class="label">*CARNET DR: </label></td>
                            <td><input type="text" class="input-text" id="ModtxtCarnetDr"></td>
                        </tr>


                    </table>
                    </center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                    <button type="button" class="btn btn-warning" onclick="editar(' {{ route('updateActa') }} ','{{ route('actas',$id) }}')" id="btnEdit" value="btnEditar">EDITAR</button>
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
    <script src="{{ asset('propio/js/actas.js') }}"></script>

    @endsection
</body>


</html>