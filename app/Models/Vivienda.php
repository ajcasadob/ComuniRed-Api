<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function accesosControl(): HasMany
    {
        return $this->hasMany(AccesoControl::class);
    }

    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

}
