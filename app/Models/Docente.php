<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_doc',
        'Nombres_doc',
        'Paterno_doc',
        'Materno_doc',
        'Fecha_Nacimiento_doc',
        'Carnet_doc',
        'VencimientoCarnet_doc',
        'Ciudadania_doc',
        'Sexo_doc',
        'Direccion_doc',
        'CorreoPersonal_doc',
        'CorreoCoorporativo_doc',
        'TelefonoParticular_doc',
        'Celular_doc',
        'Foto_Carnet_doc',
        'Foto_Nacimiento_doc',
        'Estado_doc',
        'EmergenciaNombres_doc',
        'EmergenciaPaterno_doc',
        'EmergenciaMaterno_doc',
        'EmergenciaGrado_doc',
        'EmergenciaCelular_doc',
    ];

    protected $primaryKey = 'Id_doc';
}
