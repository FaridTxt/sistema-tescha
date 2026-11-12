# AUDITORÍA TÉCNICA DE DISEÑO — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Auditor:** Agente IA
> **Documentos revisados:**
> - `docs/ARQUITECTURA_DEFINITIVA.md`
> - `docs/MODELO_DATOS_DEFINITIVO.md`
> - `docs/REGLAS_CALENDARIZACION.md`
> - `docs/MATRIZ_AUTOMATIZACION.md`
> - `docs/REQUISITOS_CONFIRMADOS.md`
> - `docs/PLAN_PROYECTO.md`

---

## 1. ENTIDADES VS TABLAS

### 1.1 Análisis

| # | Entidad de dominio | Tabla correspondiente | ¿Necesita tabla? | Justificación |
|---|-------------------|----------------------|------------------|---------------|
| 1 | Docente | `docentes` | ✅ Sí | Almacena datos del docente |
| 2 | Asignatura | `asignaturas` | ✅ Sí | Almacena datos de la asignatura |
| 3 | Grupo | `grupos` | ✅ Sí | Almacena datos del grupo |
| 4 | Periodo | `periodos` | ✅ Sí | Almacena datos del periodo |
| 5 | Horario | `horarios` | ✅ Sí | Almacena horario del grupo |
| 6 | CalendarioEscolar | `calendarios_escolares` | ✅ Sí | Almacena calendario institucional |
| 7 | Unidad | `unidades` | ✅ Sí | Almacena unidades temáticas |
| 8 | Competencia | `competencias` | ✅ Sí | Almacena competencias |
| 9 | Tema/Subtema | `temas` | ✅ Sí | Almacena temas y subtemas |
| 10 | Actividad | `actividades` | ✅ Sí | Almacena actividades |
| 11 | Evidencia | `evidencias` | ✅ Sí | Almacena evidencias |
| 12 | Evaluación | `evaluaciones` | ✅ Sí | Almacena evaluaciones |
| 13 | Calendarización | `calendarizaciones` | ✅ Sí | Almacena calendarización central |
| 14 | Escenario | `escenarios` | ✅ Sí | Almacena escenarios |
| 15 | DocumentoGenerado | `documentos_generados` | ✅ Sí | Almacena documentos generados |
| 16 | Versión | `versiones` | ✅ Sí | Almacena historial de versiones |
| 17 | **Carrera** | — | ❌ **No** | **Se omite: no es necesaria para el caso inicial** |

### 1.2 Conclusión

**17 entidades de dominio → 16 tablas**

La entidad **Carrera** NO necesita tabla propia porque:
1. El caso inicial es una sola carrera (Ingeniería en Sistemas Computacionales)
2. La carrera se puede almacenar como campo en `asignaturas`
3. No se requiere un catálogo de carreras para el alcance actual

**Corrección aplicada:** Se documenta que `carrera` es un campo de texto en `asignaturas`, no una entidad separada.

---

## 2. CONSISTENCIA DE LA CALENDARIZACIÓN

### 2.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Existe una sola calendarización central? | ✅ Sí | `calendarizaciones` es la fuente única |
| ¿Ambos documentos consumen la misma calendarización? | ✅ Sí | `documentos_generados` referencia `escenarios` |
| ¿No existe lógica de fechas independientes? | ✅ Sí | El diseño no contempla cálculo de fechas por documento |

### 2.2 Conclusión

✅ **APROBADO** — La calendarización central está correctamente diseñada.

---

## 3. HORARIO

### 3.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Soporta varios días por semana? | ✅ Sí | `horarios` tiene registros por día |
| ¿Soporta diferentes duraciones por día? | ✅ Sí | `duracion_horas` por registro |
| ¿Soporta horas disponibles por día? | ✅ Sí | `hora_inicio` y `hora_fin` |
| ¿Soporta viernes sin clase? | ✅ Sí | Simplemente no hay registro para viernes |
| ¿Soporta futuros grupos con otros horarios? | ✅ Sí | `horarios` es por `grupo_id` |
| ¿No hay hardcode del grupo 4701? | ✅ Sí | El algoritmo usa `grupo_id` |

### 3.2 Conclusión

