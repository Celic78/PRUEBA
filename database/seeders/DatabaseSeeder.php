<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Nutriólogo (Superusuario)
        User::create([
            'name' => 'nutriologo',
            'password' => Hash::make('12345678'),
            'role' => 'nutriologo',
            'telefono' => '5551234567',
            'edad' => 35,
            'direccion' => 'Consultorio Nutricional Central, Piso 3',
        ]);

        // 2. 15 Pacientes de Prueba
        $pacientes = [
            ['name' => 'ana.lopez', 'telefono' => '5550001111', 'edad' => 28, 'direccion' => 'Av. Insurgentes 123'],
            ['name' => 'carlos.ruiz', 'telefono' => '5550002222', 'edad' => 34, 'direccion' => 'Calle Reforma 45'],
            ['name' => 'lucia.gomez', 'telefono' => '5550003333', 'edad' => 22, 'direccion' => 'Col. del Valle 89'],
            ['name' => 'miguel.hernandez', 'telefono' => '5550004444', 'edad' => 40, 'direccion' => 'Av. Juárez 312'],
            ['name' => 'sofia.torres', 'telefono' => '5550005555', 'edad' => 31, 'direccion' => 'Calle Hidalgo 67'],
            ['name' => 'david.morales', 'telefono' => '5550006666', 'edad' => 29, 'direccion' => 'Col. Roma 101'],
            ['name' => 'valeria.vargas', 'telefono' => '5550007777', 'edad' => 25, 'direccion' => 'Av. Universidad 500'],
            ['name' => 'jorge.ramirez', 'telefono' => '5550008888', 'edad' => 45, 'direccion' => 'Calle Morelos 12'],
            ['name' => 'elena.castro', 'telefono' => '5550009999', 'edad' => 33, 'direccion' => 'Col. Condesa 33'],
            ['name' => 'fernando.mendoza', 'telefono' => '5550010000', 'edad' => 50, 'direccion' => 'Av. Revolución 88'],
            ['name' => 'patricia.ortiz', 'telefono' => '5550011111', 'edad' => 27, 'direccion' => 'Calle Allende 204'],
            ['name' => 'roberto.flores', 'telefono' => '5550012222', 'edad' => 38, 'direccion' => 'Col. Polanco 55'],
            ['name' => 'gabriela.silva', 'telefono' => '5550013333', 'edad' => 24, 'direccion' => 'Av. Chapultepec 12'],
            ['name' => 'ricardo.reyes', 'telefono' => '5550014444', 'edad' => 36, 'direccion' => 'Calle Zaragoza 78'],
            ['name' => 'camila.navarro', 'telefono' => '5550015555', 'edad' => 30, 'direccion' => 'Col. Nápoles 90'],
        ];

        $horarios = ['10:00', '13:00', '16:00', '17:00'];
        $citaIndex = 0;

        foreach ($pacientes as $paciente) {
            $user = User::create([
                'name' => $paciente['name'],
                'password' => Hash::make('paciente123'),
                'role' => 'paciente',
                'telefono' => $paciente['telefono'],
                'edad' => $paciente['edad'],
                'direccion' => $paciente['direccion'],
                'fecha_ultima_cita' => now()->subDays(rand(10, 60))->toDateString(),
            ]);

            // Asigna fechas y horarios de forma secuencial sin duplicados
            $diaOffset = intdiv($citaIndex, 4) + 1;
            $horaSlot = $horarios[$citaIndex % 4];

            Cita::create([
                'paciente_id' => $user->id,
                'fecha' => now()->addDays($diaOffset)->format('Y-m-d'),
                'hora' => $horaSlot,
                'estado' => 'pendiente',
            ]);

            $citaIndex++;
        }
    }
}