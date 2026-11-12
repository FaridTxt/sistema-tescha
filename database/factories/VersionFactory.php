<?php

namespace Database\Factories;

use App\Models\Calendarizacion;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionFactory extends Factory
{
    protected $model = Version::class;

    public function definition(): array
    {
        return [
            'calendarizacion_id' => Calendarizacion::factory(),
            'version' => fake()->numberBetween(1, 10),
            'cambios' => [],
        ];
    }
}
