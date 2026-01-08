<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AccesoControl extends Model
{
    use HasFactory;

    protected $fillable = [
    'tipo_acceso',
    'nombre_visitante',
    'matricula',
    'fecha_hora_entrada',
    'fecha_hora_salida',
    'vivienda_id'
];

public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }

}
