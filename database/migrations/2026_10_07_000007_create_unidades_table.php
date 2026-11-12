<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
            $table->unsignedTinyInteger('numero');
            $table->string('nombre');
            $table->unsignedTinyInteger('horas_teoria')->default(0);
            $table->unsignedTinyInteger('horas_practica')->default(0);
            $table->timestamps();

            $table->unique(['asignatura_id', 'numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
