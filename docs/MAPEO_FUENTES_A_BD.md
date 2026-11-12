# MAPEO DE FUENTES A BASE DE DATOS — FASE B

> **Fecha de generación:** 2026-10-08
> **Propósito:** Mapear explícitamente cada dato de las fuentes a las tablas de la BD

---

## 1. HORARIOS PDF → BD

### 1.1 Docente

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Horarios PDF | `docentes` | `nombre` | Extracción literal | `Fabiola Garcia Gutierrez` |
| Horarios PDF | `docentes` | `email` | No está en la fuente | `NULL` (no inventar) |

### 1.2 Asignatura

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Horarios PDF | `asignaturas` | `nombre` | Extracción literal | `GESTIÓN DE PROYECTOS DE SOFTWARE` |
| Horarios PDF | `asignaturas` | `clave` | No está en la fuente | `SCG-1009` (del temario) |
| Horarios PDF | `asignaturas` | `ht` | No está en la fuente | `3` (confirmado) |
| Horarios PDF | `asignaturas` | `hp` | No está en la fuente | `3` (confirmado) |
| Horarios PDF | `asignaturas` | `creditos` | No está en la fuente | `6` (confirmado) |
| Horarios PDF | `asignaturas` | `objetivo` | No está en la fuente | Del temario |
| Horarios PDF | `asignaturas` | `carrera` | No está en la fuente | `Ingeniería en Sistemas Computacionales` |

### 1.3 Grupo

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Horarios PDF | `grupos` | `nombre` | Extracción literal | `4701` |

### 1.4 Horario

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Horarios PDF | `horarios` | `dia` | Normalización | `lunes` |
| Horarios PDF | `horarios` | `hora_inicio` | Extracción literal | `12:00` |
| Horarios PDF | `horarios` | `hora_fin` | Extracción literal | `14:00` |
| Horarios PDF | `horarios` | `duracion_horas` | Cálculo | `2` |
| Horarios PDF | `horarios` | `dia` | Normalización | `martes` |
| Horarios PDF | `horarios` | `hora_inicio` | Extracción literal | `11:00` |
| Horarios PDF | `horarios` | `hora_fin` | Extracción literal | `12:00` |
| Horarios PDF | `horarios` | `duracion_horas` | Cálculo | `1` |
| Horarios PDF | `horarios` | `dia` | Normalización | `miercoles` |
| Horarios PDF | `horarios` | `hora_inicio` | Extracción literal | `11:00` |
| Horarios PDF | `horarios` | `hora_fin` | Extracción literal | `12:00` |
| Horarios PDF | `horarios` | `duracion_horas` | Cálculo | `1` |
| Horarios PDF | `horarios` | `dia` | Normalización | `jueves` |
| Horarios PDF | `horarios` | `hora_inicio` | Extracción literal | `12:00` |
| Horarios PDF | `horarios` | `hora_fin` | Extracción literal | `14:00` |
| Horarios PDF | `horarios` | `duracion_horas` | Cálculo | `2` |
| Horarios PDF | `horarios` | `salon` | Extracción literal | `E10` |
| Horarios PDF | `horarios` | `edificio` | Extracción literal | `BICENTENARIO DE LA INDEPENDENCIA` |

---

## 2. CALENDARIO JSON → BD

### 2.1 Periodo

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Calendario JSON | `periodos` | `nombre` | Extracción literal | `2026-2` |
| Calendario JSON | `periodos` | `fecha_inicio` | Extracción literal | `2026-09-01` |
| Calendario JSON | `periodos` | `fecha_fin` | Extracción literal | `2027-01-29` |
| Calendario JSON | `periodos` | `semanas` | Confirmado | `22` |

### 2.2 Calendario escolar

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Calendario JSON | `calendarios_escolares` | `nombre` | Extracción literal | `Calendario 2026-2027` |
| Calendario JSON | `calendarios_escolares` | `fecha_inicio` | Extracción literal | `2026-09-01` |
| Calendario JSON | `calendarios_escolares` | `fecha_fin` | Extracción literal | `2027-08-30` |
| Calendario JSON | `calendarios_escolares` | `feriados` | Extracción JSON | Lista de feriados |
| Calendario JSON | `calendarios_escolares` | `vacaciones` | Extracción JSON | Lista de vacaciones |
| Calendario JSON | `calendarios_escolares` | `suspensiones` | Extracción JSON | Lista de suspensiones |

---

## 3. TEMARIO PDF → BD

