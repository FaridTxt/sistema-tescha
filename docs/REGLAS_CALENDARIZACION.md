# REGLAS DE CALENDARIZACIÓN — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Estado:** Diseño definitivo (no implementado)
> **Principio central:** El sistema propone, el docente decide

---

## 1. PRINCIPIOS FUNDAMENTALES

### 1.1 El sistema NO decide por el docente

| El sistema propone | El docente decide |
|-------------------|-------------------|
| Fechas disponibles | Cuándo impartir cada tema |
| Distribución de sesiones | Cómo distribuir teoría/práctica |
| Escenarios válidos | Qué escenario seleccionar |
| Conflictos detectados | Cómo resolver conflictos |

### 1.2 El docente conserva la decisión académica

- Cuánto tiempo dedicar a cada tema
- Cómo distribuir teoría y práctica
- Qué actividades realizar
- Qué evaluaciones aplicar
- Qué evidencias solicitar
- Ajustes a la propuesta

---

## 2. ENTRADAS DE LA CALENDARIZACIÓN

### 2.1 Calendario escolar

| Dato | Fuente | Uso |
|------|--------|-----|
| Periodo escolar | JSON TESCHA | Rango de fechas |
| Feriados | JSON TESCHA | Excluir fechas |
| Vacaciones | JSON TESCHA | Excluir fechas |
| Suspensiones | JSON TESCHA | Excluir fechas |
| Semanas efectivas | JSON TESCHA | 22 semanas |

### 2.2 Horario del grupo

| Dato | Fuente | Uso |
|------|--------|-----|
| Días de clase | Tabla `horarios` | Se obtienen dinámicamente por `grupo_id` |
| Horas de inicio | Tabla `horarios` | `hora_inicio` |
| Horas de fin | Tabla `horarios` | `hora_fin` |
| Horas por día | Tabla `horarios` | `duracion_horas` |
| Total semanal | Tabla `horarios` | Suma de `duracion_horas` |

**Nota:** El algoritmo NO depende del grupo 4701. El horario se obtiene de la tabla `horarios` filtrando por `grupo_id`. Cualquier grupo con cualquier horario puede ser procesado.

### 2.3 Temario

| Dato | Fuente | Uso |
|------|--------|-----|
| Unidades | PDF Temario | 5 unidades |
| Subtemas | PDF Temario | 37 subtemas |
| Competencias | PDF Temario | 5 competencias |
| Horas por competencia | PDF Temario | 12, 12, 18, 12, 18 |
| Actividades | PDF Temario | Actividades de aprendizaje/enseñanza |

### 2.4 Planeación del docente

| Dato | Fuente | Uso |
|------|--------|-----|
| Horas por tema | Docente | Distribución de tiempo |
| Distribución teoría/práctica | Docente | 3h + 3h semanales |
| Actividades | Docente | Qué hacer en cada sesión |
| Evaluaciones | Docente | Cuándo evaluar |
| Evidencias | Docente | Qué evaluar |

---

## 3. RESTRICCIONES

### 3.1 Restricciones de calendario

| Restricción | Descripción |
|-------------|-------------|
| Excluir feriados | No programar en días festivos |
| Excluir vacaciones | No programar en periodos vacacionales |
| Excluir suspensiones | No programar en suspensiones institucionales |
| Recorrer actividades | Si cae en fecha no disponible, mover a siguiente fecha válida |

### 3.2 Restricciones de horario

| Restricción | Descripción |
|-------------|-------------|
| Solo días con clase | Lunes, Martes, Miércoles, Jueves |
| Horas específicas | Lunes 12:00-14:00, Martes 11:00-12:00, etc. |
| 6 horas semanales | Total de horas de clase |
| 3h teóricas + 3h prácticas | Distribución de horas |

### 3.3 Restricciones de contenido

| Restricción | Descripción |
|-------------|-------------|
| Respetar orden de temas | 1.1 → 1.2 → 1.2.1 → ... |
| Cubrir todos los subtemas | 37/37 subtemas |
| Respetar competencias | 5 competencias |
| Respetar evaluaciones | Definidas por el docente |
| Respetar evidencias | Definidas por el docente |

---

## 4. ALGORITMO DE CALENDARIZACIÓN

### 4.1 Proceso

```
1. Obtener días laborables del calendario
2. Cruzar con horario del grupo → sesiones disponibles
3. Obtener subtemas en orden
4. Asignar subtemas a sesiones según capacidad
5. Respetar evaluaciones y evidencias definidas
6. Detectar conflictos
7. Generar propuesta
```

### 4.2 Asignación de subtemas

| Tipo de sesión | Capacidad | Asignación |
|----------------|-----------|------------|
| 1 hora | 1-2 subtemas | Subtemas pequeños o continuación |
| 2 horas | 2-3 subtemas | Subtemas medianos o varios pequeños |

### 4.3 Continuidad de subtemas

Un subtema puede ocupar varias sesiones cuando:
- Es un subtema complejo (ej: 3.5 Análisis de riesgos)
- Requiere más tiempo del disponible en una sesión
- El docente decide dedicarle más tiempo

---

## 5. GENERACIÓN DE ESCENARIOS

### 5.1 Tipos de escenarios

| Escenario | Descripción | Cuándo usar |
|-----------|-------------|-------------|
| **A - Uniforme** | Distribución equilibrada de subtemas | Propuesta estándar |
| **B - Compacto** | Más subtemas por sesión, menos sesiones | Cuando se necesita terminar antes |
| **C - Extendido** | Menos subtemas por sesión, más sesiones | Cuando se necesita más tiempo por tema |

### 5.2 Diferencias entre escenarios

| Aspecto | Escenario A | Escenario B | Escenario C |
|---------|-------------|-------------|-------------|
| Subtemas por sesión | 2-3 | 3-4 | 1-2 |
| Sesiones necesarias | ~20 | ~15 | ~25 |
| Tiempo por tema | Medio | Menos | Más |
| Flexibilidad | Media | Baja | Alta |

### 5.3 Comparación de escenarios

| Criterio | Descripción |
|----------|-------------|
| Cobertura | 37/37 subtemas |
| Horas utilizadas | 6h semanales |
| Semanas necesarias | ~14-18 semanas |
| Conflictos | 0 |
| Flexibilidad | Alta/Media/Baja |

---

## 6. VALIDACIONES

### 6.1 Antes de generar documentos

| Validación | Descripción | Si falla |
|------------|-------------|----------|
| Fechas en días reales de clase | Verificar horario del grupo | Mostrar error |
| Ninguna fecha en vacaciones/feriado/suspensión | Verificar calendario escolar | Mostrar error |
| Horas disponibles correctas | 6h semanales | Mostrar error |
| 3h teóricas + 3h prácticas | Distribución correcta | Mostrar error |
| Cobertura de horas de unidades/competencias | Temario oficial | Mostrar error |
| Evaluaciones válidas | Definidas por el docente | Mostrar error |
| Evidencias válidas | Definidas por el docente | Mostrar error |
| Consistencia entre documentos | Misma calendarización | Mostrar error |
| Ausencia de actividades sin fecha | Todas las actividades tienen fecha | Mostrar error |
| Ausencia de conflictos | Sin traslapos | Mostrar error |

### 6.2 Mensajes de error

| Error | Mensaje |
|-------|---------|
| Fecha no disponible | "La fecha X no es un día de clase válido" |
| Conflicto de horario | "Existe un conflicto de horario en la sesión X" |
| Horas excedidas | "Se excedieron las 6 horas semanales" |
| Tema sin fecha | "El tema X no tiene fecha asignada" |
| Evaluación inválida | "La evaluación X no es válida" |

---

## 7. MODO DE CAMBIO Y REGENERACIÓN

### 7.1 Modificaciones del docente

| Modificación | ¿Qué se recalcula? | ¿Qué se conserva? |
|--------------|-------------------|-------------------|
| Horas de un tema | Distribución de sesiones | Orden de temas |
| Actividad | Fechas de la actividad | Otras actividades |
| Evidencia | Fechas de evaluación | Otras evidencias |
| Evaluación | Fechas de evaluación | Otras evaluaciones |
| Fecha | Distribución de sesiones | Decisiones del docente |
| Distribución teoría/práctica | Asignación de horas | Total de horas |

### 7.2 Proceso de regeneración

```
1. Docente modifica un elemento
   ↓
2. Sistema identifica qué se afecta
   ↓
3. Sistema recalcula las fechas afectadas
   ↓
4. Sistema valida la nueva propuesta
   ↓
5. Sistema muestra los cambios
   ↓
6. Docente acepta o rechaza
```

---

## 8. REGLA DE CONSISTENCIA

### 8.1 Fuente única

**La calendarización central es la ÚNICA fuente de fechas para ambos documentos.**

### 8.2 Prohibido

- ❌ Fechas independientes en Instrumentación
- ❌ Fechas independientes en AvancePro
- ❌ Modificar fechas en un documento sin afectar el otro
- ❌ Generar documentos con diferentes calendarizaciones

### 8.3 Obligatorio

- ✅ Ambos documentos usan la misma calendarización
- ✅ Modificaciones se reflejan en ambos documentos
- ✅ Validación de consistencia antes de generar
- ✅ Versionado de cambios

---

## 9. EJEMPLO DE CALENDARIZACIÓN

### 9.1 Entradas

- Periodo: 2026-2 (22 semanas)
- Horario: L/M/J/V (6h semanales)
- Temario: 5 unidades, 37 subtemas
- Evaluaciones: Definidas por el docente
- Evidencias: Definidas por el docente

### 9.2 Proceso

1. Obtener 22 semanas de días laborables
2. Cruzar con horario L/M/J/V → ~88 sesiones disponibles
3. Asignar 37 subtemas a sesiones
4. Respetar evaluaciones y evidencias
5. Detectar conflictos
6. Generar propuesta

### 9.3 Resultado

- 37/37 subtemas cubiertos
- 6h semanales respetadas
- 0 conflictos
- Propuesta válida para revisión

---

> **NOTA IMPORTANTE:** Este documento define las reglas de calendarización. No se debe implementar nada hasta revisar y aprobar este diseño.
