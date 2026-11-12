<?php

namespace Tests\Unit\Services;

use App\Services\HorarioService;
use PHPUnit\Framework\TestCase;

class HorarioServiceTest extends TestCase
{
    private HorarioService $servicio;

    protected function setUp(): void
    {
        $this->servicio = new HorarioService(__DIR__ . '/../../../docs/Horarios 2026-2 -Presencial.pdf');
    }

    public function testPdfExiste(): void
    {
        $this->assertFileExists(__DIR__ . '/../../../docs/Horarios 2026-2 -Presencial.pdf');
    }

    public function testEncontrarGrupo4701(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertEquals('4701', $resultado['grupo'] ?? 'NO ENCONTRADO');
    }

    public function testEncontrarMateria(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertStringContainsString('GESTIÓN DE PROYECTOS DE SOFTWARE', $resultado['materia'] ?? '');
    }

    public function testObtenerDocente(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertEquals('FABIOLA GARCIA GUTIERREZ', $resultado['docente'] ?? 'NO ENCONTRADO');
    }

    public function testObtenerPlan(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertEquals('2019', $resultado['plan'] ?? 'NO ENCONTRADO');
    }

    public function testObtenerEdificio(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertStringContainsString('BICENTENARIO', $resultado['edificio'] ?? '');
    }

    public function testObtenerSalon(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $this->assertEquals('E10', $resultado['salon'] ?? 'NO ENCONTRADO');
    }

    public function testEncontrarLunes(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $lunes = $this->obtenerHorarioPorDia($resultado['horarios'], 'lunes');
        $this->assertNotNull($lunes, 'No se encontró horario para lunes');
        $this->assertEquals('12:00', $lunes['hora_inicio']);
        $this->assertEquals('14:00', $lunes['hora_fin']);
    }

    public function testEncontrarMartes(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $martes = $this->obtenerHorarioPorDia($resultado['horarios'], 'martes');
        $this->assertNotNull($martes, 'No se encontró horario para martes');
        $this->assertEquals('11:00', $martes['hora_inicio']);
        $this->assertEquals('12:00', $martes['hora_fin']);
    }

    public function testEncontrarMiercoles(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $miercoles = $this->obtenerHorarioPorDia($resultado['horarios'], 'miercoles');
        $this->assertNotNull($miercoles, 'No se encontró horario para miércoles');
        $this->assertEquals('11:00', $miercoles['hora_inicio']);
        $this->assertEquals('12:00', $miercoles['hora_fin']);
    }

    public function testEncontrarJueves(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $jueves = $this->obtenerHorarioPorDia($resultado['horarios'], 'jueves');
        $this->assertNotNull($jueves, 'No se encontró horario para jueves');
        $this->assertEquals('12:00', $jueves['hora_inicio']);
        $this->assertEquals('14:00', $jueves['hora_fin']);
    }

    public function testViernesSinClase(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $viernes = $this->obtenerHorarioPorDia($resultado['horarios'], 'viernes');
        $this->assertNull($viernes, 'Viernes no debería tener horario');
    }

    public function testHorasSemanales(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        $horasSemanales = $this->servicio->calcularHorasSemanales($resultado['horarios']);
        $this->assertEquals(6, $horasSemanales, 'Las horas semanales deberían ser 6');
    }

    public function testEstructuraHorarios(): void
    {
        $resultado = $this->servicio->leerHorario('4701', 'GESTIÓN DE PROYECTOS DE SOFTWARE');
        
        $this->assertArrayHasKey('grupo', $resultado);
        $this->assertArrayHasKey('materia', $resultado);
        $this->assertArrayHasKey('docente', $resultado);
        $this->assertArrayHasKey('plan', $resultado);
        $this->assertArrayHasKey('edificio', $resultado);
        $this->assertArrayHasKey('salon', $resultado);
        $this->assertArrayHasKey('horarios', $resultado);
        
        $this->assertCount(4, $resultado['horarios'], 'Debería tener 4 días con clase');
    }

    private function obtenerHorarioPorDia(array $horarios, string $dia): ?array
    {
        foreach ($horarios as $horario) {
            if ($horario['dia'] === $dia) {
                return $horario;
            }
        }
        return null;
    }
}