✅ **APROBADO** — El modelo de horario es flexible y no depende del grupo 4701.

---

## 4. CALENDARIO ESCOLAR

### 4.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Vacaciones se representan como restricciones? | ✅ Sí | `vacaciones` (json) en `calendarios_escolares` |
| ¿Feriados se representan como restricciones? | ✅ Sí | `feriados` (json) en `calendarios_escolares` |
| ¿Suspensiones se representan como restricciones? | ✅ Sí | `suspensiones` (json) en `calendarios_escolares` |
| ¿No hay excepciones codificadas a mano? | ✅ Sí | Todo se almacena en JSON |

### 4.2 Conclusión

✅ **APROBADO** — El calendario escolar es configurable y no tiene excepciones hardcodeadas.

---

## 5. TEORÍA/PRÁCTICA

### 5.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Representa 3h teóricas semanales? | ✅ Sí | `ht` en `asignaturas` |
| ¿Representa 3h prácticas semanales? | ✅ Sí | `hp` en `asignaturas` |
| ¿Representa distribución por sesión? | ✅ Sí | `horas_teoria` y `horas_practica` en `unidades` |
| ¿Permite cambios del docente? | ✅ Sí | El docente puede modificar la distribución |

### 5.2 Conclusión

✅ **APROBADO** — El modelo soporta teoría/práctica correctamente.

---

## 6. PLANEACIÓN ACADÉMICA

### 6.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿El docente define horas por tema? | ✅ Sí | `temas` puede tener campo de horas |
| ¿El docente define actividades? | ✅ Sí | `actividades` |
| ¿El docente define evidencias? | ✅ Sí | `evidencias` |
| ¿El docente define evaluaciones? | ✅ Sí | `evaluaciones` |
| ¿El sistema no sobrescribe decisiones? | ✅ Sí | El sistema propone, el docente decide |

### 6.2 Conclusión

✅ **APROBADO** — El docente conserva la decisión académica.

---

## 7. ESCENARIOS

### 7.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Escenario Uniforme es una propuesta de calendarización? | ✅ Sí | Distribución equilibrada |
| ¿Escenario Compacto es una propuesta de calendarización? | ✅ Sí | Más subtemas por sesión |
| ¿Escenario Extendido es una propuesta de calendarización? | ✅ Sí | Menos subtemas por sesión |
| ¿No son tres sistemas distintos? | ✅ Sí | Todos usan la misma calendarización central |

### 7.2 Conclusión

✅ **APROBADO** — Los escenarios son propuestas de calendarización, no sistemas distintos.

---

## 8. VERSIONADO

### 8.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Un escenario puede modificarse? | ✅ Sí | `escenarios` tiene estado |
| ¿Una calendarización puede aceptarse? | ✅ Sí | `calendarizaciones.estado` |
| ¿Queda registro de qué versión fue aceptada? | ✅ Sí | `versiones` |
| ¿Regenerar documentos no destruye la versión aceptada? | ✅ Sí | `versiones` conserva historial |

### 8.2 Conclusión

✅ **APROBADO** — El versionado está correctamente diseñado.

---

## 9. GENERACIÓN DOCUMENTAL

### 9.1 Verificación

| Aspecto | Estado | Evidencia |
|---------|--------|-----------|
| ¿Los datos de Instrumentación se obtienen del modelo central? | ✅ Sí | `documentos_generados` |
| ¿Los datos de AvancePro se obtienen del modelo central? | ✅ Sí | `documentos_generados` |
| ¿No se duplican fechas manualmente? | ✅ Sí | Ambos usan `escenarios` |

### 9.2 Conclusión

✅ **APROBADO** — La generación documental usa el modelo central.

---

## 10. CÓDIGO PROVISIONAL

### 10.1 Archivos que quedarán obsoletos

| Archivo | Motivo |
|---------|--------|
| `app/Services/GeneradorEscenariosService.php` | Versión anterior, reemplazado por `GeneradorPropuestaService` |
| `app/Services/GeneradorPropuestaService.php` | Reemplazado por `CalendarizaciónService` + `EscenarioService` |
| `resources/views/planeacion/escenarios.blade.php` | Reemplazado por vistas definitivas |
| `resources/views/planeacion/gps-4701.blade.php` | Reemplazado por vistas definitivas |
| `app/Http/Controllers/PlaneacionController.php` | Reemplazado por controladores definitivos |
| `tests/Unit/Services/HorarioServiceTest.php` | Reemplazado por pruebas definitivas |
| `tests/Unit/Services/GeneradorPropuestaServiceTest.php` | Reemplazado por pruebas definitivas |

