<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vivienda extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'numero_vivienda',
        'bloque',
        'piso',
        'puerta',
        'metros_cuadrados',
        'tipo',
    ];
}
