@extends('layouts.app')

@section('title', 'NutriClínica - Tu Salud en Manos Expertas')

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 2rem 1rem;">
    <!-- Banner Principal -->
    <header style="text-align: center; margin-bottom: 4rem; padding-top: 2rem;">
        <h1 class="font-playfair" style="font-size: 3.2rem; color: var(--evergreen); margin-bottom: 1rem;">
            Transforma Tu Vida con Nutrición Profesional
        </h1>
        <p style="font-size: 1.2rem; color: var(--text-muted); max-width: 650px; margin: 0 auto 2rem;">
            Atención totalmente personalizada, seguimiento continuo y planes adaptados a tu ritmo de vida.
        </p>
        <a href="{{ route('login') }}" class="btn btn-secondary" style="font-size: 1.1rem; padding: 1rem 2.5rem;">
            Iniciar Sesión / Agendar Cita
        </a>
    </header>

    <!-- Información del Consultorio -->
    <section class="grid-cards">
        <div class="card">
            <h3 class="font-playfair" style="color: var(--hunter-green); margin-bottom: 0.75rem;">Horarios Flexibles</h3>
            <p>Atención de Lunes a Sábado. 4 bloques de cita por día (10:00, 13:00, 16:00 y 17:00 hrs).</p>
        </div>
        <div class="card">
            <h3 class="font-playfair" style="color: var(--hunter-green); margin-bottom: 0.75rem;">Seguimiento Clínico</h3>
            <p>Evaluación continua con formularios clínicos detallados e historial de citas.</p>
        </div>
        <div class="card">
            <h3 class="font-playfair" style="color: var(--hunter-green); margin-bottom: 0.75rem;">Atención Exclusiva</h3>
            <p>Un solo especialista dedicado 100% a tus objetivos y estilo de vida.</p>
        </div>
    </section>

    <!-- Testimonios -->
    <section style="margin-top: 4rem;">
        <h2 class="font-playfair" style="text-align: center; margin-bottom: 2rem; color: var(--evergreen);">
            Historias de Éxito
        </h2>
        <div class="grid-cards">
            @foreach($testimonios as $testimonio)
                <div class="card">
                    <p style="font-style: italic; margin-bottom: 1rem;">"{{ $testimonio['comentario'] }}"</p>
                    <h4 class="font-playfair" style="color: var(--hunter-green);">{{ $testimonio['nombre'] }}</h4>
                    <span style="font-size: 0.85rem; color: var(--text-muted);">{{ $testimonio['meta'] }}</span>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection