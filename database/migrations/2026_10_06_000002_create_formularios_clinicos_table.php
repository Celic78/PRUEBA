<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formularios_clinicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('users')->onDelete('cascade');
            $table->decimal('peso_kg', 5, 2);
            $table->decimal('estatura_cm', 5, 2);
            $table->decimal('imc', 4, 2);
            $table->decimal('porcentaje_grasa', 4, 2)->nullable();
            $table->decimal('porcentaje_musculo', 4, 2)->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->text('objetivos')->nullable();
            $table->text('plan_alimenticio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formularios_clinicos');
    }
};