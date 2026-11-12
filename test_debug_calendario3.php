<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\CalendarioService;

$calendarioService = new CalendarioService();

echo "--- BUSCANDO PERIODO 2026-2 ---\n\n";

// Buscar el periodo 2026-2 en el calendario
$periodo = $calendarioService->obtenerPeriodoEscolar('2026-2027');

echo "Periodo encontrado: " . json_encode($periodo) . "\n\n";

echo "--- BUSCANDO INICIO Y FIN DE SEMESTRE ---\n\n";

// Buscar inicio y fin de semestre
$inicioSemestre = null;
$finSemestre = null;

foreach ($periodo as $p) {
    if ($p['tipo'] === 'inicio' && $inicioSemestre === null) {
        $inicioSemestre = $p['inicio'];
    }
    if ($p['tipo'] === 'fin') {
        $finSemestre = $p['fin'];
    }
}

echo "Inicio de semestre: " . ($inicioSemestre ?? 'NO ENCONTRADO') . "\n";
echo "Fin de semestre: " . ($finSemestre ?? 'NO ENCONTRADO') . "\n\n";

if ($inicioSemestre && $finSemestre) {
    echo "--- DÍAS LABORABLES EN EL PERIODO 2026-2 ---\n\n";

    $diasLaborables = $calendarioService->obtenerDiasLaborables($inicioSemestre, $finSemestre);

    echo "Total días laborables: " . count($diasLaborables) . "\n\n";

    // Contar por día de la semana
    $porDia = [];
    foreach ($diasLaborables as $fecha) {
        $dia = strtolower(date('l', strtotime($fecha)));
        $porDia[$dia] = ($porDia[$dia] ?? 0) + 1;
    }

    echo "Días laborables por día de la semana:\n";
    foreach ($porDia as $dia => $count) {
        echo "  " . ucfirst($dia) . ": " . $count . "\n";
    }
    echo "\n";

    // Calcular sesiones esperadas (4 días por semana)
    $totalSesiones = 0;
    $horasPorDia = [
        'monday' => 2,
        'tuesday' => 1,
        'wednesday' => 1,
        'thursday' => 2,
    ];

    foreach ($porDia as $dia => $count) {
        if (isset($horasPorDia[$dia])) {
            $totalSesiones += $count;
        }
    }

    echo "Total sesiones esperadas (4 días/semana): " . $totalSesiones . "\n";
}
