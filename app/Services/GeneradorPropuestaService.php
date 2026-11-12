<?php

namespace App\Services;

class GeneradorPropuestaService
{
    private CalendarioService $calendarioService;

    // Carga estimada por subtema en unidades de carga (NO horas oficiales)
    // Un subtema típico requiere aproximadamente 1.5 horas de clase
    private const CARGA_POR_SUBTEMA = 1.5;

    public function __construct(CalendarioService $calendarioService)
    {
        $this->calendarioService = $calendarioService;
    }

    /**
     * Generar propuesta de avance programático
     */
    public function generar(array $temario, array $horario, string $fechaInicio, string $fechaFin): array
    {
        $advertencias = [];

        // 1. Generar sesiones reales disponibles (cruza calendario + horario del grupo)
        $sesiones = $this->generarSesionesReales($horario, $fechaInicio, $fechaFin);

        if (empty($sesiones)) {
            $advertencias[] = "No se encontraron sesiones disponibles para el periodo indicado.";
        }

        // 2. Obtener todos los subtemas en orden
        $todosLosSubtemas = $this->obtenerTodosLosSubtemas($temario);

        // 3. Distribuir subtemas en sesiones usando TODAS las sesiones disponibles
        $periodos = $this->distribuirSubtemasEnSesiones($temario, $todosLosSubtemas, $sesiones);

        // 4. Verificar subtemas pendientes
        $subtemasAsignados = $this->contarSubtemasAsignados($periodos);
        $subtemasPendientes = count($todosLosSubtemas) - $subtemasAsignados;

        if ($subtemasPendientes > 0) {
            $advertencias[] = "Quedaron {$subtemasPendientes} subtemas sin asignar.";
        }

        return [
            'asignatura' => $temario['asignatura'],
            'horario' => $horario,
            'periodos' => $periodos,
            'resumen' => [
                'total_sesiones' => count($sesiones),
                'total_horas' => $this->calcularTotalHoras($sesiones),
                'subtemas_totales' => count($todosLosSubtemas),
                'subtemas_asignados' => $subtemasAsignados,
                'subtemas_pendientes' => $subtemasPendientes,
                'sesiones_con_contenido' => $this->contarSesionesConContenido($periodos),
            ],
            'advertencias' => $advertencias,
        ];
    }

    /**
     * Generar sesiones reales cruzando días laborables con horario del grupo
     */
    private function generarSesionesReales(array $horario, string $fechaInicio, string $fechaFin): array
    {
        $sesiones = [];

        // Obtener días laborables del calendario
        $diasLaborables = $this->calendarioService->obtenerDiasLaborables($fechaInicio, $fechaFin);

        // Obtener días de clase del grupo
        $diasDeClase = $this->obtenerDiasDeClase($horario);

        // Cruzar días laborables con días de clase
        foreach ($diasLaborables as $fecha) {
            $diaSemana = strtolower($this->obtenerDiaSemana($fecha));

            if (isset($diasDeClase[$diaSemana])) {
                $sesiones[] = [
                    'fecha' => $fecha,
                    'dia' => $diaSemana,
                    'hora_inicio' => $diasDeClase[$diaSemana]['hora_inicio'],
                    'hora_fin' => $diasDeClase[$diaSemana]['hora_fin'],
                    'duracion_horas' => $this->calcularDuracionHoras(
                        $diasDeClase[$diaSemana]['hora_inicio'],
                        $diasDeClase[$diaSemana]['hora_fin']
                    ),
                ];
            }
        }

        return $sesiones;
    }

    /**
     * Obtener días de clase del grupo desde el horario
     */
    private function obtenerDiasDeClase(array $horario): array
    {
        $diasDeClase = [];

        foreach ($horario['horarios'] as $h) {
            $diasDeClase[$h['dia']] = [
                'hora_inicio' => $h['hora_inicio'],
                'hora_fin' => $h['hora_fin'],
            ];
        }

        return $diasDeClase;
    }

    /**
     * Obtener día de la semana en español desde nombre en inglés
     */
    private function obtenerDiaSemana(string $fecha): string
    {
        $dias = [
            'sunday' => 'domingo',
            'monday' => 'lunes',
            'tuesday' => 'martes',
            'wednesday' => 'miercoles',
            'thursday' => 'jueves',
            'friday' => 'viernes',
            'saturday' => 'sabado',
        ];

        $diaIngles = strtolower(date('l', strtotime($fecha)));
        return $dias[$diaIngles] ?? '';
    }

    /**
     * Calcular duración en horas entre dos horas
     */
    private function calcularDuracionHoras(string $inicio, string $fin): int
    {
        $inicioMinutos = $this->horaAMinutos($inicio);
        $finMinutos = $this->horaAMinutos($fin);

        return (int) round(($finMinutos - $inicioMinutos) / 60);
    }

