<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'ubicacion',
        'categoria',
        'estado',
        'usuario_id',
        'vivienda_id',
        'fecha_resolucion',
        'imagen_url',
    ];

    // Una incidencia pertenece a un usuario (quien la reporta)
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Una incidencia puede pertenecer a una vivienda (nullable)
    public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }
}
