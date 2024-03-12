<table>
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

            <th>Cuenta</th>
            <th>Banco</th>
            <th>Copia de cuenta bancaria </th>

            <th>Profesion</th>
            <th>Fecha de titulo profesional</th>
            <th>Fototcopia de titulo profesional</th>
            <th>Grado Academico</th>
            <th>Fecha de provision nacional</th>
            <th>Fototcopia de provision nacional</th>
            <th>Fecha de educacion superior</th>
            <th>Fototcopia de educacion superior</th>

            <th>Titulos complementarios</th>

            <th>Fototcopia de curriculum vitae</th>
            <th>Años de experiencia</th>
            <th>Respaldo de experiencia</th>

            <th>Fecha de la clase modelo</th>
            <th>Fotocopia de la clase modelo</th>
            <th>Fecha del evaluar</th>
            <th>Fotocopia del evaluar</th>
            <th>Calificacion del evaluar</th>
            
            <th>Documentos complementarios</th>

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
                <td>{{ $docente->Nombre_nac }}</td>
                <td>{{ $docente->Sexo_doc }}</td>
                <td>{{ $docente->Direccion_doc }}</td>
                <td>{{ $docente->TelefonoParticular_doc }}</td>
                <td>{{ $docente->Celular_doc }}</td>
                <td>{{ $docente->CorreoPersonal_doc }}</td>
                <td>{{ $docente->CorreoCoorporativo_doc }}</td>
                <td>
                    @if ($docente->Foto_Carnet_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>
                    @if ($docente->Foto_Nacimiento_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{ $docente->EmergenciaNombres_doc . ' ' . $docente->EmergenciaPaterno_doc . ' ' . $docente->EmergenciaMaterno_doc . ' ' . $docente->EmergenciaGrado_doc . ' ' . $docente->EmergenciaCelular_doc }}
                </td>
                <td>{{ $docente->NumeroCuenta_doc }}</td>
                <td>{{ $docente->Nombre_ban }}</td>
                <td>
                    @if ($docente->Foto_Cuenta_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{ $docente->Profesion_doc }}</td>
                <td>{{ $docente->Fecha_titulo_doc }}</td>
                <td>
                    @if ($docente->Foto_titulo_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{ $docente->GradoAcademico_doc }}</td>
                <td>{{ $docente->Fecha_provision_nacional_doc }}</td>
                <td>
                    @if ($docente->Foto_provision_nacional_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{ $docente->Fecha_educacion_superior_doc }}</td>
                <td>
                    @if ($docente->Foto_educacion_superior_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{$docente->titulos}}</td>
                <td>
                    @if ($docente->Foto_curriculum_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{$docente->Años_experiencia_doc}}</td>
                <td>
                    @if ($docente->Foto_experiencia_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{$docente->Fecha_clase_modelo_doc}}</td>
                <td>
                    @if ($docente->Foto_clase_modelo_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{$docente->Fecha_evaluar_doc}}</td>
                <td>
                    @if ($docente->Foto_evaluar_doc !== null)
                        &#10003;
                    @else
                        X
                    @endif
                </td>
                <td>{{$docente->Calificacion_evaluar_doc}}</td>
                <td>{{$docente->documentos}}</td>
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
