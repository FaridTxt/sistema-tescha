<?php

namespace App\Services;

use App\Models\Calendarizacion;
use App\Models\Grupo;
use App\Models\Periodo;

class CalendarizacionService
{
    private DisponibilidadService $disponibilidadService;

    public function __construct(DisponibilidadService $disponibilidadService)
    {
        $this->disponibilidadService = $disponibilidadService;
    }

    /**
     * Construir una calendarización base.
     */
    public function construirBase(Periodo $periodo, Grupo $grupo): Calendarizacion
    {
        $calendarizacion = Calendarizacion::create([
            'periodo_id' => $periodo->id,
            'grupo_id' => $grupo->id,
            'estado' => 'borrador',
            'fecha_creacion' => now(),
        ]);

        return $calendarizacion;
    }

    /**
     * Obtener sesiones disponibles para un grupo.
     */
    public function obtenerSesionesDisponibles(Periodo $periodo, Grupo $grupo): array
    {
        return $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);
    }

    /**
     * Calcular horas totales del horario de un grupo.
     */
    public function calcularHorasHorario(Grupo $grupo): int
    {
        return $this->disponibilidadService->calcularHorasHorario($grupo);
    }
}
