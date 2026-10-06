<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cita;
use App\Models\FormularioClinico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NutriologoController extends Controller
{
    public function dashboard()
    {
        $totalPacientes = User::where('role', 'paciente')->count();
        $citasHoy = Cita::where('fecha', now()->toDateString())->where('estado', '!=', 'cancelada')->count();
        $citasPendientes = Cita::where('estado', 'pendiente')->count();
        $proximasCitas = Cita::with('paciente')->where('fecha', '>=', now()->toDateString())->orderBy('fecha', 'asc')->take(5)->get();

        return view('nutriologo.dashboard', compact('totalPacientes', 'citasHoy', 'citasPendientes', 'proximasCitas'));
    }

    public function pacientes()
    {
        $pacientes = User::where('role', 'paciente')->with('formularios')->latest()->get();
        return view('nutriologo.pacientes', compact('pacientes'));
    }

    public function registrarPaciente(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:users,name'],
            'password' => ['required', 'string', 'min:4'],
            'telefono' => ['nullable', 'string'],
            'edad' => ['nullable', 'integer'],
            'direccion' => ['nullable', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'paciente',
            'telefono' => $request->telefono,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
        ]);

        return back()->with('success', 'Paciente registrado exitosamente.');
    }

    public function cargaMasiva(Request $request)
    {
        $request->validate([
            'archivo_csv' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $file = fopen($request->file('archivo_csv')->getRealPath(), 'r');
        $header = fgetcsv($file); // Encabezados: nombre, password, telefono, edad, direccion

        while (($row = fgetcsv($file)) !== FALSE) {
            if (count($row) >= 2) {
                User::updateOrCreate(
                    ['name' => trim($row[0])],
                    [
                        'password' => Hash::make(trim($row[1])),
                        'role' => 'paciente',
                        'telefono' => $row[2] ?? null,
                        'edad' => isset($row[3]) ? (int)$row[3] : null,
                        'direccion' => $row[4] ?? null,
                    ]
                );
            }
        }
        fclose($file);

        return back()->with('success', 'Carga masiva de pacientes completada con éxito.');
    }

    public function citas()
    {
        $citas = Cita::with('paciente')->orderBy('fecha', 'desc')->get();
        return view('nutriologo.citas', compact('citas'));
    }

    public function cancelarCita(Request $request, Cita $cita)
    {
        $request->validate([
            'motivo' => ['required', 'string'],
        ]);

        $cita->update([
            'estado' => 'cancelada',
            'notificacion_cancelacion' => 'Tu cita programada para el ' . $cita->fecha . ' a las ' . $cita->hora . ' hrs fue cancelada. Motivo: ' . $request->motivo,
        ]);

        return back()->with('success', 'La cita fue cancelada y se ha notificado al paciente.');
    }

    public function verFormulario(User $paciente)
    {
        $formularios = FormularioClinico::where('paciente_id', $paciente->id)->latest()->get();
        return view('nutriologo.formulario', compact('paciente', 'formularios'));
    }

    public function guardarFormulario(Request $request, User $paciente)
    {
        $request->validate([
            'peso_kg' => ['required', 'numeric'],
            'estatura_cm' => ['required', 'numeric'],
            'porcentaje_grasa' => ['nullable', 'numeric'],
            'porcentaje_musculo' => ['nullable', 'numeric'],
            'antecedentes_medicos' => ['nullable', 'string'],
            'objetivos' => ['nullable', 'string'],
            'plan_alimenticio' => ['nullable', 'string'],
        ]);

        $estaturaM = $request->estatura_cm / 100;
        $imc = $request->peso_kg / ($estaturaM * $estaturaM);

        FormularioClinico::create([
            'paciente_id' => $paciente->id,
            'peso_kg' => $request->peso_kg,
            'estatura_cm' => $request->estatura_cm,
            'imc' => round($imc, 2),
            'porcentaje_grasa' => $request->porcentaje_grasa,
            'porcentaje_musculo' => $request->porcentaje_musculo,
            'antecedentes_medicos' => $request->antecedentes_medicos,
            'objetivos' => $request->objetivos,
            'plan_alimenticio' => $request->plan_alimenticio,
        ]);

        return back()->with('success', 'Formulario clínico guardado con éxito.');
    }
}