    /**
     * Convertir hora a minutos
     */
    private function horaAMinutos(string $hora): int
    {
        list($horas, $minutos) = explode(':', $hora);
        return ((int) $horas * 60) + (int) $minutos;
    }

    /**
     * Obtener todos los subtemas en orden
     */
    private function obtenerTodosLosSubtemas(array $temario): array
    {
        $subtemas = [];

        foreach ($temario['unidades'] as $unidad) {
            foreach ($unidad['subtemas'] as $subtema) {
                $subtemas[] = [
                    'numero' => $subtema['numero'],
                    'nombre' => $subtema['nombre'],
                    'unidad_numero' => $unidad['numero'],
                ];
            }
        }

        return $subtemas;
    }

    /**
     * Distribuir subtemas en sesiones con continuidad
     * 
     * Lógica:
     * - Recorrer TODAS las sesiones cronológicamente
     * - Asignar 1-2 subtemas por sesión según capacidad
     * - Permitir que un subtema continúe en la siguiente sesión
     * - Usar todas las 56 sesiones disponibles
     */
    private function distribuirSubtemasEnSesiones(array $temario, array $todosLosSubtemas, array $sesiones): array
    {
        $periodos = [];
        $totalSesiones = count($sesiones);
        $totalSubtemas = count($todosLosSubtemas);
        $indiceSubtema = 0;

        foreach ($sesiones as $indiceSesion => $sesion) {
            $capacidadSesion = $sesion['duracion_horas'];
            $subtemasSesion = [];
            $cargaAcumulada = 0;

            // Calcular cuántos subtemas caben en esta sesión
            // Sesiones de 1 hora: 1-2 subtemas
            // Sesiones de 2 horas: 2-3 subtemas
            $maxSubtemas = $capacidadSesion + 1;

            // Llenar la sesión con subtemas
            while ($indiceSubtema < $totalSubtemas && count($subtemasSesion) < $maxSubtemas) {
                $subtema = $todosLosSubtemas[$indiceSubtema];
                $subtemasSesion[] = $subtema;
                $cargaAcumulada += self::CARGA_POR_SUBTEMA;
                $indiceSubtema++;
            }

            // Determinar unidad del periodo
            if (empty($subtemasSesion)) {
                $unidadNumero = null;
                $nombreUnidad = 'Sin contenido';
            } else {
                $unidadNumero = $subtemasSesion[0]['unidad_numero'];
                $nombreUnidad = $this->obtenerNombreUnidad($temario, $unidadNumero);
            }

            $periodos[] = [
                'unidad' => $unidadNumero ?? 0,
                'nombre_unidad' => $nombreUnidad,
                'subtemas' => $subtemasSesion,
                'fecha_inicio' => $sesion['fecha'],
                'fecha_fin' => $sesion['fecha'],
                'sesiones' => [
                    [
                        'fecha' => $sesion['fecha'],
                        'dia' => $sesion['dia'],
                        'hora_inicio' => $sesion['hora_inicio'],
                        'hora_fin' => $sesion['hora_fin'],
                        'duracion_horas' => $sesion['duracion_horas'],
                    ]
                ],
                'horas' => $sesion['duracion_horas'],
                'carga_estimada' => $cargaAcumulada,
                'estado' => empty($subtemasSesion) ? 'Sin contenido' : 'Programado',
            ];
        }

        return $periodos;
    }

    /**
     * Obtener nombre de la unidad por número
     */
    private function obtenerNombreUnidad(array $temario, int $numero): string
    {
        foreach ($temario['unidades'] as $unidad) {
            if ($unidad['numero'] === $numero) {
                return $unidad['nombre'];
            }
        }
        return '';
    }

    /**
     * Contar subtemas asignados (únicos)
     */
    private function contarSubtemasAsignados(array $periodos): int
    {
        $subtemasUnicos = [];
        foreach ($periodos as $periodo) {
            foreach ($periodo['subtemas'] as $subtema) {
                $subtemasUnicos[$subtema['numero']] = true;
            }
        }
        return count($subtemasUnicos);
    }

    /**
     * Contar sesiones con contenido
     */
    private function contarSesionesConContenido(array $periodos): int
    {
        $total = 0;
        foreach ($periodos as $periodo) {
            if (count($periodo['subtemas']) > 0) {
                $total += count($periodo['sesiones']);
            }
        }
        return $total;
    }

    /**
     * Calcular total de horas
     */
    private function calcularTotalHoras(array $sesiones): int
    {
        return array_sum(array_column($sesiones, 'duracion_horas'));
    }
}
