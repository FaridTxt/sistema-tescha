<?php

namespace Database\Factories;

use App\Models\Tema;
use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemaFactory extends Factory
{
    protected $model = Tema::class;

    public function definition(): array
    {
        return [
            'unidad_id' => Unidad::factory(),
            'numero' => fake()->numberBetween(1, 5) . '.' . fake()->numberBetween(1, 5),
            'nombre' => fake()->words(3, true),
            'padre_id' => null,
            'orden' => fake()->numberBetween(1, 100),
        ];
    }
}
