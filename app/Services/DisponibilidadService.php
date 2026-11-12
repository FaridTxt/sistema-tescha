<?php

namespace App\Services;

use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Periodo;

class DisponibilidadService
{
    /**
     * Obtener sesiones reales disponibles entre dos fechas.
     *
     * @return array Lista de sesiones disponibles
     */
    public function obtenerSesionesDisponibles(Periodo $periodo, Grupo $grupo): array
    {
        $sesiones = [];

        // Obtener horario del grupo
        $horario = Horario::where('grupo_id', $grupo->id)->get();

        if ($horario->isEmpty()) {
            return $sesiones;
        }

        // Obtener días laborables del periodo
        $fechaActual = clone $periodo->fecha_inicio;
        $fechaFin = clone $periodo->fecha_fin;

        while ($fechaActual <= $fechaFin) {
            $diaSemanaIngles = strtolower($fechaActual->format('l'));
            $diaSemana = $this->traducirDia($diaSemanaIngles);

            // Buscar si hay horario para este día
            $horarioDia = $horario->firstWhere('dia', $diaSemana);

            if ($horarioDia) {
                $fechaStr = $fechaActual->format('Y-m-d');

                // Verificar si la fecha está bloqueada
                if (!$this->estaBloqueada($fechaStr)) {
                    $horaInicio = is_string($horarioDia->hora_inicio)
                        ? substr($horarioDia->hora_inicio, 0, 5)
                        : $horarioDia->hora_inicio->format('H:i');

                    $horaFin = is_string($horarioDia->hora_fin)
                        ? substr($horarioDia->hora_fin, 0, 5)
                        : $horarioDia->hora_fin->format('H:i');

                    $sesiones[] = [
                        'fecha' => $fechaStr,
                        'dia' => $diaSemana,
                        'hora_inicio' => $horaInicio,
                        'hora_fin' => $horaFin,
                        'duracion_horas' => $horarioDia->duracion_horas,
                    ];
                }
            }

            $fechaActual->modify('+1 day');
        }

        return $sesiones;
    }

    /**
     * Traducir día de la semana de inglés a español.
     */
    private function traducirDia(string $diaIngles): string
    {
        $dias = [
            'monday' => 'lunes',
            'tuesday' => 'martes',
            'wednesday' => 'miercoles',
            'thursday' => 'jueves',
            'friday' => 'viernes',
            'saturday' => 'sabado',
            'sunday' => 'domingo',
        ];

        return $dias[$diaIngles] ?? $diaIngles;
    }

    /**
     * Verificar si una fecha está bloqueada por el calendario escolar.
     */
    private function estaBloqueada(string $fecha): bool
    {
        // Feriados fijos del calendario 2026-2027
        $feriados = [
            '2026-09-16', '2026-11-02', '2026-11-16', '2026-12-25',
            '2027-01-01', '2027-02-01', '2027-03-02', '2027-03-15',
            '2027-05-01',
        ];

        if (in_array($fecha, $feriados)) {
            return true;
        }

        // Vacaciones
        $vacaciones = [
            ['inicio' => '2026-12-21', 'fin' => '2026-12-31'],
        ];

        foreach ($vacaciones as $vacacion) {
            if ($fecha >= $vacacion['inicio'] && $fecha <= $vacacion['fin']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Calcular horas totales de un horario.
     */
    public function calcularHorasHorario(Grupo $grupo): int
    {
        return Horario::where('grupo_id', $grupo->id)->sum('duracion_horas');
    }
}
