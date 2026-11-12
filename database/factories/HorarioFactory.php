<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    protected $model = Horario::class;

    public function definition(): array
    {
        $dias = ['lunes', 'martes', 'miercoles', 'jueves'];
        $dia = fake()->randomElement($dias);

        $horas = [
            'lunes' => ['12:00', '14:00', 2],
            'martes' => ['11:00', '12:00', 1],
            'miercoles' => ['11:00', '12:00', 1],
            'jueves' => ['12:00', '14:00', 2],
        ];

        return [
            'grupo_id' => Grupo::factory(),
            'dia' => $dia,
            'hora_inicio' => $horas[$dia][0],
            'hora_fin' => $horas[$dia][1],
            'duracion_horas' => $horas[$dia][2],
            'salon' => 'E' . fake()->numberBetween(1, 20),
            'edificio' => 'BICENTENARIO DE LA INDEPENDENCIA',
        ];
    }
}
