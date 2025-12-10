<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titulo',
        'contenido',
        'tipo',
        'autor_id',
        'fecha_publicacion',
        'activa',
    ];

    
    public function autor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autor_id');
    }
    public function lectores(): BelongsToMany
    {
    return $this->belongsToMany(User::class, 'lectura_comunicacions', 'comunicacion_id', 'usuario_id')
                ->withTimestamps()
                ->withPivot('fecha_lectura');
    }

}
