<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialDesactivacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'Motivo_des',
        'Clasificacion_des',
    ];

    protected $primaryKey = 'Id_des';
}
