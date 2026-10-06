<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $testimonios = [
            [
                'nombre' => 'María Fernández',
                'comentario' => 'Logré mejorar mis niveles de energía y rendimiento físico en solo 3 meses. ¡Excelente trato personalizado!',
                'meta' => 'Pérdida de peso y tonificación'
            ],
            [
                'nombre' => 'Carlos Mendoza',
                'comentario' => 'El seguimiento médico y las citas han sido clave para controlar mis metas nutricionales.',
                'meta' => 'Control de glucosa y hábitos'
            ],
            [
                'nombre' => 'Sofia Gómez',
                'comentario' => 'Planes muy accesibles, fáciles de seguir y totalmente adaptados a mi estilo de vida.',
                'meta' => 'Recomposición corporal'
            ]
        ];

        return view('landing', compact('testimonios'));
    }
}