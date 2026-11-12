<?php

namespace Tests\Unit\Database;

use App\Models\Asignatura;
use App\Models\CalendarioEscolar;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Periodo;
use App\Models\Unidad;
use App\Models\Competencia;
use App\Models\Tema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CargaFaseBTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ejecutar seeders de Fase B
        $this->seed(\Database\Seeders\FaseB\DatosOficialesSeeder::class);
        $this->seed(\Database\Seeders\FaseB\TemarioSeeder::class);
    }

    // ============================================
    // 1. PERIODO
    // ============================================

    public function test_existe_periodo_2026_2(): void
    {
        $periodo = Periodo::where('nombre', '2026-2')->first();

        $this->assertNotNull($periodo, 'El periodo 2026-2 no existe');
        $this->assertEquals('2026-09-01', $periodo->fecha_inicio->format('Y-m-d'));
        $this->assertEquals('2027-01-29', $periodo->fecha_fin->format('Y-m-d'));
        $this->assertEquals(22, $periodo->semanas);
    }

    // ============================================
    // 2. DOCENTE
    // ============================================

    public function test_existe_docente(): void
    {
        $docente = Docente::where('nombre', 'Fabiola Garcia Gutierrez')->first();

        $this->assertNotNull($docente, 'El docente no existe');
    }

    // ============================================
    // 3. ASIGNATURA
    // ============================================

    public function test_existe_asignatura(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();

        $this->assertNotNull($asignatura, 'La asignatura no existe');
        $this->assertEquals('Gestión de Proyectos de Software', $asignatura->nombre);
        $this->assertEquals(3, $asignatura->ht);
        $this->assertEquals(3, $asignatura->hp);
        $this->assertEquals(6, $asignatura->creditos);
        $this->assertEquals('Ingeniería en Sistemas Computacionales', $asignatura->carrera);
    }

    // ============================================
    // 4. GRUPO
    // ============================================

    public function test_existe_grupo_4701(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();

        $this->assertNotNull($grupo, 'El grupo 4701 no existe');
    }

    public function test_grupo_y_asignatura_relacionados(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();

        $this->assertEquals($asignatura->id, $grupo->asignatura_id);
        $this->assertEquals('4701', $grupo->asignatura->nombre === null ? '4701' : $grupo->nombre);
    }

    // ============================================
    // 5. HORARIO
    // ============================================

    public function test_existen_4_dias_de_clase(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $horarios = Horario::where('grupo_id', $grupo->id)->get();

        $this->assertEquals(4, $horarios->count(), 'Deben existir exactamente 4 días de clase');
    }

    public function test_horario_suma_6_horas_semanales(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $horarios = Horario::where('grupo_id', $grupo->id)->get();

        $totalHoras = $horarios->sum('duracion_horas');

        $this->assertEquals(6, $totalHoras, 'Las horas deben sumar 6 por semana');
    }

    public function test_viernes_no_aparece_como_clase(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $viernes = Horario::where('grupo_id', $grupo->id)->where('dia', 'viernes')->first();

        $this->assertNull($viernes, 'Viernes no debe aparecer como día de clase');
    }

    public function test_horario_lunes(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $lunes = Horario::where('grupo_id', $grupo->id)->where('dia', 'lunes')->first();

        $this->assertNotNull($lunes);
        $this->assertEquals('12:00', substr($lunes->hora_inicio, 0, 5));
        $this->assertEquals('14:00', substr($lunes->hora_fin, 0, 5));
        $this->assertEquals(2, $lunes->duracion_horas);
    }

    public function test_horario_martes(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $martes = Horario::where('grupo_id', $grupo->id)->where('dia', 'martes')->first();

        $this->assertNotNull($martes);
        $this->assertEquals('11:00', substr($martes->hora_inicio, 0, 5));
        $this->assertEquals('12:00', substr($martes->hora_fin, 0, 5));
        $this->assertEquals(1, $martes->duracion_horas);
    }

    public function test_horario_miercoles(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $miercoles = Horario::where('grupo_id', $grupo->id)->where('dia', 'miercoles')->first();

        $this->assertNotNull($miercoles);
        $this->assertEquals('11:00', substr($miercoles->hora_inicio, 0, 5));
        $this->assertEquals('12:00', substr($miercoles->hora_fin, 0, 5));
        $this->assertEquals(1, $miercoles->duracion_horas);
    }

    public function test_horario_jueves(): void
    {
        $grupo = Grupo::where('nombre', '4701')->first();
        $jueves = Horario::where('grupo_id', $grupo->id)->where('dia', 'jueves')->first();

        $this->assertNotNull($jueves);
        $this->assertEquals('12:00', substr($jueves->hora_inicio, 0, 5));
        $this->assertEquals('14:00', substr($jueves->hora_fin, 0, 5));
        $this->assertEquals(2, $jueves->duracion_horas);
    }

    // ============================================
    // 6. UNIDADES / COMPETENCIAS / TEMAS
    // ============================================

    public function test_existen_5_unidades(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $unidades = Unidad::where('asignatura_id', $asignatura->id)->get();

        $this->assertEquals(5, $unidades->count(), 'Deben existir exactamente 5 unidades');
    }

    public function test_existen_5_competencias(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $unidades = Unidad::where('asignatura_id', $asignatura->id)->get();

        $totalCompetencias = 0;
        foreach ($unidades as $unidad) {
            $totalCompetencias += Competencia::where('unidad_id', $unidad->id)->count();
        }

        $this->assertEquals(5, $totalCompetencias, 'Deben existir exactamente 5 competencias');
    }

    public function test_existen_37_temas(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $unidades = Unidad::where('asignatura_id', $asignatura->id)->get();

        $totalTemas = 0;
        foreach ($unidades as $unidad) {
            $totalTemas += Tema::where('unidad_id', $unidad->id)->count();
        }

        $this->assertEquals(37, $totalTemas, 'Deben existir exactamente 37 temas/subtemas');
    }

    public function test_horas_unidades_coinciden_con_fuente(): void
    {
        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $unidades = Unidad::where('asignatura_id', $asignatura->id)->get();

        $horasEsperadas = [12, 12, 18, 12, 18]; // HT + HP por unidad

        foreach ($unidades as $index => $unidad) {
            $totalHoras = $unidad->horas_teoria + $unidad->horas_practica;
            $this->assertEquals(
                $horasEsperadas[$index],
                $totalHoras,
                "Unidad {$unidad->numero}: horas esperadas {$horasEsperadas[$index]}, obtenidas {$totalHoras}"
            );
        }
    }

    // ============================================
    // 7. CALENDARIO ESCOLAR
    // ============================================

    public function test_calendario_tiene_restricciones_cargadas(): void
    {
        $calendario = CalendarioEscolar::where('nombre', 'Calendario 2026-2027')->first();

        $this->assertNotNull($calendario, 'El calendario escolar no existe');
        $this->assertNotEmpty($calendario->feriados, 'Los feriados deben estar cargados');
        $this->assertNotEmpty($calendario->vacaciones, 'Las vacaciones deben estar cargadas');
    }

    public function test_calendario_feriados_contiene_fechas_clave(): void
    {
        $calendario = CalendarioEscolar::where('nombre', 'Calendario 2026-2027')->first();

        $this->assertContains('2026-09-16', $calendario->feriados);
        $this->assertContains('2026-11-02', $calendario->feriados);
        $this->assertContains('2026-11-16', $calendario->feriados);
    }

    public function test_calendario_vacaciones_contiene_periodo(): void
    {
        $calendario = CalendarioEscolar::where('nombre', 'Calendario 2026-2027')->first();

        $this->assertNotEmpty($calendario->vacaciones);
        $this->assertEquals('2026-12-21', $calendario->vacaciones[0]['inicio']);
        $this->assertEquals('2026-12-31', $calendario->vacaciones[0]['fin']);
    }

    // ============================================
    // 8. NO DUPLICADOS
    // ============================================

    public function test_no_existen_duplicados_al_ejecutar_seeders_varias_veces(): void
    {
        // Ejecutar seeders de nuevo
        $this->seed(\Database\Seeders\FaseB\DatosOficialesSeeder::class);
        $this->seed(\Database\Seeders\FaseB\TemarioSeeder::class);

        // Verificar que no hay duplicados
        $this->assertEquals(1, Docente::where('nombre', 'Fabiola Garcia Gutierrez')->count());
        $this->assertEquals(1, Asignatura::where('clave', 'SCG-1009')->count());
        $this->assertEquals(1, Grupo::where('nombre', '4701')->count());
        $this->assertEquals(1, Periodo::where('nombre', '2026-2')->count());
        $this->assertEquals(1, CalendarioEscolar::where('nombre', 'Calendario 2026-2027')->count());

        $grupo = Grupo::where('nombre', '4701')->first();
        $this->assertEquals(4, Horario::where('grupo_id', $grupo->id)->count());

        $asignatura = Asignatura::where('clave', 'SCG-1009')->first();
        $this->assertEquals(5, Unidad::where('asignatura_id', $asignatura->id)->count());
    }
}
