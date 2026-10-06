@extends('layouts.app')

@section('title', 'Panel de Control - Nutriólogo')
@section('page-title', 'Resumen del Consultorio')

@section('content')
<div class="grid-cards">
    <div class="card">
        <h3 style="color: var(--text-muted); font-size: 0.9rem;">TOTAL PACIENTES</h3>
        <p class="font-playfair" style="font-size: 2.5rem; font-weight: 700;">{{ $totalPacientes }}</p>
    </div>
    <div class="card">
        <h3 style="color: var(--text-muted); font-size: 0.9rem;">CITAS PARA HOY</h3>
        <p class="font-playfair" style="font-size: 2.5rem; font-weight: 700; color: var(--hunter-green);">{{ $citasHoy }}</p>
    </div>
    <div class="card">
        <h3 style="color: var(--text-muted); font-size: 0.9rem;">CITAS PENDIENTES</h3>
        <p class="font-playfair" style="font-size: 2.5rem; font-weight: 700; color: var(--palm-leaf);">{{ $citasPendientes }}</p>
    </div>
</div>

<div class="card">
    <h2 class="font-playfair" style="margin-bottom: 1rem;">Próximas Citas Agendadas</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proximasCitas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->name }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }} hrs</td>
                        <td>{{ $cita->paciente->telefono ?? 'N/A' }}</td>
                        <td><span class="badge badge-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay citas registradas en los próximos días.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection