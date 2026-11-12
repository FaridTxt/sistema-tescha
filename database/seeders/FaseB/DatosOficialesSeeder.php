<?php

namespace Database\Seeders\FaseB;

use App\Models\Asignatura;
use App\Models\CalendarioEscolar;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Periodo;
use Illuminate\Database\Seeder;

class DatosOficialesSeeder extends Seeder
{
    /**
     * Cargar datos oficiales del grupo 4701.
     *
     * Fuentes:
     * - Horarios 2026-2 -Presencial.pdf
     * - Calendario escolar 2026-2027
     * - Temario de Gestión de Proyectos de Software
     */
    public function run(): void
    {
        $this->cargarPeriodo();
        $this->cargarCalendarioEscolar();
        $this->cargarDocente();
        $this->cargarAsignatura();
        $this->cargarGrupo();
        $this->cargarHorario();
    }

    private function cargarPeriodo(): void
    {
        Periodo::updateOrCreate(
            ['nombre' => '2026-2'],
            [
                'fecha_inicio' => '2026-09-01',
                'fecha_fin' => '2027-01-29',
                'semanas' => 22,
            ]
        );
    }

    private function cargarCalendarioEscolar(): void
    {
        CalendarioEscolar::updateOrCreate(
            ['nombre' => 'Calendario 2026-2027'],
            [
                'fecha_inicio' => '2026-09-01',
                'fecha_fin' => '2027-08-30',
                'feriados' => [
                    '2026-09-16', '2026-11-02', '2026-11-16', '2026-12-25',
                    '2027-01-01', '2027-02-01', '2027-03-02', '2027-03-15',
                    '2027-05-01',
                ],
                'vacaciones' => [
                    ['inicio' => '2026-12-21', 'fin' => '2026-12-31'],
                ],
                'suspensiones' => [],
            ]
        );
    }

    private function cargarDocente(): void
    {
        Docente::updateOrCreate(
            ['nombre' => 'Fabiola Garcia Gutierrez'],
            [
                'email' => null,
            ]
        );
    }

    private function cargarAsignatura(): void
    {
        Asignatura::updateOrCreate(
            ['clave' => 'SCG-1009'],
            [
                'nombre' => 'Gestión de Proyectos de Software',
                'ht' => 3,
                'hp' => 3,
                'creditos' => 6,
                'objetivo' => 'Aplica metodologías e instrumentos, para garantizar la gestión adecuada de un proyecto de software.',
                'carrera' => 'Ingeniería en Sistemas Computacionales',
            ]
        );
    }

    private function cargarGrupo(): void
    {
        $docente = Docente::where('nombre', 'Fabiola Garcia Gutierrez')->first();
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        Grupo::updateOrCreate(
            ['nombre' => '4701'],
            [
                'asignatura_id' => $asignatura->id,
                'periodo_id' => $periodo->id,
                'docente_id' => $docente->id,
            ]
        );
    }

    private function cargarHorario(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();

        $horarios = [
            ['dia' => 'lunes', 'hora_inicio' => '12:00', 'hora_fin' => '14:00', 'duracion_horas' => 2],
            ['dia' => 'martes', 'hora_inicio' => '11:00', 'hora_fin' => '12:00', 'duracion_horas' => 1],
            ['dia' => 'miercoles', 'hora_inicio' => '11:00', 'hora_fin' => '12:00', 'duracion_horas' => 1],
            ['dia' => 'jueves', 'hora_inicio' => '12:00', 'hora_fin' => '14:00', 'duracion_horas' => 2],
        ];

        foreach ($horarios as $horario) {
            Horario::updateOrCreate(
                ['grupo_id' => $grupo->id, 'dia' => $horario['dia']],
                [
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fin' => $horario['hora_fin'],
                    'duracion_horas' => $horario['duracion_horas'],
                    'salon' => 'E10',
                    'edificio' => 'BICENTENARIO DE LA INDEPENDENCIA',
                ]
            );
        }
    }
}
