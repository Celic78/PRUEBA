<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Helper para obtener citas guardadas
function getCitasGuardadas() {
    $path = storage_path('app/citas.json');
    if (!file_exists($path)) {
        file_put_contents($path, json_encode([]));
    }
    return json_decode(file_get_contents($path), true) ?? [];
}

// Helper para guardar una nueva cita
function guardarCita($nuevaCita) {
    $citas = getCitasGuardadas();
    $citas[] = $nuevaCita;
    file_put_contents(storage_path('app/citas.json'), json_encode($citas, JSON_PRETTY_PRINT));
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page & Vistas
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/recursos', function () { return view('recursos'); })->name('recursos');
Route::get('/nosotros', function () { return view('nosotros'); })->name('nosotros');

// Login & Logout
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::post('/login', function (Request $request) {
    $email = strtolower(trim($request->input('email', '')));
    $password = trim($request->input('password', ''));

    if ($email === 'nutriologo@nutrivida.com' && $password === '12345678') {
        session(['user_role' => 'nutriologo', 'user_name' => 'Dra. Rocío Morales']);
        return redirect()->route('nutriologo.dashboard');
    }

    session(['user_role' => 'paciente', 'user_name' => $email ? explode('@', $email)[0] : 'Paciente', 'user_email' => $email]);
    return redirect()->route('paciente.dashboard');
});

Route::get('/logout', function () {
    session()->forget(['user_role', 'user_name', 'user_email']);
    return redirect()->route('login');
})->name('logout');

// Panel Nutriólogo (Superusuario)
Route::get('/nutriologo', function () {
    if (session('user_role') !== 'nutriologo') {
        return redirect()->route('login');
    }
    $citas = getCitasGuardadas();
    return view('nutriologo.dashboard', compact('citas'));
})->name('nutriologo.dashboard');

// Panel Paciente
Route::get('/paciente', function () {
    if (!session('user_role')) {
        return redirect()->route('login');
    }
    $citas = getCitasGuardadas();
    // Filtra las citas del paciente actual
    $misCitas = array_filter($citas, function($c) {
        return isset($c['email']) && $c['email'] === session('user_email');
    });
    return view('paciente.dashboard', compact('misCitas'));
})->name('paciente.dashboard');

// Agendar Cita (Formulario)
Route::get('/citas', function () {
    $citas = getCitasGuardadas();
    return view('appointments.create', compact('citas'));
})->name('appointments.create');

// Procesar Agendado
Route::post('/citas', function (Request $request) {
    $fecha = $request->input('fecha');
    $hora = $request->input('hora');
    $nombre = $request->input('nombre');
    $email = session('user_email') ?? $request->input('email', 'paciente@gmail.com');

    $citas = getCitasGuardadas();

    // Validar si el horario ya está ocupado en esa fecha
    foreach ($citas as $c) {
        if ($c['fecha'] === $fecha && $c['hora'] === $hora) {
            return back()->with('error', 'El horario seleccionado para esta fecha ya no está disponible. Por favor elige otro.')->withInput();
        }
    }

    $nuevaCita = [
        'id' => uniqid('CITA-'),
        'nombre' => $nombre,
        'email' => $email,
        'fecha' => $fecha,
        'hora' => $hora,
        'motivo' => $request->input('motivo', 'Consulta Nutricional General'),
        'creado_el' => date('Y-m-d H:i')
    ];

    guardarCita($nuevaCita);

    return redirect()->route('citas.pdf', ['id' => $nuevaCita['id']]);
})->name('appointments.store');

// Descarga / Vista de Comprobante PDF de la Cita
Route::get('/citas/pdf/{id}', function ($id) {
    $citas = getCitasGuardadas();
    $cita = null;

    foreach ($citas as $c) {
        if ($c['id'] === $id) {
            $cita = $c;
            break;
        }
    }

    if (!$cita) {
        return redirect()->route('paciente.dashboard');
    }

    return view('appointments.pdf', compact('cita'));
})->name('citas.pdf');