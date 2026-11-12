<?php

namespace Database\Factories;

use App\Models\Asignatura;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
    protected $model = Unidad::class;

    public function definition(): array
    {
        return [
            'asignatura_id' => Asignatura::factory(),
            'numero' => fake()->numberBetween(1, 5),
            'nombre' => fake()->words(3, true),
            'horas_teoria' => 6,
            'horas_practica' => 6,
        ];
    }
}
