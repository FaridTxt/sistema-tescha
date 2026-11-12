<?php

namespace Database\Seeders\FaseB;

use App\Models\Asignatura;
use App\Models\Competencia;
use App\Models\Tema;
use App\Models\Unidad;
use Illuminate\Database\Seeder;

class TemarioSeeder extends Seeder
{
    /**
     * Cargar temario de Gestión de Proyectos de Software.
     *
     * Fuente: docs/Gestión de Proyectos de Software.pdf
     */
    public function run(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();

        if (!$asignatura) {
            $this->command->error('No se encontró la asignatura SCG-1009. Ejecute DatosOficialesSeeder primero.');
            return;
        }

        $this->cargarUnidades($asignatura);
    }

    private function cargarUnidades(Asignatura $asignatura): void
    {
        $unidades = [
            [
                'numero' => 1,
                'nombre' => 'Introducción a la gestión de proyectos',
                'horas_teoria' => 6,
                'horas_practica' => 6,
                'competencias' => [
                    ['numero' => 1, 'descripcion' => 'Conoce y comprende el entorno de la gestión de proyectos', 'ht' => 6, 'hp' => 6],
                ],
                'temas' => [
                    ['numero' => '1.1', 'nombre' => 'Conceptos básicos para la gestión de proyectos', 'padre' => null],
                    ['numero' => '1.2', 'nombre' => 'Fases de la gestión de proyectos', 'padre' => null],
                    ['numero' => '1.2.1', 'nombre' => 'Planificación de proyectos', 'padre' => '1.2'],
                    ['numero' => '1.2.2', 'nombre' => 'Propuesta', 'padre' => '1.2'],
                    ['numero' => '1.2.3', 'nombre' => 'Selección y Evaluación de personal', 'padre' => '1.2'],
                    ['numero' => '1.2.4', 'nombre' => 'Supervisión y Revisión del proyecto', 'padre' => '1.2'],
                    ['numero' => '1.2.5', 'nombre' => 'Informes', 'padre' => '1.2'],
                    ['numero' => '1.3', 'nombre' => 'Fundamentos de Project Management Institute', 'padre' => null],
                ],
            ],
            [
                'numero' => 2,
                'nombre' => 'Gestión de calidad',
                'horas_teoria' => 6,
                'horas_practica' => 6,
                'competencias' => [
                    ['numero' => 2, 'descripcion' => 'Identifica y selecciona estándares y métricas de calidad para ser aplicados a un proyecto de software', 'ht' => 6, 'hp' => 6],
                ],
                'temas' => [
                    ['numero' => '2.1', 'nombre' => 'Plan de calidad del software', 'padre' => null],
                    ['numero' => '2.2', 'nombre' => 'La gestión de proyectos usando un marco de calidad', 'padre' => null],
                    ['numero' => '2.3', 'nombre' => 'Estándares y Métricas de calidad en la ingeniería de software', 'padre' => null],
                    ['numero' => '2.3.1', 'nombre' => 'CMMI', 'padre' => '2.3'],
                    ['numero' => '2.3.2', 'nombre' => 'MoProSoft', 'padre' => '2.3'],
                    ['numero' => '2.4', 'nombre' => 'Impacto de la calidad en tiempo, costo y alcance del proyecto', 'padre' => null],
                    ['numero' => '2.5', 'nombre' => 'Control del cambio', 'padre' => null],
                ],
            ],
            [
                'numero' => 3,
                'nombre' => 'Planificación del proyecto',
                'horas_teoria' => 9,
                'horas_practica' => 9,
                'competencias' => [
                    ['numero' => 3, 'descripcion' => 'Planifica un proyecto de software utilizando una metodología de trabajo para determinar su viabilidad', 'ht' => 9, 'hp' => 9],
                ],
                'temas' => [
                    ['numero' => '3.1', 'nombre' => 'Objetivo del proyecto', 'padre' => null],
                    ['numero' => '3.2', 'nombre' => 'Estimaciones de tiempo', 'padre' => null],
                    ['numero' => '3.3', 'nombre' => 'Estimaciones de costos', 'padre' => null],
                    ['numero' => '3.4', 'nombre' => 'Estimación de personal requerido', 'padre' => null],
                    ['numero' => '3.5', 'nombre' => 'Análisis de riesgos', 'padre' => null],
                    ['numero' => '3.5.1', 'nombre' => 'Tipos de riesgos', 'padre' => '3.5'],
                    ['numero' => '3.5.2', 'nombre' => 'Identificación, Impacto y proyección del riesgo', 'padre' => '3.5'],
                    ['numero' => '3.5.3', 'nombre' => 'Evaluación del riesgo', 'padre' => '3.5'],
                    ['numero' => '3.5.4', 'nombre' => 'Estrategias frente al riesgo', 'padre' => '3.5'],
                    ['numero' => '3.6', 'nombre' => 'Análisis de la viabilidad del proyecto', 'padre' => null],
                ],
            ],
            [
                'numero' => 4,
                'nombre' => 'Presentación de la información',
                'horas_teoria' => 6,
                'horas_practica' => 6,
                'competencias' => [
                    ['numero' => 4, 'descripcion' => 'Identifica y selecciona propuestas de proyecto de software para la presentación de un contrato al cliente', 'ht' => 6, 'hp' => 6],
                ],
                'temas' => [
                    ['numero' => '4.1', 'nombre' => 'Propuesta', 'padre' => null],
                    ['numero' => '4.1.1', 'nombre' => 'Justificación del proyecto', 'padre' => '4.1'],
                    ['numero' => '4.1.2', 'nombre' => 'Calendario de actividades', 'padre' => '4.1'],
                    ['numero' => '4.1.3', 'nombre' => 'Personal involucrado', 'padre' => '4.1'],
                    ['numero' => '4.1.4', 'nombre' => 'Políticas de comunicación y seguimiento', 'padre' => '4.1'],
                    ['numero' => '4.2', 'nombre' => 'Lineamientos de comunicación y seguimiento', 'padre' => null],
                    ['numero' => '4.2.1', 'nombre' => 'Formatos', 'padre' => '4.2'],
                    ['numero' => '4.2.2', 'nombre' => 'Herramientas', 'padre' => '4.2'],
                    ['numero' => '4.3', 'nombre' => 'Contrato', 'padre' => null],
                ],
            ],
            [
                'numero' => 5,
                'nombre' => 'Supervisión y Revisión del proyecto',
                'horas_teoria' => 9,
                'horas_practica' => 9,
                'competencias' => [
                    ['numero' => 5, 'descripcion' => 'Aplica políticas de comunicación y seguimiento para la mejora del proyecto de software', 'ht' => 9, 'hp' => 9],
                ],
                'temas' => [
                    ['numero' => '5.1', 'nombre' => 'Administración de actividades', 'padre' => null],
                    ['numero' => '5.2', 'nombre' => 'Administración del tiempo', 'padre' => null],
                    ['numero' => '5.3', 'nombre' => 'Evaluación y ajustes del proyecto', 'padre' => null],
                ],
            ],
        ];

        $ordenGlobal = 0;

        foreach ($unidades as $unidadData) {
            $unidad = Unidad::updateOrCreate(
                ['asignatura_id' => $asignatura->id, 'numero' => $unidadData['numero']],
                [
                    'nombre' => $unidadData['nombre'],
                    'horas_teoria' => $unidadData['horas_teoria'],
                    'horas_practica' => $unidadData['horas_practica'],
                ]
            );

            foreach ($unidadData['competencias'] as $compData) {
                Competencia::updateOrCreate(
                    ['unidad_id' => $unidad->id, 'numero' => $compData['numero']],
                    [
                        'descripcion' => $compData['descripcion'],
                        'horas_teoria' => $compData['ht'],
                        'horas_practica' => $compData['hp'],
                    ]
                );
            }

            $temasPorNumero = [];

            foreach ($unidadData['temas'] as $temaData) {
                $ordenGlobal++;

                $padreId = null;
                if ($temaData['padre'] && isset($temasPorNumero[$temaData['padre']])) {
                    $padreId = $temasPorNumero[$temaData['padre']];
                }

                $tema = Tema::updateOrCreate(
                    ['unidad_id' => $unidad->id, 'numero' => $temaData['numero']],
                    [
                        'nombre' => $temaData['nombre'],
                        'padre_id' => $padreId,
                        'orden' => $ordenGlobal,
                    ]
                );

                $temasPorNumero[$temaData['numero']] = $tema->id;
            }
        }
    }
}
