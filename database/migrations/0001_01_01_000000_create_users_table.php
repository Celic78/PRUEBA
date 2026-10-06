<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('password');
            $table->enum('role', ['nutriologo', 'paciente'])->default('paciente');
            $table->string('telefono')->nullable();
            $table->integer('edad')->nullable();
            $table->text('direccion')->nullable();
            $table->date('fecha_ultima_cita')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};