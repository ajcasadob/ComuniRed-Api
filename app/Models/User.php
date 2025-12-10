<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un usuario puede reportar múltiples incidencias
    public function incidencias(): HasMany
    {
        return $this->hasMany(Incidencia::class, 'usuario_id');
    }

    // Un usuario puede crear múltiples comunicaciones como autor
    public function comunicaciones(): HasMany
    {
        return $this->hasMany(Comunicacion::class, 'autor_id');
    }

    // Un usuario puede leer múltiples comunicaciones (many-to-many)
    public function comunicacionesLeidas(): BelongsToMany
    {
        return $this->belongsToMany(Comunicacion::class, 'lectura_comunicacions', 'usuario_id', 'comunicacion_id')
                    ->withTimestamps()
                    ->withPivot('fecha_lectura');
    }

    // Un usuario puede tener múltiples reservas
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'usuario_id');
    }
}
