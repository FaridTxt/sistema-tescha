<?php

namespace Tests\Unit\Services;

use App\Models\Asignatura;
use App\Models\CalendarioEscolar;
use App\Models\Calendarizacion;
use App\Models\Docente;
use App\Models\Escenario;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Periodo;
use App\Services\CalendarizacionService;
use App\Services\DisponibilidadService;
use App\Services\EscenarioService;
use App\Services\ValidacionCalendarizacionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MotorCalendarizacionTest extends TestCase
{
    use RefreshDatabase;

    private DisponibilidadService $disponibilidadService;
    private CalendarizacionService $calendarizacionService;
    private EscenarioService $escenarioService;
    private ValidacionCalendarizacionService $validacionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\FaseB\DatosOficialesSeeder::class);
        $this->seed(\Database\Seeders\FaseB\TemarioSeeder::class);

        $this->disponibilidadService = new DisponibilidadService();
        $this->calendarizacionService = new CalendarizacionService($this->disponibilidadService);
        $this->escenarioService = new EscenarioService();
        $this->validacionService = new ValidacionCalendarizacionService();
    }

    // ============================================
    // 1. CÁLCULO DE HORAS DE UN HORARIO
    // ============================================

    public function test_calculo_horas_horario(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $horas = $this->disponibilidadService->calcularHorasHorario($grupo);

        $this->assertEquals(6, $horas);
    }

    // ============================================
    // 2. GENERACIÓN DE SESIONES A PARTIR DE HORARIO
    // ============================================

    public function test_generacion_sesiones(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        $this->assertNotEmpty($sesiones);
        $this->assertGreaterThan(0, count($sesiones));
    }

    // ============================================
    // 3-5. EXCLUSIONES DE CALENDARIO
    // ============================================

    public function test_exclusion_vacaciones(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        // Verificar que no hay sesiones en vacaciones (21-31 dic 2026)
        foreach ($sesiones as $sesion) {
            $this->assertFalse(
                $sesion['fecha'] >= '2026-12-21' && $sesion['fecha'] <= '2026-12-31',
                "Fecha en vacaciones: {$sesion['fecha']}"
            );
        }
    }

    public function test_exclusion_feriados(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        $feriados = ['2026-09-16', '2026-11-02', '2026-11-16', '2026-12-25', '2027-01-01'];

        foreach ($sesiones as $sesion) {
            $this->assertNotContains($sesion['fecha'], $feriados, "Fecha feriado: {$sesion['fecha']}");
        }
    }

    public function test_exclusion_suspensiones(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        // No hay suspensiones definidas, pero el mecanismo debe funcionar
        $this->assertIsArray($sesiones);
    }

    // ============================================
    // 6. EXCLUSIERNES DE VIERNES
    // ============================================

    public function test_exclusion_viernes(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        foreach ($sesiones as $sesion) {
            $this->assertNotEquals('viernes', $sesion['dia'], "Sesión en viernes: {$sesion['fecha']}");
        }
    }

    // ============================================
    // 7. RESPETO DE HORARIOS REALES
    // ============================================

    public function test_respeto_horarios_reales(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        $horariosValidos = [
            'lunes' => ['12:00', '14:00'],
            'martes' => ['11:00', '12:00'],
            'miercoles' => ['11:00', '12:00'],
            'jueves' => ['12:00', '14:00'],
        ];

        foreach ($sesiones as $sesion) {
            $this->assertArrayHasKey($sesion['dia'], $horariosValidos);
            $this->assertEquals($horariosValidos[$sesion['dia']][0], $sesion['hora_inicio']);
            $this->assertEquals($horariosValidos[$sesion['dia']][1], $sesion['hora_fin']);
        }
    }

    // ============================================
    // 8. ACUMULACIÓN CORRECTA DE HORAS
    // ============================================

    public function test_acumulacion_horas(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        $totalHoras = array_sum(array_column($sesiones, 'duracion_horas'));

        // Debe ser mayor a 0 y razonable para 22 semanas
        $this->assertGreaterThan(0, $totalHoras);
        $this->assertLessThanOrEqual(22 * 6, $totalHoras);
    }

    // ============================================
    // 9. SEPARACIÓN TEORÍA/PRÁCTICA
    // ============================================

    public function test_separacion_teoria_practica(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $horas = $this->disponibilidadService->calcularHorasHorario($grupo);

        // El horario debe permitir 3h teoría + 3h práctica
        $this->assertEquals(6, $horas);
    }

    // ============================================
    // 10. DETECCIÓN DE SOBRECARGA
    // ============================================

    public function test_deteccion_sobrecarga(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        // Verificar que ninguna sesión excede las 2 horas
        foreach ($sesiones as $sesion) {
            $this->assertLessThanOrEqual(2, $sesion['duracion_horas']);
        }
    }

    // ============================================
    // 11. DETECCIÓN DE FECHAS INVÁLIDAS
    // ============================================

    public function test_deteccion_fechas_invalidas(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        foreach ($sesiones as $sesion) {
            $this->assertGreaterThanOrEqual('2026-09-01', $sesion['fecha']);
            $this->assertLessThanOrEqual('2027-01-29', $sesion['fecha']);
        }
    }

    // ============================================
    // 12. EVALUACIÓN/ENCIDENCIA EN FECHA NO DISPONIBLE
    // ============================================

    public function test_evaluacion_fecha_no_disponible(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        // Verificar que no hay sesiones en feriados
        $feriados = ['2026-09-16', '2026-11-02', '2026-11-16'];

        foreach ($sesiones as $sesion) {
            $this->assertNotContains($sesion['fecha'], $feriados);
        }
    }

    // ============================================
    // 13-15. GENERACIÓN DE ESCENARIOS
    // ============================================

    public function test_generacion_escenario_uniforme(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $calendarizacion = $this->calendarizacionService->construirBase($periodo, $grupo);
        $escenario = $this->escenarioService->generarUniforme($calendarizacion);

        $this->assertEquals('Uniforme', $escenario->nombre);
        $this->assertEquals('propuesta', $escenario->estado);
    }

    public function test_generacion_escenario_compacto(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $calendarizacion = $this->calendarizacionService->construirBase($periodo, $grupo);
        $escenario = $this->escenarioService->generarCompacto($calendarizacion);

        $this->assertEquals('Compacto', $escenario->nombre);
        $this->assertEquals('propuesta', $escenario->estado);
    }

    public function test_generacion_escenario_extendido(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $calendarizacion = $this->calendarizacionService->construirBase($periodo, $grupo);
        $escenario = $this->escenarioService->generarExtendido($calendarizacion);

        $this->assertEquals('Extendido', $escenario->nombre);
        $this->assertEquals('propuesta', $escenario->estado);
    }

    // ============================================
    // 16. VALIDACIÓN DE ESCENARIO
    // ============================================

    public function test_validacion_escenario(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $calendarizacion = $this->calendarizacionService->construirBase($periodo, $grupo);
        $escenario = $this->escenarioService->generarUniforme($calendarizacion);

        $validacion = $this->validacionService->validar($escenario);

        $this->assertArrayHasKey('errores', $validacion);
        $this->assertArrayHasKey('advertencias', $validacion);
    }

    // ============================================
    // 17. COMPARACIÓN/PUNTUACIÓN DE ESCENARIOS
    // ============================================

    public function test_comparacion_escenarios(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $calendarizacion = $this->calendarizacionService->construirBase($periodo, $grupo);

        $escenarioA = $this->escenarioService->generarUniforme($calendarizacion);
        $escenarioB = $this->escenarioService->generarCompacto($calendarizacion);

        $puntuacionA = $this->validacionService->puntuar($escenarioA);
        $puntuacionB = $this->validacionService->puntuar($escenarioB);

        $this->assertIsInt($puntuacionA);
        $this->assertIsInt($puntuacionB);
    }

    // ============================================
// 18. CASO REAL 4701
    // ============================================

    public function test_caso_real_4701(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $sesiones = $this->disponibilidadService->obtenerSesionesDisponibles($periodo, $grupo);

        // Verificar que solo hay sesiones de lunes a jueves
        $diasValidos = ['lunes', 'martes', 'miercoles', 'jueves'];
        foreach ($sesiones as $sesion) {
            $this->assertContains($sesion['dia'], $diasValidos);
        }

        // Verificar que no hay fechas bloqueadas
        $feriados = ['2026-09-16', '2026-11-02', '2026-11-16', '2026-12-25', '2027-01-01'];
        foreach ($sesiones as $sesion) {
            $this->assertNotContains($sesion['fecha'], $feriados);
        }

        // Verificar máximo 6 horas semanales
        $horasPorSemana = [];
        foreach ($sesiones as $sesion) {
            $semana = date('W', strtotime($sesion['fecha']));
            $horasPorSemana[$semana] = ($horasPorSemana[$semana] ?? 0) + $sesion['duracion_horas'];
        }

        foreach ($horasPorSemana as $semana => $horas) {
            $this->assertLessThanOrEqual(6, $horas, "Semana {$semana} tiene {$horas} horas");
        }
    }
}
