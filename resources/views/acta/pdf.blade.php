<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('propio/css/pdf.css') }}" rel="stylesheet">
    <title>Document</title>
    
</head>
<body>
    <center><h1>Reporte de Actas</h1></center>
    <table class="table">
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
                    </tr>
                </thead>
                <tbody>
                @forelse ($actas as $acta)
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
                    </tr>
                @empty
                <li>No hay ningun cliente</li>
                @endforelse
                <tbody>
    </table>
</body>
</html>