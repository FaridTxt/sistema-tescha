<?php

namespace Database\Factories;

use App\Models\CalendarioEscolar;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarioEscolarFactory extends Factory
{
    protected $model = CalendarioEscolar::class;

    public function definition(): array
    {
        return [
            'nombre' => 'Calendario ' . fake()->year(),
            'fecha_inicio' => fake()->date(),
            'fecha_fin' => fake()->date(),
            'feriados' => [],
            'vacaciones' => [],
            'suspensiones' => [],
        ];
    }
}
