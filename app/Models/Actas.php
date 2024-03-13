<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actas extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'id_use',
        'nombres_act',
        'paterno_act',
        'materno_act',
        'edad_act',
        'partida_act',
        'provincia_act',
        'departamento_act',
        'pais_act',
        'causaMuerte_act',
        'drNombre_act',
        'drPaterno_act',
        'drMaterno_act',
        'drCarnet_act',
        'relacion_act',
        'fosa_act',
        'estado_act',
    ];

    protected $primaryKey = 'id_act';
}
