<?php

namespace App\Http\Controllers;

use App\Services\CalendarioService;
use App\Services\GeneradorEscenariosService;
use Illuminate\Http\Request;

class PlaneacionController extends Controller
{
    /**
     * Mostrar página de generador de escenarios
     */
    public function escenarios(Request $request)
    {
        $resultado = null;

        if ($request->has('nombre')) {
            $datosAsignatura = [
                'nombre' => $request->input('nombre'),
                'grupo' => $request->input('grupo'),
                'ciclo_escolar' => $request->input('ciclo_escolar'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_fin' => $request->input('fecha_fin'),
                'horas_semanales' => (int) $request->input('horas_semanales', 6),
            ];

            // Parsear unidades y temas del textarea
            $unidadesTemas = $request->input('unidades_temas', '');
            $datosAsignatura['unidades'] = $this->parsearUnidadesTemas($unidadesTemas);

            $calendarioService = new CalendarioService();
            $generadorService = new GeneradorEscenariosService($calendarioService);
            $resultado = $generadorService->generar($datosAsignatura);
        }

        return view('planeacion.escenarios', ['resultado' => $resultado]);
    }

    /**
     * Parsear string de unidades y temas
     * Formato: "Unidad 1: Tema 1, Tema 2 | Unidad 2: Tema 1, Tema 2"
     */
    private function parsearUnidadesTemas(string $texto): array
    {
        $unidades = [];

        if (empty($texto)) {
            return $unidades;
        }

        // Separar por pipe (|)
        $partes = explode('|', $texto);

        foreach ($partes as $parte) {
            $parte = trim($parte);
            if (empty($parte)) {
                continue;
            }

            // Separar nombre de unidad de temas
            if (strpos($parte, ':') !== false) {
                list($nombreUnidad, $temasStr) = explode(':', $parte, 2);
                $nombreUnidad = trim($nombreUnidad);
                $temas = array_map('trim', explode(',', $temasStr));

                $unidades[] = [
                    'nombre' => $nombreUnidad,
                    'temas' => $temas,
                ];
            }
        }

        return $unidades;
    }
}