### 10.2 Archivos que se conservan

| Archivo | Motivo |
|---------|--------|
| `app/Services/CalendarioService.php` | Se integra en la arquitectura definitiva |
| `app/Services/TemarioService.php` | Se integra en la arquitectura definitiva |
| `app/Services/HorarioService.php` | Se integra en la arquitectura definitiva |
| `config/calendario.php` | Configuración válida |

---

## 11. CORRECCIONES APLICADAS

### 11.1 ARQUITECTURA_DEFINITIVA.md

- [x] Documentar que `Carrera` no es una entidad separada
- [x] Especificar que `carrera` es un campo de texto en `asignaturas`

### 11.2 MODELO_DATOS_DEFINITIVO.md

- [x] Confirmar que `asignaturas` tiene campo `carrera` (string)
- [x] Confirmar que no se necesita tabla `carreras`

### 11.3 REGLAS_CALENDARIZACION.md

- [x] Confirmar que el algoritmo no depende del grupo 4701
- [x] Confirmar que el horario se obtiene de `horarios` por `grupo_id`

---

## 12. RESUMEN DE AUDITORÍA

| # | Aspecto | Estado |
|---|---------|--------|
| 1 | Entidades vs tablas | ✅ Aprobado (con corrección documentada) |
| 2 | Consistencia de la calendarización | ✅ Aprobado |
| 3 | Horario | ✅ Aprobado |
| 4 | Calendario escolar | ✅ Aprobado |
| 5 | Teoría/práctica | ✅ Aprobado |
| 6 | Planeación académica | ✅ Aprobado |
| 7 | Escenarios | ✅ Aprobado |
| 8 | Versionado | ✅ Aprobado |
| 9 | Generación documental | ✅ Aprobado |
| 10 | Código provisional | ✅ Identificado |

---

## 13. SECUENCIA DE IMPLEMENTACIÓN — FASE A

### Paso 1: Modelo de datos
1. Crear diagrama ER definitivo
2. Validar relaciones
3. Documentar restricciones

### Paso 2: Migraciones
1. Crear migraciones para las 16 tablas
2. Definir índices y foráneas
3. Ejecutar migraciones

### Paso 3: Modelos Eloquent
1. Crear modelos para las 16 tablas
2. Definir relaciones
3. Definir fillable y casts
4. Probar relaciones

---

## APROBADO PARA IMPLEMENTACIÓN: **SÍ**

### Justificación

1. **Entidades vs tablas:** Resuelto. La entidad `Carrera` no necesita tabla; se almacena como campo en `asignaturas`.
2. **Consistencia de la calendarización:** Correcta. Existe una sola calendarización central.
3. **Horario:** Flexible. Soporta múltiples días y duraciones sin hardcode.
4. **Calendario escolar:** Configurable. Vacaciones, feriados y suspensiones como restricciones.
5. **Teoría/práctica:** Correcto. El modelo soporta la distribución.
6. **Planeación académica:** Correcto. El docente conserva la decisión.
7. **Escenarios:** Correcto. Son propuestas de calendarización, no sistemas distintos.
8. **Versionado:** Correcto. Permite modificar, aceptar y regenerar.
9. **Generación documental:** Correcto. Ambos documentos usan el modelo central.
10. **Código provisional:** Identificado. Se sabe qué archivos quedarán obsoletos.

### Secuencia exacta de implementación

```
Fase A: Modelo de datos
├── 1. Crear diagrama ER definitivo
├── 2. Crear migraciones (16 tablas)
├── 3. Crear modelos Eloquent (16 modelos)
├── 4. Definir relaciones
└── 5. Probar relaciones
```

---

> **NOTA IMPORTANTE:** El diseño está aprobado para implementación. No se debe programar nada hasta recibir instrucciones explícitas.
