<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccesoControl extends Model
{
    use HasFactory;

    protected $fillable = [
    'tipo_acceso',
    'nombre_visitante',
    'matricula',
    'fecha_hora_entrada',
    'fecha_hora_salida',
];

public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }

}
