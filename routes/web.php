<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\NutriologoController;

// Landing Pública
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Autenticación Sencilla
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas de Paciente
Route::middleware(['auth', 'role:paciente'])->prefix('paciente')->name('paciente.')->group(function () {
    Route::get('/dashboard', [PacienteController::class, 'dashboard'])->name('dashboard');
    Route::post('/agendar-cita', [PacienteController::class, 'agendarCita'])->name('agendar');
});

// Rutas de Nutriólogo (Superusuario)
Route::middleware(['auth', 'role:nutriologo'])->prefix('nutriologo')->name('nutriologo.')->group(function () {
    Route::get('/dashboard', [NutriologoController::class, 'dashboard'])->name('dashboard');
    
    // Pacientes
    Route::get('/pacientes', [NutriologoController::class, 'pacientes'])->name('pacientes');
    Route::post('/pacientes/registro', [NutriologoController::class, 'registrarPaciente'])->name('pacientes.store');
    Route::post('/pacientes/carga-masiva', [NutriologoController::class, 'cargaMasiva'])->name('pacientes.carga-masiva');
    
    // Citas
    Route::get('/citas', [NutriologoController::class, 'citas'])->name('citas');
    Route::post('/citas/{cita}/cancelar', [NutriologoController::class, 'cancelarCita'])->name('citas.cancelar');

    // Formulario Clínico
    Route::get('/pacientes/{paciente}/formulario', [NutriologoController::class, 'verFormulario'])->name('formulario');
    Route::post('/pacientes/{paciente}/formulario', [NutriologoController::class, 'guardarFormulario'])->name('formulario.store');
});