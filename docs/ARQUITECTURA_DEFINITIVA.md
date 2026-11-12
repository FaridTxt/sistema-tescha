# ARQUITECTURA DEFINITIVA — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Estado:** Diseño definitivo (no implementado)
> **Principio central:** UNA SOLA CALENDARIZACIÓN CENTRAL

---

## 1. MODELO DE DOMINIO DEFINITIVO

### 1.1 Entidades principales

| Entidad | Descripción | ¿Qué problema resuelve? |
|---------|-------------|------------------------|
| **Docente** | Profesor que elabora la planeación | Identifica quién elabora y firma los documentos |
| **Asignatura** | Materia que se planea | Contiene datos académicos (clave, HT, HP, créditos, carrera) |
| **Grupo** | Grupo de estudiantes | Identifica el horario y las sesiones disponibles |
| **Periodo** | Periodo escolar | Define el rango de fechas y semanas efectivas |
| **Horario** | Horario del grupo | Define días y horas de clase disponibles |
| **CalendarioEscolar** | Calendario institucional | Define feriados, vacaciones, suspensiones |
| **Unidad** | Unidad temática de la asignatura | Organiza el contenido en bloques |
| **Competencia** | Competencia a desarrollar | Define qué se evalúa en cada unidad |
| **Tema/Subtema** | Contenido específico | Distribuye el contenido en sesiones |
| **Actividad** | Actividad de aprendizaje/enseñanza | Define qué se hace en cada sesión |
| **Evidencia** | Evidencia de aprendizaje | Define qué se evalúa |
| **Evaluación** | Evaluación programada | Define cuándo se evalúa |
| **Calendarización** | Calendarización central | Fuente única de fechas para ambos documentos |
| **Escenario** | Propuesta de calendarización | Permite comparar diferentes distribuciones |
| **DocumentoGenerado** | Documento final generado | Instrumentación o AvancePro |
| **Versión** | Versión de la calendarización | Permite historial de cambios |

**Nota:** La entidad `Carrera` NO necesita tabla propia. Se almacena como campo de texto (`carrera`) en la tabla `asignaturas`.

### 1.2 Relaciones entre entidades

```
Docente 1:N Asignatura
Asignatura 1:N Grupo
Grupo 1:1 Horario
Grupo N:1 Periodo
Periodo N:1 CalendarioEscolar
Asignatura 1:N Unidad
Unidad 1:N Competencia
Unidad 1:N Tema/Subtema
Tema/Subtema 1:N Actividad
Competencia 1:N Evidencia
Evidencia 1:N Evaluación
Periodo 1:N Calendarización
Calendarización 1:N Escenario
Escenario 1:N DocumentoGenerado
Calendarización 1:N Versión
```

---

## 2. MATRIZ CAMPO POR CAMPO

### 2.1 AvancePro

| Campo | Documento | Origen | Tipo | ¿Docente puede modificar? | ¿Pertenece a calendarización central? | Depende de |
|-------|-----------|--------|------|---------------------------|--------------------------------------|------------|
| Nombre de la materia | AvancePro | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| HT | AvancePro | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| HP | AvancePro | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| HT (Horas Totales) | AvancePro | SISTEMA | Calculado | ❌ No | ❌ No | HT + HP |
| No. de Unidades | AvancePro | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Objetivo de la materia | AvancePro | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Grupo | AvancePro | DOCENTE | Capturado | ✅ Sí (selecciona) | ❌ No | Grupo |
| Carrera | AvancePro | INSTITUCIÓN | Generado | ❌ No | ❌ No | Asignatura |
| Docente | AvancePro | INSTITUCIÓN | Generado | ❌ No | ❌ No | Docente |
| Unidad Temática | AvancePro | TEMARIO | Generado | ❌ No | ✅ Sí | Unidad |
| Subtemas | AvancePro | TEMARIO | Generado | ❌ No | ✅ Sí | Tema/Subtema |
| Fechas Programado | AvancePro | SISTEMA | Propuesto | ✅ Sí | ✅ Sí | Calendarización |
| Fechas Real | AvancePro | DOCENTE | Capturado | ✅ Sí | ✅ Sí | Calendarización |
| Evaluación Programada | AvancePro | DOCENTE | Capturado | ✅ Sí | ✅ Sí | Evaluación |
| Evaluación Real | AvancePro | DOCENTE | Capturado | ✅ Sí | ✅ Sí | Evaluación |
| Firma del Docente | AvancePro | DOCENTE | Capturado | ✅ Sí | ❌ No | Docente |
| Firma del Jefe Académico | AvancePro | INSTITUCIÓN | Capturado | ❌ No | ❌ No | Jefe |
| Observaciones | AvancePro | DOCENTE | Capturado | ✅ Sí | ❌ No | - |
| Fecha de entrega de programación | AvancePro | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Periodo |
| Fecha 1er Seguimiento | AvancePro | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Periodo |
| Fecha 2do Seguimiento | AvancePro | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Periodo |
| Fecha 3er Seguimiento | AvancePro | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Periodo |
| Fecha entrega reporte final | AvancePro | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Periodo |
| Vo.Bo. del Jefe de División | AvancePro | INSTITUCIÓN | Capturado | ❌ No | ❌ No | Jefe |

