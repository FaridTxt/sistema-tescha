<?php

namespace Database\Factories;

use App\Models\Calendarizacion;
use App\Models\Escenario;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscenarioFactory extends Factory
{
    protected $model = Escenario::class;

    public function definition(): array
    {
        return [
            'calendarizacion_id' => Calendarizacion::factory(),
            'nombre' => fake()->words(2, true),
            'descripcion' => fake()->sentence(),
            'estado' => fake()->randomElement(['propuesta', 'seleccionado', 'descartado']),
        ];
    }
}
