<?php

namespace Database\Factories;

use App\Models\Competencia;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompetenciaFactory extends Factory
{
    protected $model = Competencia::class;

    public function definition(): array
    {
        return [
            'unidad_id' => Unidad::factory(),
            'numero' => fake()->numberBetween(1, 5),
            'descripcion' => fake()->sentence(),
            'horas_teoria' => 6,
            'horas_practica' => 6,
        ];
    }
}