### 2.2 Instrumentación Didáctica

| Campo | Documento | Origen | Tipo | ¿Docente puede modificar? | ¿Pertenece a calendarización central? | Depende de |
|-------|-----------|--------|------|---------------------------|--------------------------------------|------------|
| Periodo | Instrumentación | CALENDARIO | Generado | ❌ No | ❌ No | Periodo |
| Nombre de la asignatura | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Plan de estudios | Instrumentación | INSTITUCIÓN | Generado | ❌ No | ❌ No | Asignatura |
| Clave de la asignatura | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| HT-HP-Créditos | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Caracterización de la asignatura | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Intención didáctica | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Competencia de la assignatura | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Competencia |
| Competencias específicas | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Competencia |
| Temas y subtemas | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Tema/Subtema |
| Actividades de aprendizaje | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Actividad |
| Actividades de enseñanza | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Actividad |
| Competencias genéricas | Instrumentación | TEMARIO | Generado | ❌ No | ✅ Sí | Competencia |
| Horas teórico-prácticas | Instrumentación | DOCENTE | Capturado | ✅ Sí | ✅ Sí | Unidad |
| Indicadores de alcance | Instrumentación | INSTITUCIÓN | Generado | ❌ No | ✅ Sí | Competencia |
| Valor del indicador | Instrumentación | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Indicador |
| Niveles de desempeño | Instrumentación | INSTITUCIÓN | Generado | ❌ No | ✅ Sí | Competencia |
| Matriz de evaluación | Instrumentación | SISTEMA | Calculado | ✅ Sí | ✅ Sí | Evidencia |
| Fuentes de información | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Apoyos didácticos | Instrumentación | TEMARIO | Generado | ❌ No | ❌ No | Asignatura |
| Calendarización de evaluación | Instrumentación | SISTEMA | Propuesto | ✅ Sí | ✅ Sí | Calendarización |
| Fecha de elaboración | Instrumentación | SISTEMA | Calculado | ❌ No | ❌ No | Fecha actual |
| Nombre y firma del profesor | Instrumentación | DOCENTE | Capturado | ✅ Sí | ❌ No | Docente |
| Nombre y firma del jefe de división | Instrumentación | INSTITUCIÓN | Capturado | ❌ No | ❌ No | Jefe |

---

## 3. REGLAS DE CALENDARIZACIÓN

### 3.1 Entradas

| Entrada | Fuente | ¿Quién la proporciona? |
|---------|--------|------------------------|
| Calendario escolar | JSON TESCHA | Sistema |
| Horario del grupo | PDF Horarios | Sistema |
| Periodo | Calendario escolar | Sistema |
| Temas/Subtemas | PDF Temario | Sistema |
| Horas por competencia/unidad | PDF Temario | Sistema |
| Horas definidas por el docente | Planeación | Docente |
| Actividades | Planeación | Docente |
| Evaluaciones | Planeación | Docente |
| Evidencias | Planeación | Docente |

### 3.2 Restricciones

| Restricción | Descripción |
|-------------|-------------|
| Solo días con clase | Usar horario del grupo (L/M/J/V) |
| Excluir feriados | Calendario escolar |
| Excluir vacaciones | Calendario escolar |
| Excluir suspensiones | Calendario escolar |
| 6 horas semanales | 3 HT + 3 HP |
| 22 semanas efectivas | Periodo 2026-2 |
| Respetar orden de temas | Temario oficial |
| Respetar decisiones del docente | Planeación del docente |

### 3.3 Salidas

| Salida | Uso |
|--------|-----|
| Fechas propuestas | AvancePro |
| Distribución de sesiones | Ambos documentos |
| Conflictos | Validación |
| Escenarios posibles | Comparación |

---

## 4. GENERACIÓN DE ESCENARIOS

### 4.1 Concepto

Un escenario es una propuesta completa de calendarización que respeta todas las restricciones.

### 4.2 Diferencias entre escenarios

| Aspecto | Escenario A | Escenario B |
|---------|-------------|-------------|
| Distribución de temas | Más temas al inicio | Distribución uniforme |
| Agrupación de subtemas | Subtemas juntos | Subtemas separados |
| Espacio para evaluación | Evaluaciones al final de unidad | Evaluaciones distribuidas |
| Flexibilidad | Más compacto | Más extendido |

### 4.3 Reglas para generar escenarios

1. Respetar todas las restricciones
2. Cubrir todos los temas/subtemas
3. Respetar evaluaciones y evidencias definidas
4. Detectar conflictos
5. Permitir comparación

---

## 5. FLUJO COMPLETO DEL SISTEMA

```
1. CAPTURA DE DATOS
   ↓
2. IMPORTACIÓN/LECTURA DE FUENTES OFICIALES
   ↓
3. VALIDACIÓN
   ↓
4. CONSTRUCCIÓN DE CALENDARIZACIÓN BASE
   ↓
5. GENERACIÓN DE ESCENARIOS
   ↓
6. REVISIÓN DEL DOCENTE
   ↓
7. MODIFICACIÓN
   ↓
8. VALIDACIÓN FINAL
   ↓
9. ACEPTACIÓN DE CALENDARIZACIÓN
   ↓
10. GENERACIÓN DE INSTRUMENTACIÓN
   ↓
11. GENERACIÓN DE AVANCEPRO
   ↓
12. VALIDACIÓN DE CONSISTENCIA
   ↓
13. EXPORTACIÓN
```

---

## 6. REGLA FUNDAMENTAL DE CONSISTENCIA

**Una vez aceptada la calendarización central, los dos documentos deben obtener sus fechas y datos relacionados de esa misma fuente.**

**Nunca permitir que Instrumentación y AvancePro tengan fechas independientes.**

---

## 7. VALIDACIONES

| Validación | Descripción |
|------------|-------------|
| Fechas en días reales de clase | Verificar horario del grupo |
| Ninguna fecha en vacaciones/feriado/suspensión | Verificar calendario escolar |
| Horas disponibles correctas | 6h semanales |
| 3h teóricas + 3h prácticas | Distribución correcta |
| Cobertura de horas de unidades/competencias | Temario oficial |
| Evaluaciones válidas | Definidas por el docente |
| Evidencias válidas | Definidas por el docente |
| Consistencia entre documentos | Misma calendarización |
| Ausencia de actividades sin fecha | Todas las actividades tienen fecha |
| Ausencia de conflictos | Sin traslapos |

---

## 8. MODO DE CAMBIO Y REGENERACIÓN

| Modificación | ¿Qué se recalcula? | ¿Qué se conserva? |
|--------------|-------------------|-------------------|
| Horas de un tema | Distribución de sesiones | Orden de temas |
| Actividad | Fechas de la actividad | Otras actividades |
| Evidencia | Fechas de evaluación | Otras evidencias |
| Evaluación | Fechas de evaluación | Otras evaluaciones |
| Fecha | Distribución de sesiones | Decisiones del docente |
| Distribución teoría/práctica | Asignación de horas | Total de horas |

---

## 9. ARQUITECTURA DE IMPLEMENTACIÓN

### 9.1 Tablas definitivas

