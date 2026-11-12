<?php

namespace Database\Factories;

use App\Models\Asignatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsignaturaFactory extends Factory
{
    protected $model = Asignatura::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),
            'clave' => 'SCG-' . fake()->unique()->numberBetween(1000, 9999),
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => fake()->sentence(),
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ];
    }
}
