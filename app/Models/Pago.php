<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Vivienda;


class Pago extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'vivienda_id',
        'concepto',
        'periodo',
        'importe',
        'estado',
        'fecha_vencimiento',
        'fecha_pago',
    ];

    // Un pago pertenece a una vivienda
    public function vivienda(): BelongsTo
    {
        return $this->belongsTo(Vivienda::class);
    }
}
