@extends('layouts.app')

@section('title', 'Mi Panel - Paciente')
@section('page-title', 'Mi Panel Nutricional')

@section('content')
<!-- Notificaciones de Citas Canceladas -->
@foreach($citasPasadas->merge($citasProximas) as $cita)
    @if($cita->estado === 'cancelada' && $cita->notificacion_cancelacion)
        <div class="card" style="border-left: 5px solid #a83232; background-color: #fef2f2;">
            <h4 style="color: #991b1b; margin-bottom: 0.5rem;">Aviso de Cancelación de Cita</h4>
            <p style="color: #7f1d1d;">{{ $cita->notificacion_cancelacion }}</p>
        </div>
    @endif
@endforeach

<div class="grid-cards" style="grid-template-columns: 2fr 1fr;">
    <!-- Agendar Cita -->
    <div class="card">
        <h2 class="font-playfair" style="margin-bottom: 1.5rem; color: var(--hunter-green);">Agendar Nueva Cita</h2>
        <form action="{{ route('paciente.agendar') }}" method="POST">
            @csrf
            <div class="grid-cards" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                <div class="form-group">
                    <label for="fecha">Selecciona Fecha (Lun - Sáb)</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="hora">Selecciona Horario</label>
                    <select id="hora" name="hora" class="form-control" required>
                        <option value="">-- Horarios Disponibles --</option>
                        @foreach($horariosDisponibles as $horario)
                            <option value="{{ $horario }}">{{ $horario }} hrs</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <h3 class="font-playfair" style="font-size: 1.1rem; margin: 1rem 0; color: var(--hunter-green);">Confirmar Mis Datos</h3>
            <div class="grid-cards" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                <div class="form-group">
                    <label for="telefono">Número Telefónico</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" class="form-control" value="{{ old('edad', $paciente->edad) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_ultima_cita">Fecha de tu última cita (opcional)</label>
                <input type="date" id="fecha_ultima_cita" name="fecha_ultima_cita" class="form-control" value="{{ old('fecha_ultima_cita', $paciente->fecha_ultima_cita) }}">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Confirmar y Agendar Cita</button>
        </form>
    </div>

    <!-- Resumen de Citas -->
    <div>
        <div class="card">
            <h3 class="font-playfair" style="margin-bottom: 1rem;">Próximas Citas</h3>
            @forelse($citasProximas as $cita)
                <div style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-color);">
                    <strong>{{ $cita->fecha }}</strong> a las <strong>{{ $cita->hora }} hrs</strong>
                    <div><span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span></div>
                </div>
            @empty
                <p style="color: var(--text-muted);">No tienes citas próximas agendadas.</p>
            @endforelse
        </div>

        <div class="card">
            <h3 class="font-playfair" style="margin-bottom: 1rem;">Historial de Citas</h3>
            @forelse($citasPasadas as $cita)
                <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border-color); font-size: 0.9rem;">
                    {{ $cita->fecha }} - {{ $cita->hora }} hrs
                    <span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span>
                </div>
            @empty
                <p style="color: var(--text-muted);">No hay citas pasadas registradas.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection