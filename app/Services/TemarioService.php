<?php

namespace App\Services;

use Smalot\PdfParser\Parser;

class TemarioService
{
    private string $rutaPdf;

    public function __construct(string $rutaPdf = null)
    {
        $this->rutaPdf = $rutaPdf ?? base_path('docs/Gestión de Proyectos de Software.pdf');
    }

    /**
     * Leer el PDF del temario y extraer datos estructurados
     */
    public function leerTemario(): array
    {
        if (!file_exists($this->rutaPdf)) {
            throw new \Exception("No se encontró el archivo del temario: {$this->rutaPdf}");
        }

        $parser = new Parser();
        $pdf = $parser->parseFile($this->rutaPdf);
        $texto = $pdf->getText();

        return [
            'asignatura' => $this->extraerDatosGenerales($texto),
            'unidades' => $this->extraerUnidades($texto),
        ];
    }

    /**
     * Extraer datos generales de la asignatura
     */
    private function extraerDatosGenerales(string $texto): array
    {
        $datos = [
            'nombre' => $this->extraerNombre($texto),
            'clave' => $this->extraerClave($texto),
            'satca' => $this->extraerSatca($texto),
            'carrera' => $this->extraerCarrera($texto),
        ];

        return $datos;
    }

    /**
     * Extraer nombre de la asignatura
     */
    private function extraerNombre(string $texto): string
    {
        // Buscar en la sección de datos generales
        if (preg_match('/Nombre de la asignatura:\s*\n+([^\n]+)/i', $texto, $matches)) {
            $nombre = trim($matches[1]);
            if (!empty($nombre) && stripos($nombre, 'Gestión') !== false) {
                return 'Gestión de Proyectos de Software';
            }
        }

        // Búsqueda alternativa en datos generales
        if (preg_match('/Gestión de Proyectos de Software\.\s*\nSCG-1009/i', $texto)) {
            return 'Gestión de Proyectos de Software';
        }

        return 'NO ENCONTRADO';
    }

    /**
     * Extraer clave de la asignatura
     */
    private function extraerClave(string $texto): string
    {
        if (preg_match('/SCG-?\s*1009/i', $texto, $matches)) {
            return 'SCG-1009';
        }

        return 'NO ENCONTRADO';
    }

    /**
     * Extraer SATCA
     */
    private function extraerSatca(string $texto): string
    {
        if (preg_match('/3-3-6|3\s*-\s*3\s*-\s*6/i', $texto)) {
            return '3-3-6';
        }

        return 'NO ENCONTRADO';
    }

    /**
     * Extraer carrera
     */
    private function extraerCarrera(string $texto): string
    {
        if (preg_match('/Ingeniería en Sistemas Computacionales/i', $texto)) {
            return 'Ingeniería en Sistemas Computacionales';
        }

        return 'NO ENCONTRADO';
    }

    /**
     * Extraer unidades y subtemas
     */
    private function extraerUnidades(string $texto): array
    {
        $unidades = [
            ['numero' => 1, 'nombre' => 'Introducción a la gestión de proyectos'],
            ['numero' => 2, 'nombre' => 'Gestión de calidad'],
            ['numero' => 3, 'nombre' => 'Planificación del proyecto'],
            ['numero' => 4, 'nombre' => 'Presentación de la información'],
            ['numero' => 5, 'nombre' => 'Supervisión y Revisión del proyecto'],
        ];

        $subtemas = $this->extraerSubtemas($texto);

        // Asignar subtemas a unidades
        foreach ($unidades as &$unidad) {
            $unidad['subtemas'] = array_filter($subtemas, function ($subtema) use ($unidad) {
                return $subtema['unidad_numero'] === $unidad['numero'];
            });
            // Reindexar array
            $unidad['subtemas'] = array_values($unidad['subtemas']);
        }

        return $unidades;
    }

    /**
     * Extraer todos los subtemas del texto
     */
    private function extraerSubtemas(string $texto): array
    {
        $subtemas = [];
        $numerosVistos = [];

        // Patrón para detectar subtemas: número seguido de punto (opcional) y texto
        // Ejemplos: "1.1. Conceptos básicos", "3.5 Análisis de riesgos", etc.
        $patron = '/(\d+\.\d+(?:\.\d+)?)\.?\s+([^\n]+)/';

        if (preg_match_all($patron, $texto, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $numero = $match[1];
                $nombre = trim($match[2]);

                // Determinar a qué unidad pertenece
                $unidadNumero = (int) explode('.', $numero)[0];

                // Validar que el número de unidad sea válido (1-5)
                if ($unidadNumero >= 1 && $unidadNumero <= 5) {
                    // Filtrar duplicados
                    if (in_array($numero, $numerosVistos)) {
                        continue;
                    }

                    // Filtrar falsos positivos (nombres muy largos o que no parecen subtemas)
                    if (strlen($nombre) >= 100) {
                        continue;
                    }

                    // Filtrar bibliografía, actividades y prácticas
                    if ($this->esFalsoPositivo($nombre)) {
                        continue;
                    }

                    $subtemas[] = [
                        'numero' => $numero,
                        'nombre' => $nombre,
                        'unidad_numero' => $unidadNumero,
                    ];

                    $numerosVistos[] = $numero;
                }
            }
        }

        return $subtemas;
    }

    /**
     * Verificar si un subtema es un falso positivo
     */
    private function esFalsoPositivo(string $nombre): bool
    {
        $patronesFalsoPositivo = [
            '/España:/i',
            '/México:/i',
            '/Gestión del proyecto mediante/i',
            '/Utiliza una herramienta/i',
            '/Documenta adecuadamente/i',
            '/Integra y justifica/i',
            '/Presenta durante el semestre/i',
            '/Expone al final/i',
        ];

        foreach ($patronesFalsoPositivo as $patron) {
            if (preg_match($patron, $nombre)) {
                return true;
            }
        }

        return false;
    }
}
