<table>
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
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->paterno . ' ' . $usuario->materno }}</td>
                <td>{{ $usuario->carnet }}</td>
                <td>{{ $usuario->telefono }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->roles->first()->name }}</td>
                <td>
                    @if ($usuario->estado == 1)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Desactivado</span>
                    @endif
                </td>

            </tr>
        @endforeach
    </tbody>
</table>