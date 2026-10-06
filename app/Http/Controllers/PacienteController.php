<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PacienteController extends Controller
{
    public function dashboard()
    {
        $paciente = Auth::user();
        $citasPasadas = Cita::where('paciente_id', $paciente->id)
            ->where('fecha', '<', now()->toDateString())
            ->orderBy('fecha', 'desc')
            ->get();

        $citasProximas = Cita::where('paciente_id', $paciente->id)
            ->where('fecha', '>=', now()->toDateString())
            ->orderBy('fecha', 'asc')
            ->get();

        $horariosDisponibles = ['10:00', '13:00', '16:00', '17:00'];

        return view('paciente.dashboard', compact('paciente', 'citasPasadas', 'citasProximas', 'horariosDisponibles'));
    }

    public function agendarCita(Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', 'in:10:00,13:00,16:00,17:00'],
            'telefono' => ['required', 'string'],
            'edad' => ['required', 'integer', 'min:1'],
            'direccion' => ['required', 'string'],
            'fecha_ultima_cita' => ['nullable', 'date'],
        ]);

        $fecha = Carbon::parse($request->fecha);

        // Validar que sea de Lunes (1) a Sábado (6)
        if ($fecha->isSunday()) {
            return back()->withErrors(['fecha' => 'Atendemos únicamente de Lunes a Sábado.']);
        }

        // Validar si la cita ya está ocupada
        $existe = Cita::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('estado', '!=', 'cancelada')
            ->exists();

        if ($existe) {
            return back()->withErrors(['hora' => 'Este horario ya se encuentra ocupado para la fecha seleccionada.']);
        }

        // Actualizar datos del paciente
        $user = Auth::user();
        $user->update([
            'telefono' => $request->telefono,
            'edad' => $request->edad,
            'direccion' => $request->direccion,
            'fecha_ultima_cita' => $request->fecha_ultima_cita,
        ]);

        // Registrar cita
        Cita::create([
            'paciente_id' => $user->id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('paciente.dashboard')->with('success', '¡Cita agendada correctamente!');
    }
}