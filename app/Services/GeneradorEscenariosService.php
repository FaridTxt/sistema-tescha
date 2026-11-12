<?php

namespace App\Services;

class GeneradorEscenariosService
{
    private CalendarioService $calendarioService;

    public function __construct(CalendarioService $calendarioService)
    {
        $this->calendarioService = $calendarioService;
    }

    /**
     * Generar escenarios de calendarización
     */
    public function generar(array $datosAsignatura): array
    {
        $nombre = $datosAsignatura['nombre'] ?? '';
        $grupo = $datosAsignatura['grupo'] ?? '';
        $cicloEscolar = $datosAsignatura['ciclo_escolar'] ?? '';
        $fechaInicio = $datosAsignatura['fecha_inicio'] ?? '';
        $fechaFin = $datosAsignatura['fecha_fin'] ?? '';
        $horasSemanales = $datosAsignatura['horas_semanales'] ?? 6;
        $unidades = $datosAsignatura['unidades'] ?? [];

        // Obtener días laborables del calendario
        $diasLaborables = $this->calendarioService->obtenerDiasLaborables($fechaInicio, $fechaFin);

        // Distribuir temas en los días laborables
        $escenario = [];
        $indiceDia = 0;
        $advertencias = [];

        foreach ($unidades as $unidad) {
            $nombreUnidad = $unidad['nombre'] ?? '';
            $temas = $unidad['temas'] ?? [];

            foreach ($temas as $tema) {
                if ($indiceDia >= count($diasLaborables)) {
                    $advertencias[] = "No hay suficientes fechas laborables para cubrir todos los temas.";
                    break 2;
                }

                $escenario[] = [
                    'fecha' => $diasLaborables[$indiceDia],
                    'unidad' => $nombreUnidad,
                    'tema' => $tema,
                    'estado' => 'Programado',
                ];

                $indiceDia++;
            }
        }

        // Verificar si hay fechas disponibles sin asignar
        $fechasSinAsignar = count($diasLaborables) - $indiceDia;
        if ($fechasSinAsignar > 0) {
            $advertencias[] = "Hay {$fechasSinAsignar} fechas laborables disponibles sin asignar.";
        }

        return [
            'asignatura' => [
                'nombre' => $nombre,
                'grupo' => $grupo,
                'ciclo_escolar' => $cicloEscolar,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'horas_semanales' => $horasSemanales,
            ],
            'escenarios' => [$escenario],
            'advertencias' => $advertencias,
            'total_dias_laborables' => count($diasLaborables),
            'total_temas_asignados' => count($escenario),
        ];
    }
}
