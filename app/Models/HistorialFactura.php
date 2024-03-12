<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialFactura extends Model
{
    use HasFactory;

    protected $fillable = [
        'FechaInicio_hfac',
        'FechaFin_hfac',
        'Estado_hfac',
        'Id_doc',
    ];

    protected $primaryKey = 'Id_hfac';
}
