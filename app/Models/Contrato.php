<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_con',
        'Fecha_con',
        'Materia_con',
        'Foto_contraro_con',
        'Evaluacion_calificacion_con',
        'Fecha_evaluacion_con',
        'Foto_evaluacion_con',
        'Estado_con',
        'Id_doc',
    ];

    protected $primaryKey = 'Id_con';
}
