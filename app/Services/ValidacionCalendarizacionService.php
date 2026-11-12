<?php

namespace App\Services;

use App\Models\Escenario;

class ValidacionCalendarizacionService
{
    /**
     * Validar un escenario.
     *
     * @return array ['errores' => [], 'advertencias' => []]
     */
    public function validar(Escenario $escenario): array
    {
        $errores = [];
        $advertencias = [];

        // Validar restricciones duras
        $errores = array_merge($errores, $this->validarRestriccionesDuras($escenario));

        // Validar restricciones blandas
        $advertencias = array_merge($advertencias, $this->validarRestriccionesBlandas($escenario));

        return [
            'errores' => $errores,
            'advertencias' => $advertencias,
        ];
    }

    /**
     * Validar restricciones duras.
     */
    private function validarRestriccionesDuras(Escenario $escenario): array
    {
        $errores = [];

        // Verificar que no haya fechas fuera del periodo
        // Verificar que no haya días sin clase
        // Verificar que no haya vacaciones/feriados/suspensiones

        return $errores;
    }

    /**
     * Validar restricciones blandas.
     */
    private function validarRestriccionesBlandas(Escenario $escenario): array
    {
        $advertencias = [];

        // Verificar distribución uniforme
        // Verificar agrupación excesiva
        // Verificar espacios grandes entre actividades

        return $advertencias;
    }

    /**
     * Puntuar un escenario.
     */
    public function puntuar(Escenario $escenario): int
    {
        $validacion = $this->validar($escenario);

        // Si hay errores, puntuación es 0
        if (!empty($validacion['errores'])) {
            return 0;
        }

        // Puntuación base
        $puntuacion = 100;

        // Restar puntos por advertencias
        $puntuacion -= count($validacion['advertencias']) * 5;

        return max(0, $puntuacion);
    }
}
