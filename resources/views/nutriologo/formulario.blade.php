@extends('layouts.app')

@section('title', 'Expediente Clínico')
@section('page-title', 'Expediente Clínico: ' . $paciente->name)

@section('content')
<div class="grid-cards" style="grid-template-columns: 1fr 2fr;">
    <!-- Formulario para agregar nueva evaluación -->
    <div class="card">
        <h3 class="font-playfair" style="margin-bottom: 1rem; color: var(--hunter-green);">Nueva Evaluación</h3>
        <form action="{{ route('nutriologo.formulario.store', $paciente->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="peso_kg">Peso (kg)</label>
                <input type="number" step="0.1" id="peso_kg" name="peso_kg" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="estatura_cm">Estatura (cm)</label>
                <input type="number" step="0.1" id="estatura_cm" name="estatura_cm" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="porcentaje_grasa">% Grasa (opcional)</label>
                <input type="number" step="0.1" id="porcentaje_grasa" name="porcentaje_grasa" class="form-control">
            </div>
            <div class="form-group">
                <label for="porcentaje_musculo">% Músculo (opcional)</label>
                <input type="number" step="0.1" id="porcentaje_musculo" name="porcentaje_musculo" class="form-control">
            </div>
            <div class="form-group">
                <label for="antecedentes_medicos">Antecedentes Médicos</label>
                <textarea id="antecedentes_medicos" name="antecedentes_medicos" class="form-control" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="objetivos">Objetivos</label>
                <textarea id="objetivos" name="objetivos" class="form-control" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="plan_alimenticio">Plan Alimenticio / Observaciones</label>
                <textarea id="plan_alimenticio" name="plan_alimenticio" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Guardar Registro</button>
        </form>
    </div>

    <!-- Historial de Evaluaciones Clinicas -->
    <div>
        <h3 class="font-playfair" style="margin-bottom: 1rem;">Historial Clínico</h3>
        @forelse($formularios as $form)
            <div class="card">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                    <strong>Fecha: {{ $form->created_at->format('d/m/Y H:i') }}</strong>
                    <span style="color: var(--hunter-green); font-weight: 700;">IMC: {{ $form->imc }}</span>
                </div>
                <div class="grid-cards" style="grid-template-columns: repeat(4, 1fr); margin-bottom: 1rem;">
                    <div><small>Peso</small><p><strong>{{ $form->peso_kg }} kg</strong></p></div>
                    <div><small>Estatura</small><p><strong>{{ $form->estatura_cm }} cm</strong></p></div>
                    <div><small>Grasa</small><p><strong>{{ $form->porcentaje_grasa ?? 'N/A' }} %</strong></p></div>
                    <div><small>Músculo</small><p><strong>{{ $form->porcentaje_musculo ?? 'N/A' }} %</strong></p></div>
                </div>
                @if($form->antecedentes_medicos)
                    <p><strong>Antecedentes:</strong> {{ $form->antecedentes_medicos }}</p>
                @endif
                @if($form->objetivos)
                    <p><strong>Objetivos:</strong> {{ $form->objetivos }}</p>
                @endif
                @if($form->plan_alimenticio)
                    <p style="margin-top: 0.5rem; background-color: var(--input-bg); padding: 0.75rem; border-radius: 8px;">
                        <strong>Plan Alimenticio:</strong><br>{{ $form->plan_alimenticio }}
                    </p>
                @endif
            </div>
        @empty
            <div class="card">
                <p style="color: var(--text-muted);">No hay evaluaciones clínicas registradas aún para este paciente.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection