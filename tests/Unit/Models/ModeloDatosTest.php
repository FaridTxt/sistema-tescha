<?php

namespace Tests\Unit\Models;

use App\Models\Actividad;
use App\Models\Asignatura;
use App\Models\CalendarioEscolar;
use App\Models\Calendarizacion;
use App\Models\Competencia;
use App\Models\Docente;
use App\Models\DocumentoGenerado;
use App\Models\Escenario;
use App\Models\Evidencia;
use App\Models\Evaluacion;
use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Periodo;
use App\Models\Tema;
use App\Models\Unidad;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModeloDatosTest extends TestCase
{
    use RefreshDatabase;

    // ============================================
    // PRUEBAS DE CREACIÓN BÁSICA
    // ============================================

    public function test_crear_docente()
    {
        $docente = Docente::create([
            'nombre' => 'Fabiola García Gutiérrez',
            'email' => 'fabiola@tesch.edu.mx',
        ]);

        $this->assertDatabaseHas('docentes', [
            'nombre' => 'Fabiola García Gutiérrez',
            'email' => 'fabiola@tesch.edu.mx',
        ]);
    }

    public function test_crear_asignatura()
    {
        $asignatura = Asignatura::create([
            'nombre' => 'Gestión de Proyectos de Software',
            'clave' => 'SCG-1009',
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => 'Aplicar metodologías e instrumentos',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);

        $this->assertDatabaseHas('asignaturas', [
            'clave' => 'SCG-1009',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);
    }

    public function test_crear_periodo()
    {
        $periodo = Periodo::create([
            'nombre' => '2026-2',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        $this->assertDatabaseHas('periodos', [
            'nombre' => '2026-2',
            'semanas' => 22,
        ]);
    }

    public function test_crear_calendario_escolar()
    {
        $calendario = CalendarioEscolar::create([
            'nombre' => 'Calendario 2026-2027',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-08-30',
            'feriados' => ['2026-09-16', '2026-11-02'],
            'vacaciones' => [['inicio' => '2026-12-21', 'fin' => '2026-12-31']],
            'suspensiones' => [],
        ]);

        $this->assertDatabaseHas('calendarios_escolares', [
            'nombre' => 'Calendario 2026-2027',
        ]);
    }

    public function test_crear_grupo_completo()
    {
        $docente = Docente::create([
            'nombre' => 'Fabiola García Gutiérrez',
            'email' => 'fabiola@tesch.edu.mx',
        ]);

        $asignatura = Asignatura::create([
            'nombre' => 'Gestión de Proyectos de Software',
            'clave' => 'SCG-1009',
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => 'Aplicar metodologías e instrumentos',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);

        $periodo = Periodo::create([
            'nombre' => '2026-2',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        $grupo = Grupo::create([
            'nombre' => '4701',
            'asignatura_id' => $asignatura->id,
            'periodo_id' => $periodo->id,
            'docente_id' => $docente->id,
        ]);

        $this->assertDatabaseHas('grupos', [
            'nombre' => '4701',
        ]);
    }

    public function test_crear_horario()
    {
        $grupo = $this->crearGrupoBasico();

        $horario = Horario::create([
            'grupo_id' => $grupo->id,
            'dia' => 'lunes',
            'hora_inicio' => '12:00',
            'hora_fin' => '14:00',
            'duracion_horas' => 2,
            'salon' => 'E10',
            'edificio' => 'BICENTENARIO DE LA INDEPENDENCIA',
        ]);

        $this->assertDatabaseHas('horarios', [
            'grupo_id' => $grupo->id,
            'dia' => 'lunes',
        ]);
    }

    public function test_crear_unidad()
    {
        $asignatura = Asignatura::create([
            'nombre' => 'Gestión de Proyectos de Software',
            'clave' => 'SCG-1009',
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => 'Aplicar metodologías e instrumentos',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);

        $unidad = Unidad::create([
            'asignatura_id' => $asignatura->id,
            'numero' => 1,
            'nombre' => 'Introducción a la gestión de proyectos',
            'horas_teoria' => 6,
            'horas_practica' => 6,
        ]);

        $this->assertDatabaseHas('unidades', [
            'asignatura_id' => $asignatura->id,
            'numero' => 1,
        ]);
    }

    public function test_crear_competencia()
    {
        $unidad = $this->crearUnidadBasica();

        $competencia = Competencia::create([
            'unidad_id' => $unidad->id,
            'numero' => 1,
            'descripcion' => 'Conoce y comprende el entorno de la gestión de proyectos',
            'horas_teoria' => 6,
            'horas_practica' => 6,
        ]);

        $this->assertDatabaseHas('competencias', [
            'unidad_id' => $unidad->id,
            'numero' => 1,
        ]);
    }

    public function test_crear_tema_y_subtema()
    {
        $unidad = $this->crearUnidadBasica();

        $tema = Tema::create([
            'unidad_id' => $unidad->id,
            'numero' => '1.1',
            'nombre' => 'Conceptos básicos para la gestión de proyectos',
            'orden' => 1,
        ]);

        $subtema = Tema::create([
            'unidad_id' => $unidad->id,
            'numero' => '1.1.1',
            'nombre' => 'Subtema de ejemplo',
            'padre_id' => $tema->id,
            'orden' => 2,
        ]);

        $this->assertDatabaseHas('temas', [
            'numero' => '1.1',
        ]);

        $this->assertDatabaseHas('temas', [
            'numero' => '1.1.1',
            'padre_id' => $tema->id,
        ]);
    }

    public function test_crear_actividad()
    {
        $tema = $this->crearTemaBasico();

        $actividad = Actividad::create([
            'tema_id' => $tema->id,
            'tipo' => 'aprendizaje',
            'descripcion' => 'Gestiona información sobre la terminología',
        ]);

        $this->assertDatabaseHas('actividades', [
            'tema_id' => $tema->id,
            'tipo' => 'aprendizaje',
        ]);
    }

    public function test_crear_evidencia_y_evaluacion()
    {
        $competencia = $this->crearCompetenciaBasica();

        $evidencia = Evidencia::create([
            'competencia_id' => $competencia->id,
            'nombre' => 'Proyecto Integrador',
            'porcentaje' => 40.00,
            'indicador' => 'A',
        ]);

        $evaluacion = Evaluacion::create([
            'evidencia_id' => $evidencia->id,
            'fecha' => '2026-09-15',
            'tipo' => 'formativa',
        ]);

        $this->assertDatabaseHas('evidencias', [
            'competencia_id' => $competencia->id,
        ]);

        $this->assertDatabaseHas('evaluaciones', [
            'evidencia_id' => $evidencia->id,
        ]);
    }

    public function test_crear_calendarizacion_completa()
    {
        $grupo = $this->crearGrupoBasico();
        $periodo = Periodo::create([
            'nombre' => '2026-2',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        $calendarizacion = Calendarizacion::create([
            'periodo_id' => $periodo->id,
            'grupo_id' => $grupo->id,
            'estado' => 'borrador',
        ]);

        $escenario = Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Escenario A',
            'descripcion' => 'Distribución uniforme',
            'estado' => 'propuesta',
        ]);

        $documento = DocumentoGenerado::create([
            'escenario_id' => $escenario->id,
            'tipo' => 'instrumentacion',
            'contenido' => ['semana' => 1, 'tema' => '1.1'],
        ]);

        $version = Version::create([
            'calendarizacion_id' => $calendarizacion->id,
            'version' => 1,
            'cambios' => ['accion' => 'creacion_inicial'],
        ]);

        $this->assertDatabaseHas('calendarizaciones', [
            'grupo_id' => $grupo->id,
            'estado' => 'borrador',
        ]);

        $this->assertDatabaseHas('escenarios', [
            'calendarizacion_id' => $calendarizacion->id,
        ]);

        $this->assertDatabaseHas('documentos_generados', [
            'escenario_id' => $escenario->id,
        ]);

        $this->assertDatabaseHas('versiones', [
            'calendarizacion_id' => $calendarizacion->id,
        ]);
    }

    // ============================================
    // PRUEBAS DE RELACIONES
    // ============================================

    public function test_relacion_docente_grupos()
    {
        $docente = Docente::create([
            'nombre' => 'Fabiola García Gutiérrez',
            'email' => 'fabiola@tesch.edu.mx',
        ]);

        $grupo = $this->crearGrupoBasico($docente->id);

        $this->assertEquals($docente->id, $grupo->docente->id);
    }

    public function test_relacion_grupo_horario()
    {
        $grupo = $this->crearGrupoBasico();

        $horario = Horario::create([
            'grupo_id' => $grupo->id,
            'dia' => 'lunes',
            'hora_inicio' => '12:00',
            'hora_fin' => '14:00',
            'duracion_horas' => 2,
        ]);

        $this->assertEquals($grupo->id, $horario->grupo->id);
    }

    public function test_relacion_unidad_competencia_tema()
    {
        $unidad = $this->crearUnidadBasica();

        $competencia = Competencia::create([
            'unidad_id' => $unidad->id,
            'numero' => 1,
            'descripcion' => 'Competencia de prueba',
        ]);

        $tema = Tema::create([
            'unidad_id' => $unidad->id,
            'numero' => '1.1',
            'nombre' => 'Tema de prueba',
        ]);

        $this->assertEquals($unidad->id, $competencia->unidad->id);
        $this->assertEquals($unidad->id, $tema->unidad->id);
    }

    public function test_relacion_calendarizacion_escenario_documento_version()
    {
        $grupo = $this->crearGrupoBasico();
        $periodo = Periodo::create([
            'nombre' => '2026-2',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        $calendarizacion = Calendarizacion::create([
            'periodo_id' => $periodo->id,
            'grupo_id' => $grupo->id,
            'estado' => 'borrador',
        ]);

        $escenario = Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Escenario A',
        ]);

        $documento = DocumentoGenerado::create([
            'escenario_id' => $escenario->id,
            'tipo' => 'instrumentacion',
        ]);

        $version = Version::create([
            'calendarizacion_id' => $calendarizacion->id,
            'version' => 1,
        ]);

        $this->assertEquals($calendarizacion->id, $escenario->calendarizacion->id);
        $this->assertEquals($escenario->id, $documento->escenario->id);
        $this->assertEquals($calendarizacion->id, $version->calendarizacion->id);
    }

    // ============================================
    // PRUEBAS DE ELIMINACIÓN
    // ============================================

    public function test_eliminar_grupo_elimina_horario()
    {
        $grupo = $this->crearGrupoBasico();

        Horario::create([
            'grupo_id' => $grupo->id,
            'dia' => 'lunes',
            'hora_inicio' => '12:00',
            'hora_fin' => '14:00',
            'duracion_horas' => 2,
        ]);

        $grupo->delete();

        $this->assertDatabaseMissing('horarios', [
            'grupo_id' => $grupo->id,
        ]);
    }

    public function test_eliminar_calendarizacion_elimina_escenarios_y_versiones()
    {
        $grupo = $this->crearGrupoBasico();
        $periodo = Periodo::create([
            'nombre' => '2026-2',
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        $calendarizacion = Calendarizacion::create([
            'periodo_id' => $periodo->id,
            'grupo_id' => $grupo->id,
            'estado' => 'borrador',
        ]);

        Escenario::create([
            'calendarizacion_id' => $calendarizacion->id,
            'nombre' => 'Escenario A',
        ]);

        Version::create([
            'calendarizacion_id' => $calendarizacion->id,
            'version' => 1,
        ]);

        $calendarizacion->delete();

        $this->assertDatabaseMissing('escenarios', [
            'calendarizacion_id' => $calendarizacion->id,
        ]);

        $this->assertDatabaseMissing('versiones', [
            'calendarizacion_id' => $calendarizacion->id,
        ]);
    }

    // ============================================
    // HELPERS
    // ============================================

    private function crearGrupoBasico($docenteId = null)
    {
        if (!$docenteId) {
            $docente = Docente::create([
                'nombre' => 'Fabiola García Gutiérrez',
                'email' => 'fabiola' . uniqid() . '@tesch.edu.mx',
            ]);
            $docenteId = $docente->id;
        }

        $asignatura = Asignatura::create([
            'nombre' => 'Gestión de Proyectos de Software',
            'clave' => 'SCG-' . uniqid(),
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => 'Aplicar metodologías e instrumentos',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);

        $periodo = Periodo::create([
            'nombre' => '2026-' . uniqid(),
            'fecha_inicio' => '2026-09-01',
            'fecha_fin' => '2027-01-29',
            'semanas' => 22,
        ]);

        return Grupo::create([
            'nombre' => 'G' . uniqid(),
            'asignatura_id' => $asignatura->id,
            'periodo_id' => $periodo->id,
            'docente_id' => $docenteId,
        ]);
    }

    private function crearUnidadBasica()
    {
        $asignatura = Asignatura::create([
            'nombre' => 'Gestión de Proyectos de Software',
            'clave' => 'SCG-' . uniqid(),
            'ht' => 3,
            'hp' => 3,
            'creditos' => 6,
            'objetivo' => 'Aplicar metodologías e instrumentos',
            'carrera' => 'Ingeniería en Sistemas Computacionales',
        ]);

        return Unidad::create([
            'asignatura_id' => $asignatura->id,
            'numero' => 1,
            'nombre' => 'Introducción a la gestión de proyectos',
            'horas_teoria' => 6,
            'horas_practica' => 6,
        ]);
    }

    private function crearTemaBasico()
    {
        $unidad = $this->crearUnidadBasica();

        return Tema::create([
            'unidad_id' => $unidad->id,
            'numero' => '1.1',
            'nombre' => 'Conceptos básicos para la gestión de proyectos',
        ]);
    }

    private function crearCompetenciaBasica()
    {
        $unidad = $this->crearUnidadBasica();

        return Competencia::create([
            'unidad_id' => $unidad->id,
            'numero' => 1,
            'descripcion' => 'Conoce y comprende el entorno de la gestión de proyectos',
        ]);
    }
}
