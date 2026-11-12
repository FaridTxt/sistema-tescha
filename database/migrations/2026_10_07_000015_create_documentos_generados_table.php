<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_generados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('escenario_id')->constrained('escenarios')->onDelete('cascade');
            $table->string('tipo');
            $table->json('contenido')->nullable();
            $table->timestamp('fecha_generacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_generados');
    }
};
