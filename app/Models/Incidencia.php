<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Vivienda;




class Incidencia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'ubicacion',
        'categoria',
        'prioridad',
        'estado',
        'usuario_id',
        'vivienda_id',
        'fecha_resolucion',
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
