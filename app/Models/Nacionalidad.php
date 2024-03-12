<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Nombre_nac',
    ];

    protected $primaryKey = 'Id_nac';
}
