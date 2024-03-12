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
                <th>Carnet</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        @forelse ($usuarios as $usuario)
            <tbody>
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->paterno . ' ' . $usuario->materno }}</td>
                    <td>{{ $usuario->carnet }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->roles->first()->name }}</td>
                    </td>
                    <td>
                        @if ($usuario->estado == 1)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Desactivado</span>
                        @endif
                    </td>

                </tr>
            </tbody>
        @empty
            <li>No hay ningun registro de usuarios</li>
        @endforelse
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
