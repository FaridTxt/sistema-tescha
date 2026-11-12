<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class CalendarioService
{
    private array $eventos = [];
    private string $rutaJson;
    private string $formatoFecha;
    private array $diasSinClase;

    public function __construct()
    {
        $this->rutaJson = config('calendario.ruta_json');
        $this->formatoFecha = config('calendario.formato_fecha', 'Y-m-d');
        $this->diasSinClase = config('calendario.dias_sin_clase', [1]);
        $this->cargarEventos();
    }

    /**
     * Cargar eventos desde el archivo JSON
     */
    private function cargarEventos(): void
    {
        if (!file_exists($this->rutaJson)) {
            Log::error("No se encontró el archivo de calendario: {$this->rutaJson}");
            $this->eventos = [];
            return;
        }

        $contenido = file_get_contents($this->rutaJson);
        $datos = json_decode($contenido, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Error al decodificar el JSON del calendario: " . json_last_error_msg());
            $this->eventos = [];
            return;
        }

        $this->eventos = $datos['eventos'] ?? [];
    }

    /**
     * Verificar si una fecha es laborable
     */
    public function esFechaLaborable(string $fecha): bool
    {
        if (!$this->esFechaValida($fecha)) {
            return false;
        }

        if ($this->esSuspensionDeLabores($fecha)) {
            return false;
        }

        if ($this->esPeriodoVacacional($fecha)) {
            return false;
        }

        if ($this->esDiaSinClase($fecha)) {
            return false;
        }

        return true;
    }

    /**
     * Verificar si una fecha tiene formato válido
     */
    private function esFechaValida(string $fecha): bool
    {
        $formato = $this->formatoFecha;
        $fechaObj = \DateTime::createFromFormat($formato, $fecha);
        return $fechaObj && $fechaObj->format($formato) === $fecha;
    }

    /**
     * Verificar si una fecha es suspensión de labores
     */
    public function esSuspensionDeLabores(string $fecha): bool
    {
        foreach ($this->eventos as $evento) {
            if ($evento['tipo'] === 'suspension_de_labores' && isset($evento['fecha'])) {
                if ($evento['fecha'] === $fecha) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Verificar si una fecha está dentro de un periodo vacacional
     */
    public function esPeriodoVacacional(string $fecha): bool
    {
        foreach ($this->eventos as $evento) {
            if ($evento['tipo'] === 'periodo_vacacional' && isset($evento['inicio']) && isset($evento['fin'])) {
                if ($fecha >= $evento['inicio'] && $fecha <= $evento['fin']) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Verificar si una fecha es día sin clase
     */
    private function esDiaSinClase(string $fecha): bool
    {
        $diaSemana = (int) date('w', strtotime($fecha));
        // Convertir de formato 'w' (0=domingo) a formato (0=lunes)
        $diaSemanaConvertido = $diaSemana === 0 ? 6 : $diaSemana - 1;
        return in_array($diaSemanaConvertido, $this->diasSinClase);
    }

    /**
     * Obtener todos los eventos que coinciden con una fecha
     */
    public function obtenerEventosPorFecha(string $fecha): array
    {
        $eventos = [];

        foreach ($this->eventos as $evento) {
            $coincide = false;

            if (isset($evento['fecha']) && $evento['fecha'] === $fecha) {
                $coincide = true;
            } elseif (isset($evento['inicio']) && isset($evento['fin'])) {
                if ($fecha >= $evento['inicio'] && $fecha <= $evento['fin']) {
                    $coincide = true;
                }
            }

            if ($coincide) {
                $eventos[] = [
                    'tipo' => $evento['tipo'],
                    'descripcion' => $this->obtenerDescripcionEvento($evento['tipo']),
                ];
            }
        }

        return $eventos;
    }

    /**
     * Obtener descripción de un evento
     */
    private function obtenerDescripcionEvento(string $tipo): string
    {
        $descripciones = [
            'inicio_de_semestre' => 'Inicio de semestre',
            'termino_de_semestre' => 'Término de semestre',
            'suspension_de_labores' => 'Suspensión de labores',
            'registro_nivel_desempeno' => 'Registro del nivel de desempeño',
            'en_el_sistema' => 'En el sistema',
            'periodo_vacacional' => 'Periodo vacacional',
            'actividades_academicas' => 'Actividades académicas',
            'seguimiento_departamental' => 'Seguimiento departamental',
            'retroalimentacion_2da_oportunidad' => 'Retroalimentación de 2da. oportunidad',
            'entrega_boleta_semestral' => 'Entrega de boleta semestral',
            'reinscripcion_estudiantes_regulares' => 'Reinscripción estudiantes regulares',
            'reinscripcion_estudiantes_irregulares' => 'Reinscripción estudiantes irregulares',
            'captura_calificaciones' => 'Captura de calificaciones en el sistema de control escolar',
            'inicio_curso_verano' => 'Inicia curso de verano',
            'fin_curso_verano' => 'Fin de curso de verano',
            'publicacion_cursos_verano' => 'Publicación de cursos de verano',
            'curso_induccion_propedeutico' => 'Curso de inducción y propedéutico',
            'cierre_sistema_informes_finales' => 'Cierre del sistema para informes finales',
            'comite_academico' => 'Comité académico (solicitudes estudiantiles)',
        ];

        return $descripciones[$tipo] ?? $tipo;
    }

    /**
     * Obtener días laborables en un rango
     */
    public function obtenerDiasLaborables(string $inicio, string $fin): array
    {
        $diasLaborables = [];
        $fechaActual = new \DateTime($inicio);
        $fechaFin = new \DateTime($fin);

        while ($fechaActual <= $fechaFin) {
            $fechaStr = $fechaActual->format($this->formatoFecha);
            if ($this->esFechaLaborable($fechaStr)) {
                $diasLaborables[] = $fechaStr;
            }
            $fechaActual->modify('+1 day');
        }

        return $diasLaborables;
    }

    /**
     * Obtener periodo escolar
     */
    public function obtenerPeriodoEscolar(string $ciclo): array
    {
        $periodos = [];

        foreach ($this->eventos as $evento) {
            if ($evento['tipo'] === 'inicio_de_semestre' && isset($evento['fecha'])) {
                $periodos[] = [
                    'inicio' => $evento['fecha'],
                    'tipo' => 'inicio',
                ];
            }
            if ($evento['tipo'] === 'termino_de_semestre' && isset($evento['fecha'])) {
                $periodos[] = [
                    'fin' => $evento['fecha'],
                    'tipo' => 'fin',
                ];
            }
        }

        // Ordenar por fecha
        usort($periodos, function ($a, $b) {
            $fechaA = $a['inicio'] ?? $a['fin'];
            $fechaB = $b['inicio'] ?? $b['fin'];
            return strcmp($fechaA, $fechaB);
        });

        return $periodos;
    }

    /**
     * Obtener eventos por tipo
     */
    public function obtenerEventosPorTipo(string $tipo): array
    {
        $eventos = [];

        foreach ($this->eventos as $evento) {
            if ($evento['tipo'] === $tipo) {
                $eventoData = [
                    'tipo' => $evento['tipo'],
                    'descripcion' => $this->obtenerDescripcionEvento($evento['tipo']),
                ];

                if (isset($evento['fecha'])) {
                    $eventoData['fecha'] = $evento['fecha'];
                }
                if (isset($evento['inicio'])) {
                    $eventoData['inicio'] = $evento['inicio'];
                }
                if (isset($evento['fin'])) {
                    $eventoData['fin'] = $evento['fin'];
                }

                $eventos[] = $eventoData;
            }
        }

        return $eventos;
    }

    /**
     * Obtener todos los eventos
     */
    public function obtenerTodosLosEventos(): array
    {
        return $this->eventos;
    }
}
