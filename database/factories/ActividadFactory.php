<?php

namespace Database\Factories;

use App\Models\Actividad;
use App\Models\Tema;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActividadFactory extends Factory
{
    protected $model = Actividad::class;

    public function definition(): array
    {
        return [
            'tema_id' => Tema::factory(),
            'tipo' => fake()->randomElement(['aprendizaje', 'enseñanza']),
            'descripcion' => fake()->sentence(),
        ];
    }
}
