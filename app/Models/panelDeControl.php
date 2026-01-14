<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class panelDeControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'configuracion',
        'preferencias',
        'notificaciones',
        'tema',
    ];
}
