@extends('layouts.app')

@section('title', 'Gestión de Pacientes')
@section('page-title', 'Directorio de Pacientes')

@section('content')
<div class="grid-cards">
    <!-- Captura Individual -->
    <div class="card">
        <h3 class="font-playfair" style="margin-bottom: 1rem; color: var(--hunter-green);">Nuevo Paciente</h3>
        <form action="{{ route('nutriologo.pacientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre / Usuario</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña inicial</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Registrar Paciente</button>
        </form>
    </div>

    <!-- Carga Masiva CSV -->
    <div class="card">
        <h3 class="font-playfair" style="margin-bottom: 1rem; color: var(--hunter-green);">Carga Masiva (CSV)</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;">
            El archivo CSV debe incluir las columnas: <code>nombre, password, telefono, edad, direccion</code>
        </p>
        <form action="{{ route('nutriologo.pacientes.carga-masiva') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo_csv">Archivo CSV</label>
                <input type="file" id="archivo_csv" name="archivo_csv" class="form-control" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-secondary" style="width: 100%;">Cargar Archivo CSV</button>
        </form>
    </div>
</div>

<div class="card">
    <h3 class="font-playfair" style="margin-bottom: 1rem;">Pacientes Registrados</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Edad</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                    <tr>
                        <td><strong>{{ $paciente->name }}</strong></td>
                        <td>{{ $paciente->telefono ?? 'N/A' }}</td>
                        <td>{{ $paciente->edad ? $paciente->edad . ' años' : 'N/A' }}</td>
                        <td>{{ $paciente->direccion ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('nutriologo.formulario', $paciente->id) }}" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                Expediente Clínico
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection