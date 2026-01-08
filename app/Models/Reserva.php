<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class Reserva extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre_espacio',
        'usuario_id',
        'fecha_reserva',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    // Una reserva pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
