<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosComplementarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id_com',
        'Tipo_com',
        'Descripcion_com',
        'Fecha_com',
        'fotocopia_com',
        'Id_doc',
    ];

    protected $primaryKey = 'Id_com';
}
