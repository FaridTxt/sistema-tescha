<?php

namespace Database\Factories;

use App\Models\Evaluacion;
use App\Models\Evidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluacionFactory extends Factory
{
    protected $model = Evaluacion::class;

    public function definition(): array
    {
        return [
            'evidencia_id' => Evidencia::factory(),
            'fecha' => fake()->date(),
            'tipo' => fake()->randomElement(['diagnostica', 'formativa', 'sumativa']),
        ];
    }
}
