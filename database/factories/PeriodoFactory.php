<?php

namespace Database\Factories;

use App\Models\Periodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodoFactory extends Factory
{
    protected $model = Periodo::class;

    public function definition(): array
    {
        return [
            'nombre' => '2026-' . fake()->numberBetween(1, 3),
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->date(),
            'semanas' => 22,
        ];
    }
}
