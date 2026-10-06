<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'paciente_id',
        'fecha',
        'hora',
        'estado',
        'notificacion_cancelacion',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }
}