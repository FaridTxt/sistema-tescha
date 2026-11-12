<?php

namespace Database\Factories;

use App\Models\Asignatura;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Periodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->numberBetween(4000, 4999),
            'asignatura_id' => Asignatura::factory(),
            'periodo_id' => Periodo::factory(),
            'docente_id' => Docente::factory(),
        ];
    }
}
