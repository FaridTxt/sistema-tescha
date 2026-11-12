<?php

namespace App\Services;

use App\Models\Calendarizacion;
use App\Models\Escenario;

class EscenarioService
{
    /**
     * Generar escenario Uniforme.
     */
    public function generarUniforme(Calendarizacion $calendarizacion): Escenario
    {
        return Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Uniforme',
            'descripcion' => 'Distribución equilibrada de actividades a lo largo del periodo',
            'estado' => 'propuesta',
            'sesiones' => [],
            'puntuacion' => 0,
        ]);
    }

    /**
     * Generar escenario Compacto.
     */
    public function generarCompacto(Calendarizacion $calendarizacion): Escenario
    {
        return Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Compacto',
            'descripcion' => 'Prioriza completar unidades/temas en bloques más concentrados',
            'estado' => 'propuesta',
            'sesiones' => [],
            'puntuacion' => 0,
        ]);
    }

    /**
     * Generar escenario Extendido.
     */
    public function generarExtendido(Calendarizacion $calendarizacion): Escenario
    {
        return Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Extendido',
            'descripcion' => 'Distribuye las actividades con mayor separación temporal posible',
            'estado' => 'propuesta',
            'sesiones' => [],
            'puntuacion' => 0,
        ]);
    }
}
