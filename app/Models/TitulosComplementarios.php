<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitulosComplementarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_tit',
        'Tipo_tit',
        'Descripcion_tit',
        'Fecha_tit',
        'fotocopia_tit',
        'Id_doc',
    ];

    protected $primaryKey = 'Id_tit';
}
