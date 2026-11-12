<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\CalendarioService;

$calendarioService = new CalendarioService();

echo "--- DÍAS LABORABLES (2026-09-01 al 2027-01-29) ---\n\n";

$diasLaborables = $calendarioService->obtenerDiasLaborables('2026-09-01', '2027-01-29');

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

echo "--- PRIMEROS 20 DÍAS LABORABLES ---\n\n";

foreach (array_slice($diasLaborables, 0, 20) as $fecha) {
    $dia = strtolower(date('l', strtotime($fecha)));
    echo $fecha . " (" . ucfirst($dia) . ")\n";
}
echo "\n";

echo "--- ÚLTIMOS 20 DÍAS LABORABLES ---\n\n";

foreach (array_slice($diasLaborables, -20) as $fecha) {
    $dia = strtolower(date('l', strtotime($fecha)));
    echo $fecha . " (" . ucfirst($dia) . ")\n";
}
echo "\n";

echo "--- VERIFICANDO EXCLUSIONES ---\n\n";

// Verificar si hay días laborables en sábado o domingo
$sabados = 0;
$domingos = 0;
foreach ($diasLaborables as $fecha) {
    $dia = strtolower(date('l', strtotime($fecha)));
    if ($dia === 'saturday') $sabados++;
    if ($dia === 'sunday') $domingos++;
}

echo "Sábados laborables: " . $sabados . "\n";
echo "Domingos laborables: " . $domingos . "\n\n";

// Verificar si hay días laborables en días festivos
$diasFestivos = ['2026-09-16', '2026-11-02', '2026-11-16', '2026-12-25', '2027-01-01'];
foreach ($diasFestivos as $festivo) {
    if (in_array($festivo, $diasLaborables)) {
        echo "ERROR: Día festivo encontrado como laborable: " . $festivo . "\n";
    } else {
        echo "OK: Día festivo excluido: " . $festivo . "\n";
    }
}
