<?php

namespace Database\Factories;

use App\Models\DocumentoGenerado;
use App\Models\Escenario;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentoGeneradoFactory extends Factory
{
    protected $model = DocumentoGenerado::class;

    public function definition(): array
    {
        return [
            'escenario_id' => Escenario::factory(),
            'tipo' => fake()->randomElement(['instrumentacion', 'avancepro']),
            'contenido' => [],
            'fecha_generacion' => now(),
        ];
    }
}
