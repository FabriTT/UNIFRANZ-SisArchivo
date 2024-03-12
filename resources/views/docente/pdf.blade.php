<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/pdf.css') }}">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha de Nacimiento</th>
                <th>Carnet</th>
                <th>Vencimiento del Carnet</th>
                <th>Ciudadania</th>
                <th>Sexo</th>
                <th>Direccion</th>
                <th>Telefono Particular</th>
                <th>Celular</th>
                <th>Correo Personal</th>
                <th>Correo Coorporativo</th>
                <th>Fotocopia de carnet</th>
                <th>Fotocopia certificado nacimiento</th>
                <th>Contacto de emergencia</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->Nombres_doc }}</td>
                    <td>{{ $docente->Paterno_doc . ' ' . $docente->Materno_doc }}</td>
                    <td>{{ $docente->Fecha_Nacimiento_doc }}</td>
                    <td>{{ $docente->Carnet_doc }}</td>
                    <td>{{ $docente->VencimientoCarnet_doc }}</td>
                    <td>{{ $docente->Ciudadania_doc }}</td>
                    <td>{{ $docente->Sexo_doc }}</td>
                    <td>{{ $docente->Direccion_doc }}</td>
                    <td>{{ $docente->TelefonoParticular_doc }}</td>
                    <td>{{ $docente->Celular_doc }}</td>
                    <td>{{ $docente->CorreoPersonal_doc }}</td>
                    <td>{{ $docente->CorreoCoorporativo_doc }}</td>
                    <td>
                        @if ($docente->Foto_Carnet_doc !== null)
                            SI
                        @else
                            NO
                        @endif
                    </td>
                    <td>
                        @if ($docente->Foto_Nacimiento_doc !== null)
                            SI
                        @else
                            NO
                        @endif
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
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        // JavaScript para ajustar el tamaño de la letra
        document.addEventListener("DOMContentLoaded", function() {
            // Altura máxima de la página en puntos (puedes ajustar este valor)
            var maxHeight = 800;

            // Altura actual del contenido
            var contentHeight = document.body.scrollHeight;

            // Calcular el nuevo tamaño de la letra para que el contenido quepa en una página
            var newSize = Math.floor((maxHeight / contentHeight) * parseFloat(window.getComputedStyle(document.body)
                .fontSize));

            // Aplicar el nuevo tamaño de la letra
            document.body.style.fontSize = newSize + "pt";
        });
    </script>
</body>

</html>