| Tabla | Descripción |
|-------|-------------|
| `docentes` | Información del docente |
| `asignaturas` | Información de la asignatura |
| `grupos` | Información del grupo |
| `periodos` | Periodos escolares |
| `horarios` | Horarios de los grupos |
| `calendarios_escolares` | Calendarios institucionales |
| `unidades` | Unidades temáticas |
| `competencias` | Competencias a desarrollar |
| `temas` | Temas y subtemas |
| `actividades` | Actividades de aprendizaje/enseñanza |
| `evidencias` | Evidencias de aprendizaje |
| `evaluaciones` | Evaluaciones programadas |
| `calendarizaciones` | Calendarización central |
| `escenarios` | Propuestas de calendarización |
| `documentos_generados` | Documentos finales |
| `versiones` | Historial de versiones |

### 9.2 Relaciones Eloquent

```php
// Ejemplo de relaciones
class Asignatura extends Model {
    public function grupos() { return $this->hasMany(Grupo::class); }
    public function unidades() { return $this->hasMany(Unidad::class); }
}

class Grupo extends Model {
    public function asignatura() { return $this->belongsTo(Asignatura::class); }
    public function horario() { return $this->hasOne(Horario::class); }
    public function periodo() { return $this->belongsTo(Periodo::class); }
}

class Calendarización extends Model {
    public function periodo() { return $this->belongsTo(Periodo::class); }
    public function escenarios() { return $this->hasMany(Escenario::class); }
    public function versiones() { return $this->hasMany(Versión::class); }
}
```

### 9.3 Servicios

| Servicio | Responsabilidad |
|----------|-----------------|
| `CalendarioService` | Leer y consultar el calendario escolar |
| `TemarioService` | Leer y extraer datos del temario |
| `HorarioService` | Leer y extraer datos del horario |
| `CalendarizaciónService` | Construir la calendarización central |
| `EscenarioService` | Generar escenarios de calendarización |
| `ValidacionService` | Validar restricciones y consistencia |
| `DocumentoService` | Generar documentos (Instrumentación + AvancePro) |

### 9.4 Controladores

| Controlador | Responsabilidad |
|-------------|-----------------|
| `PlaneacionController` | Captura de datos y revisión |
| `EscenarioController` | Generación y comparación de escenarios |
| `DocumentoController` | Generación de documentos |

### 9.5 Validadores

| Validador | Responsabilidad |
|-----------|-----------------|
| `CalendarioValidador` | Validar fechas y restricciones |
| `HorarioValidador` | Validar horario del grupo |
| `ConsistenciaValidador` | Validar consistencia entre documentos |

---

## 10. PLAN DE IMPLEMENTACIÓN POR FASES

### Fase A: Modelo de datos
- [ ] Diseñar tablas definitivas
- [ ] Definir relaciones
- [ ] Crear diagrama ER

### Fase B: Migraciones
- [ ] Crear migraciones
- [ ] Ejecutar migraciones
- [ ] Verificar estructura

### Fase C: Modelos/Relaciones
- [ ] Crear modelos Eloquent
- [ ] Definir relaciones
- [ ] Probar relaciones

### Fase D: Carga de fuentes oficiales
- [ ] Implementar lectura de PDFs
- [ ] Implementar lectura de JSONs
- [ ] Probar carga de datos

### Fase E: Motor de calendarización
- [ ] Implementar construcción de calendarización base
- [ ] Implementar restricciones
- [ ] Probar calendarización

### Fase F: Escenarios
- [ ] Implementar generación de escenarios
- [ ] Implementar comparación
- [ ] Probar escenarios

### Fase G: Interfaz de revisión
- [ ] Crear vistas de revisión
- [ ] Implementar modificación
- [ ] Probar flujo completo

### Fase H: Generación de documentos
- [ ] Implementar generación de Instrumentación
- [ ] Implementar generación de AvancePro
- [ ] Probar generación

### Fase I: Validación final
- [ ] Implementar validaciones
- [ ] Probar consistencia
- [ ] Verificar documentos

### Fase J: Limpieza del código provisional
- [ ] Eliminar código provisional
- [ ] Refactorizar servicios
- [ ] Documentar código final

---

> **NOTA IMPORTANTE:** Este documento es el diseño definitivo. No se debe implementar nada hasta revisar y aprobar este diseño.
