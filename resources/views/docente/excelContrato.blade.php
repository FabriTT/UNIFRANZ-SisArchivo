<table>
    <thead>
        <tr>
            <th>Carnet</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Nombre</th>
            <th>Contratos vigentes</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($docentes as $docente)
            <tr>
                <td>{{ $docente->Carnet_doc }}</td>
                <td>{{ $docente->Paterno_doc }}</td>
                <td>{{ $docente->Materno_doc }}</td>
                <td>{{ $docente->Nombres_doc }}</td>
                <td>{{ $docente->Materia_con }}</td>
        @endforeach
    </tbody>
</table>
