<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Una vivienda puede tener múltiples usuarios (residentes)
    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Una vivienda puede tener múltiples incidencias
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class);
    }

    // Una vivienda puede tener múltiples pagos
    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    
}
