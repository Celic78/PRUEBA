<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validar que la fecha sea de HOY en adelante
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required',
            'notes' => 'nullable|string|max:500',
        ], [
            'appointment_date.after_or_equal' => 'No es posible agendar una cita para un día que ya pasó.',
        ]);

        Appointment::create($validated);

        return redirect()->back()->with('success', 'Cita agendada correctamente.');
    }
}