<?php

namespace App\Services;

use Smalot\PdfParser\Parser;

class HorarioService
{
    private string $rutaPdf;

    public function __construct(string $rutaPdf = null)
    {
        $this->rutaPdf = $rutaPdf ?? base_path('docs/Horarios 2026-2 -Presencial.pdf');
    }

    /**
     * Leer el PDF de horarios y extraer datos estructurados
     */
    public function leerHorario(string $grupo, string $materia): array
    {
        if (!file_exists($this->rutaPdf)) {
            throw new \Exception("No se encontró el archivo de horarios: {$this->rutaPdf}");
        }

        $parser = new Parser();
        $pdf = $parser->parseFile($this->rutaPdf);
        $texto = $pdf->getText();

        return $this->extraerHorarioGrupo($texto, $grupo, $materia);
    }

    /**
     * Extraer horario de un grupo y materia específicos
     */
    private function extraerHorarioGrupo(string $texto, string $grupo, string $materia): array
    {
        // Normalizar búsqueda
        $grupo = trim($grupo);
        $materia = strtoupper(trim($materia));

        // Buscar el grupo en el texto
        $posicionGrupo = strpos($texto, $grupo);
        if ($posicionGrupo === false) {
            throw new \Exception("No se encontró el grupo {$grupo} en el PDF");
        }

        // Extraer la sección del grupo (desde el grupo hasta el siguiente grupo o fin del texto)
        $seccionGrupo = $this->extraerSeccionGrupo($texto, $posicionGrupo);

        // Buscar la fila de la materia
        $filaMateria = $this->buscarFilaMateria($seccionGrupo, $materia);
        if ($filaMateria === null) {
            throw new \Exception("No se encontró la materia {$materia} en el grupo {$grupo}");
        }

        // Parsear la fila
        return $this->parsearFila($filaMateria, $grupo);
    }

    /**
     * Extraer la sección del grupo (desde el número de grupo hasta el siguiente)
     */
    private function extraerSeccionGrupo(string $texto, int $posicionGrupo): string
    {
        // Buscar el siguiente grupo (número de 4 dígitos)
        $restoTexto = substr($texto, $posicionGrupo + 4);
        
        // Patrón para encontrar el siguiente grupo (4 dígitos seguidos de tabulación o salto de línea)
        if (preg_match('/\n(\d{4})\t/', $restoTexto, $matches, PREG_OFFSET_CAPTURE)) {
            $posicionSiguienteGrupo = $matches[0][1];
            return substr($restoTexto, 0, $posicionSiguienteGrupo);
        }

        // Si no hay siguiente grupo, tomar el resto del texto
        return $restoTexto;
    }

    /**
     * Buscar la fila de una materia en la sección del grupo
     */
    private function buscarFilaMateria(string $seccionGrupo, string $materia): ?string
    {
        // Dividir por saltos de línea
        $lineas = explode("\n", $seccionGrupo);

        foreach ($lineas as $linea) {
            // Verificar si la línea contiene la materia
            if (stripos($linea, $materia) !== false) {
                return $linea;
            }
        }

        return null;
    }

    /**
     * Parsear una fila de materia
     */
    private function parsearFila(string $fila, string $grupo): array
    {
        // Dividir por tabulaciones
        $partes = explode("\t", $fila);

        // Limpiar partes
        $partes = array_map('trim', $partes);

        // La estructura es:
        // Parte 0: PROFESOR
        // Parte 1: MATERIA + PLAN + EDIFICIO + SALON + HORARIOS (todo pegado)
        // Parte 2+: HORARIOS adicionales (si existen)

        $docente = $partes[0] ?? '';
        $resto = $partes[1] ?? '';

        // Extraer materia, plan, edificio, salón usando regex
        $materia = '';
        $plan = '';
        $edificio = '';
        $salon = '';

        // Buscar el plan (4 dígitos, generalmente 2019)
        if (preg_match('/(\d{4})/', $resto, $matches, PREG_OFFSET_CAPTURE)) {
            $posicionPlan = $matches[0][1];
            $plan = $matches[0][0];

            // La materia es todo lo que está antes del plan
            $materia = trim(substr($resto, 0, $posicionPlan));

            // Después del plan, buscar el salón (generalmente como E10, D1, etc.)
            $despuesPlan = substr($resto, $posicionPlan + 4);

            // Patrón para salón: letra seguida de números (E10, D1, A2, etc.)
            if (preg_match('/([A-Z]\d+)/', $despuesPlan, $matchesSalon, PREG_OFFSET_CAPTURE)) {
                $salon = $matchesSalon[0][0];
                $posicionSalon = $matchesSalon[0][1];

                // El edificio es lo que está entre el plan y el salón
                $edificio = trim(substr($despuesPlan, 0, $posicionSalon));
            }
        }

        // Extraer horarios de TODAS las partes (no solo la primera)
        $horarios = [];
        $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
        $indiceDia = 0;

        // Procesar todas las partes después de la primera
        for ($i = 1; $i < count($partes) && $indiceDia < 5; $i++) {
            $parte = $partes[$i];

            // Buscar todos los horarios en esta parte
            if (preg_match_all('/(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})/', $parte, $matchesHorarios)) {
                foreach ($matchesHorarios[0] as $j => $horarioCompleto) {
                    if ($indiceDia >= 5) {
                        break 2;
                    }

                    $horarios[] = [
                        'dia' => $dias[$indiceDia],
                        'hora_inicio' => $matchesHorarios[1][$j],
                        'hora_fin' => $matchesHorarios[2][$j],
                    ];

                    $indiceDia++;
                }
            }
        }

        return [
            'grupo' => $grupo,
            'docente' => $docente,
            'materia' => $materia,
            'plan' => $plan,
            'edificio' => $edificio,
            'salon' => $salon,
            'horarios' => $horarios,
        ];
    }

    /**
     * Parsear un horario individual
     */
    private function parsearHorario(string $horario): ?array
    {
        // Patrón: HH:MM - HH:MM
        if (preg_match('/(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})/', $horario, $matches)) {
            return [
                'inicio' => $matches[1],
                'fin' => $matches[2],
            ];
        }

        return null;
    }

    /**
     * Calcular horas semanales totales
     */
    public function calcularHorasSemanales(array $horarios): int
    {
        $totalMinutos = 0;

        foreach ($horarios as $horario) {
            $inicio = strtotime($horario['hora_inicio']);
            $fin = strtotime($horario['hora_fin']);
            $totalMinutos += ($fin - $inicio) / 60;
        }

        return (int) ($totalMinutos / 60);
    }
}
