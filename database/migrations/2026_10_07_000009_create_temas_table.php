<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade');
            $table->string('numero');
            $table->string('nombre');
            $table->foreignId('padre_id')->nullable()->constrained('temas')->onDelete('cascade');
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();

            $table->unique(['unidad_id', 'numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temas');
    }
};
