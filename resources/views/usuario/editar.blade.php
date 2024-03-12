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
            <div class="card-header contenido-header">
                <div class="card-title text-center">
                    <span class="h1">Editar informacion</span>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <form name="form-editar" id="form-editar">
                        @csrf
                        <div class="row">
                            <!-- Primera columna con el formulario -->
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="nombres">*Nombres:</label>
                                        <input type="text" class="form-control" name="nombres" id="nombres"
                                            value="{{ auth()->user()->name }}" maxlength="50">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="paterno">*Paterno:</label>
                                        <input type="text" class="form-control" name="paterno" id="paterno"
                                            value="{{ auth()->user()->paterno }}" maxlength="50">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">*Materno:</label>
                                        <input type="text" class="form-control" name="materno" id="materno"
                                            value="{{ auth()->user()->materno }}" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombres">*Carnet:</label>
                                        <input type="text" class="form-control" name="carnet" id="carnet"
                                            value="{{ auth()->user()->carnet }}" maxlength="8">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="paterno">*Telefono:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            value="{{ auth()->user()->telefono }}" maxlength="8">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="nombres">*Correo:</label>
                                        <input type="text" class="form-control" name="correo" id="correo"
                                            value="{{ auth()->user()->email }}" maxlength="50">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombres">*Contraseña:</label>
                                        <input type="password" class="form-control" name="contraseña" id="contraseña"
                                            maxlength="50">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="check1" id="check1" onchange="mostrarContrasena()">
                                                <span class="form-check-sign">Mostrar</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="paterno">*Confirmar contraseña:</label>
                                        <input type="password" class="form-control" name="confirmar" id="confirmar"
                                            maxlength="50">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="check2" id="check2" onchange="mostrarConfirmar()">
                                                <span class="form-check-sign">Mostrar</span>
                                            </label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="{{ auth()->user()->id }}"
                                        name="id" id="id" maxlength="50" style="display: none">
                                </div>
                            </div>

                            <!-- Segunda columna con dos filas de botones -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 d-flex align-items-center justify-content-center mb-2">
                                        <div class="avatar" style="width:200px; height:200px;">
                                            <img src="{{ asset('storage/PERFILES/defecto.png') }}" alt="..."
                                                class="avatar-img rounded-circle" name="imagen" id="imagen">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="paterno">*Foto de perfil:</label>
                                        <input type="file" class="form-control" name="foto" id="foto">
                                    </div>
                                </div>
                    </form>
                    <div class="row">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center error-container w-50" id="divErrorGuardar"
                                name="divErrorGuardar">
                                <p class="text-danger" id="errorGuardar" name="errorGuardar"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-success"
                                    onclick="Guardar('{{ route('actualizarUsuario') }}','{{ route('perfil') }}')">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
        </div>
        <script>
            var defaultfile = '{{ asset('storage/PERFILES/defecto.png') }}';
        </script>
        <script src="{{ asset('propio/EditarPerfil.js') }}"></script>
    @endsection
</body>



</html>
