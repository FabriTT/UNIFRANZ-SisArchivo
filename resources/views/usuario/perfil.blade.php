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
                    <span class="h1">Datos de la cuenta</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Columna 1: Imagen -->
                    <div class="col-md-5 d-flex align-items-center justify-content-center mx-4"
                        style="background-color: #222222">
                        <div class="avatar" style="width:300px; height:300px;">
                            @if (auth()->user()->imagen !== '')
                                <img src="{{ asset('storage/' . auth()->user()->imagen) }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('storage/PERFILES/defecto.png') }}" alt="..."
                                    class="avatar-img rounded-circle">
                            @endif
                        </div>
                    </div>

                    <!-- Columna 2: 5 Filas con Inputs -->
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col">
                                <label>Nombre:</label>
                                <input type="text" class="form-control"
                                    value="{{ auth()->user()->name . ' ' . auth()->user()->paterno . ' ' . auth()->user()->materno }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Carnet:</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->carnet }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Telefono:</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->telefono }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Correo:</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label>Registrado el:</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->created_at }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    @endsection
</body>



</html>
