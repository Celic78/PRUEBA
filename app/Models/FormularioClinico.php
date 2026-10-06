<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormularioClinico extends Model
{
    protected $fillable = [
        'paciente_id',
        'peso_kg',
        'estatura_cm',
        'imc',
        'porcentaje_grasa',
        'porcentaje_musculo',
        'antecedentes_medicos',
        'objetivos',
        'plan_alimenticio',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }
}