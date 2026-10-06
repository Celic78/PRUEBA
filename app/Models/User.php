<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'password',
        'role',
        'telefono',
        'edad',
        'direccion',
        'fecha_ultima_cita',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }

    public function formularios()
    {
        return $this->hasMany(FormularioClinico::class, 'paciente_id');
    }

    public function esNutriologo(): bool
    {
        return $this->role === 'nutriologo';
    }
}