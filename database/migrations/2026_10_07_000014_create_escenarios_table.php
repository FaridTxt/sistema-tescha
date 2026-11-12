<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escenarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendarizacion_id')->constrained('calendarizaciones')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('estado')->default('propuesta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escenarios');
    }
};
