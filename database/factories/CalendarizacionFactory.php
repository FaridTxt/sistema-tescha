<?php

namespace Database\Factories;

use App\Models\Calendarizacion;
use App\Models\Grupo;
use App\Models\Periodo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarizacionFactory extends Factory
{
    protected $model = Calendarizacion::class;

    public function definition(): array
    {
        return [
            'periodo_id' => Periodo::factory(),
            'grupo_id' => Grupo::factory(),
            'estado' => fake()->randomElement(['borrador', 'propuesta', 'aceptada']),
            'fecha_creacion' => now(),
        ];
    }
}
