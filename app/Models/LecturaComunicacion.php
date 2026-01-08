<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Comunicacion;
use App\Models\User;


class LecturaComunicacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'comunicacion_id',
        'usuario_id',
        'fecha_lectura',
    ];

    // Una lectura pertenece a una comunicación
    public function comunicacion(): BelongsTo
    {
        return $this->belongsTo(Comunicacion::class);
    }

    // Una lectura pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
