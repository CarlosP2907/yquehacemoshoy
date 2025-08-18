<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('place_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_id')->constrained('place')->onDelete('cascade');
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->boolean('is_closed')->default(false); // Para días cerrados
            $table->boolean('is_24_hours')->default(false); // Para lugares abiertos 24 horas
            $table->string('special_note')->nullable(); // Ej: "Solo fines de semana", "Horario especial en temporada"
            $table->timestamps();

            // Índices para optimizar consultas
            $table->index(['place_id', 'day_of_week']);
            $table->unique(['place_id', 'day_of_week']); // Un horario por día por lugar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_schedules');
    }
};