### 3.1 Unidades

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Temario PDF | `unidades` | `numero` | Extracción literal | `1` |
| Temario PDF | `unidades` | `nombre` | Extracción literal | `Introducción a la gestión de proyectos` |
| Temario PDF | `unidades` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `unidades` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `unidades` | `numero` | Extracción literal | `2` |
| Temario PDF | `unidades` | `nombre` | Extracción literal | `Gestión de calidad` |
| Temario PDF | `unidades` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `unidades` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `unidades` | `numero` | Extracción literal | `3` |
| Temario PDF | `unidades` | `nombre` | Extracción literal | `Planificación del proyecto` |
| Temario PDF | `unidades` | `horas_teoria` | Extracción literal | `9` |
| Temario PDF | `unidades` | `horas_practica` | Extracción literal | `9` |
| Temario PDF | `unidades` | `numero` | Extracción literal | `4` |
| Temario PDF | `unidades` | `nombre` | Extracción literal | `Presentación de la información` |
| Temario PDF | `unidades` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `unidades` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `unidades` | `numero` | Extracción literal | `5` |
| Temario PDF | `unidades` | `nombre` | Extracción literal | `Supervisión y Revisión del proyecto` |
| Temario PDF | `unidades` | `horas_teoria` | Extracción literal | `9` |
| Temario PDF | `unidades` | `horas_practica` | Extracción literal | `9` |

### 3.2 Competencias

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Temario PDF | `competencias` | `numero` | Extracción literal | `1` |
| Temario PDF | `competencias` | `descripcion` | Extracción literal | `Conoce y comprende el entorno de la gestión de proyectos` |
| Temario PDF | `competencias` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `competencias` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `competencias` | `numero` | Extracción literal | `2` |
| Temario PDF | `competencias` | `descripcion` | Extracción literal | `Identifica y selecciona estándares y métricas de calidad...` |
| Temario PDF | `competencias` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `competencias` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `competencias` | `numero` | Extracción literal | `3` |
| Temario PDF | `competencias` | `descripcion` | Extracción literal | `Planifica un proyecto de software...` |
| Temario PDF | `competencias` | `horas_teoria` | Extracción literal | `9` |
| Temario PDF | `competencias` | `horas_practica` | Extracción literal | `9` |
| Temario PDF | `competencias` | `numero` | Extracción literal | `4` |
| Temario PDF | `competencias` | `descripcion` | Extracción literal | `Identifica y selecciona propuestas de proyecto...` |
| Temario PDF | `competencias` | `horas_teoria` | Extracción literal | `6` |
| Temario PDF | `competencias` | `horas_practica` | Extracción literal | `6` |
| Temario PDF | `competencias` | `numero` | Extracción literal | `5` |
| Temario PDF | `competencias` | `descripcion` | Extracción literal | `Aplica políticas de comunicación y seguimiento...` |
| Temario PDF | `competencias` | `horas_teoria` | Extracción literal | `9` |
| Temario PDF | `competencias` | `horas_practica` | Extracción literal | `9` |

### 3.3 Temas/Subtemas

| Fuente | Tabla | Campo | Transformación | Valor resultante |
|--------|-------|-------|----------------|------------------|
| Temario PDF | `temas` | `numero` | Extracción literal | `1.1` |
| Temario PDF | `temas` | `nombre` | Extracción literal | `Conceptos básicos para la gestión de proyectos` |
| Temario PDF | `temas` | `orden` | Secuencia | `1` |
| Temario PDF | `temas` | `numero` | Extracción literal | `1.2` |
| Temario PDF | `temas` | `nombre` | Extracción literal | `Fases de la gestión de proyectos` |
| Temario PDF | `temas` | `orden` | Secuencia | `2` |
| Temario PDF | `temas` | `numero` | Extracción literal | `1.2.1` |
| Temario PDF | `temas` | `nombre` | Extracción literal | `Planificación de proyectos` |
| Temario PDF | `temas` | `padre_id` | Relación | `1.2` |
| Temario PDF | `temas` | `orden` | Secuencia | `3` |
| ... | ... | ... | ... | ... |

**Total:** 37 temas/subtemas

---

## 4. RESUMEN DE TRANSFORMACIONES

| Tipo de transformación | Cantidad | Ejemplo |
|------------------------|----------|---------|
| Extracción literal | ~50 | `Fabiola Garcia Gutierrez` |
| Normalización | ~4 | `Lunes` → `lunes` |
| Cálculo | ~4 | `14:00 - 12:00 = 2h` |
| Relación | ~10 | `1.2.1` → padre `1.2` |
| Secuencia | ~37 | `orden` incremental |

---

> **NOTA IMPORTANTE:** Este mapeo es la referencia para crear los seeders. Los seeders deben usar `updateOrCreate` para ser reproducibles.
