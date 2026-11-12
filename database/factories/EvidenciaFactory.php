<?php

namespace Database\Factories;

use App\Models\Competencia;
use App\Models\Evidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvidenciaFactory extends Factory
{
    protected $model = Evidencia::class;

    public function definition(): array
    {
        return [
            'competencia_id' => Competencia::factory(),
            'nombre' => fake()->words(3, true),
            'porcentaje' => fake()->randomFloat(2, 10, 50),
            'indicador' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
        ];
    }
}
