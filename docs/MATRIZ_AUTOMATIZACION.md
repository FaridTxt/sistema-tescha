# MATRIZ DE AUTOMATIZACIÓN — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Fuentes:** Formatos oficiales en blanco + documentos llenos + calendario + temario + horario
> **Objetivo:** Definir qué captura el profesor y qué hace automáticamente el sistema

---

## 1. MATRIZ DE AUTOMATIZACIÓN POR CAMPO

### 1.1 AvancePro (Planeación / Avance Programático)

| # | Campo | ¿Vacío en formato? | ¿Lleno en ejemplo? | Fuente | ¿Docente puede modificar? | ¿Debe coincidir con Instrumentación? | ¿Depende de otra información? |
|---|-------|---------------------|-------------------|--------|---------------------------|-------------------------------------|------------------------------|
| 1 | Nombre de la materia | ✅ Sí | ✅ Sí | TEMARIO | ❌ No (se selecciona) | ✅ Sí | ❌ No |
| 2 | HT (Horas Teóricas) | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 3 | HP (Horas Prácticas) | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 4 | HT (Horas Totales) | ✅ Sí | ✅ Sí | SISTEMA | ❌ No | ✅ Sí | ✅ Sí (HT + HP) |
| 5 | No. de Unidades | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 6 | Objetivo de la materia | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 7 | Grupo | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí (selecciona) | ✅ Sí | ❌ No |
| 8 | Carrera | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 9 | Docente | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 10 | Unidad Temática | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 11 | Subtemas | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 12 | Fechas Programado | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí (ajustable) | ✅ Sí | ✅ Sí (calendario + horario + planeación) |
| 13 | Fechas Real | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ✅ Sí | ✅ Sí (se captura durante el semestre) |
| 14 | Evaluación Programada | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí (ajustable) | ✅ Sí | ✅ Sí (planeación del docente) |
| 15 | Evaluación Real | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ✅ Sí | ✅ Sí (se captura durante el semestre) |
| 16 | Firma del Docente | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ✅ Sí | ❌ No |
| 17 | Firma del Jefe Académico | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 18 | Observaciones | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ❌ No | ❌ No |
| 19 | Fecha de entrega de programación | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ❌ No | ✅ Sí (inicio de clases) |
| 20 | Fecha 1er Seguimiento | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (semana 6) |
| 21 | Fecha 2do Seguimiento | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (semana 12) |
| 22 | Fecha 3er Seguimiento | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (semana 19) |
| 23 | Fecha entrega reporte final | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (semana 18) |
| 24 | Vo.Bo. del Jefe de División | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ❌ No | ❌ No |

### 1.2 Instrumentación Didáctica

| # | Campo | ¿Vacío en formato? | ¿Lleno en ejemplo? | Fuente | ¿Docente puede modificar? | ¿Debe coincidir con AvancePro? | ¿Depende de otra información? |
|---|-------|---------------------|-------------------|--------|---------------------------|-------------------------------|------------------------------|
| 1 | Periodo | ✅ Sí | ✅ Sí | CALENDARIO | ❌ No | ✅ Sí | ❌ No |
| 2 | Nombre de la asignatura | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 3 | Plan de estudios | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 4 | Clave de la asignatura | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 5 | HT-HP-Créditos | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 6 | Caracterización de la asignatura | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ❌ No | ❌ No |
| 7 | Intención didáctica | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ❌ No | ❌ No |
| 8 | Competencia de la asignatura | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 9 | Competencias específicas | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 10 | Temas y subtemas | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 11 | Actividades de aprendizaje | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 12 | Actividades de enseñanza | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 13 | Competencias genéricas | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 14 | Horas teórico-prácticas | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ✅ Sí | ✅ Sí (distribución del docente) |
| 15 | Indicadores de alcance | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 16 | Valor del indicador | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (suma = 25) |
| 17 | Niveles de desempeño | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |
| 18 | Matriz de evaluación | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (evidencias + porcentajes) |
| 19 | Fuentes de información | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 20 | Apoyos didácticos | ✅ Sí | ✅ Sí | TEMARIO | ❌ No | ✅ Sí | ❌ No |
| 21 | Calendarización de evaluación | ✅ Sí | ✅ Sí | SISTEMA | ✅ Sí | ✅ Sí | ✅ Sí (calendario + horario + planeación) |
| 22 | Fecha de elaboración | ✅ Sí | ✅ Sí | SISTEMA | ❌ No | ❌ No | ✅ Sí (fecha actual) |
| 23 | Nombre y firma del profesor | ✅ Sí | ✅ Sí | DOCENTE | ✅ Sí | ✅ Sí | ❌ No |
| 24 | Nombre y firma del jefe de división | ✅ Sí | ✅ Sí | INSTITUCIÓN | ❌ No | ✅ Sí | ❌ No |

---

## 2. QUÉ INFORMACIÓN CAPTURA EL PROFESOR

### 2.1 Selección de datos (no captura, selecciona)

| Dato | Fuente |
|------|--------|
| Asignatura | Catálogo de asignaturas |
| Grupo | Catálogo de grupos |
| Periodo | Calendario escolar |

### 2.2 Datos que el docente proporciona directamente

| Dato | Documento | ¿Por qué lo captura el docente? |
|------|-----------|-------------------------------|
| Fechas Programado | AvancePro | Define cuándo impartirá cada tema |
| Fechas Real | AvancePro | Registra cuándo impartió cada tema |
| Evaluación Programada | AvancePro | Define fechas de evaluaciones |
| Evaluación Real | AvancePro | Registra fechas reales de evaluaciones |
| Observaciones | AvancePro | Notas sobre el seguimiento |
| Horas teórico-prácticas | Instrumentación | Distribución de horas por unidad |
| Valor del indicador | Instrumentación | Ponderación de indicadores |
| Matriz de evaluación | Instrumentación | Evidencias y porcentajes |
| Calendarización de evaluación | Instrumentación | Semanas de evaluación |
| Firma del profesor | Ambos | Validación del documento |

### 2.3 Datos que el docente puede ajustar (propuestos por el sistema)

| Dato | Documento | ¿Por qué es ajustable? |
|------|-----------|----------------------|
| Fechas Programado | AvancePro | Puede cambiar fechas propuestas |
| Evaluación Programada | AvancePro | Puede cambiar fechas de evaluación |
| Horas teórico-prácticas | Instrumentación | Puede redistribuir horas |
| Matriz de evaluación | Instrumentación | Puede ajustar porcentajes |
| Calendarización de evaluación | Instrumentación | Puede ajustar semanas |

---

## 3. QUÉ INFORMACIÓN OBTIENE EL SISTEMA AUTOMÁTICAMENTE

### 3.1 Del temario

| Dato | Uso |
|------|-----|
| Nombre de la asignatura | Ambos documentos |
| Clave de la asignatura | Ambos documentos |
| HT, HP, Créditos | Ambos documentos |
| Objetivo de la materia | AvancePro |
| Unidades | Ambos documentos |
| Subtemas | Ambos documentos |
| Competencias específicas | Instrumentación |
| Actividades de aprendizaje | Instrumentación |
| Actividades de enseñanza | Instrumentación |
| Competencias genéricas | Instrumentación |
| Fuentes de información | Instrumentación |
| Apoyos didácticos | Instrumentación |

### 3.2 Del calendario escolar

| Dato | Uso |
|------|-----|
| Periodo escolar | Ambos documentos |
| Feriados | Restricción de fechas |
| Vacaciones | Restricción de fechas |
| Suspensiones | Restricción de fechas |
| Semanas efectivas | Cálculo de calendarización |

### 3.3 Del horario del grupo

| Dato | Uso |
|------|-----|
| Días de clase | Disponibilidad de sesiones |
| Horas de inicio y fin | Horario de sesiones |
| Horas semanales | Cálculo de capacidad |

### 3.4 De información institucional

| Dato | Uso |
|------|-----|
| Carrera | Ambos documentos |
| Docente | Ambos documentos |
| Plan de estudios | Instrumentación |
| Indicadores de alcance | Instrumentación |
| Niveles de desempeño | Instrumentación |

---

## 4. QUÉ INFORMACIÓN CALCULA EL SISTEMA

### 4.1 Cálculos automáticos

| Cálculo | Fórmula | Uso |
|---------|---------|-----|
| Horas totales | HT + HP | AvancePro |
| Fechas programadas | Calendario + Horario + Planeación | AvancePro |
| Fechas de evaluación | Planeación del docente | AvancePro |
| Fechas de seguimiento | Semanas 6, 12, 18, 19 | AvancePro |
| Horas teórico-prácticas | Distribución del docente | Instrumentación |
| Valor del indicador | Suma de valores = 25 | Instrumentación |
| Calendarización de evaluación | Calendario + Horario + Planeación | Instrumentación |
| Fecha de elaboración | Fecha actual | Instrumentación |

### 4.2 Propuestas del sistema (ajustables)

| Propuesta | Basada en | ¿El docente puede modificar? |
|-----------|-----------|------------------------------|
| Distribución de subtemas en sesiones | Calendario + Horario + Planeación | ✅ Sí |
| Fechas de evaluación | Planeación del docente | ✅ Sí |
| Escenarios de calendarización | Calendario + Horario + Planeación | ✅ Sí |

---

## 5. QUÉ INFORMACIÓN DEBE COINCIDIR ENTRE AMBOS DOCUMENTOS

### 5.1 Campos que DEBEN ser idénticos

| Campo | AvancePro | Instrumentación | ¿Por qué debe coincidir? |
|-------|-----------|-----------------|-------------------------|
| Nombre de la asignatura | ✅ | ✅ | Es la misma asignatura |
| HT | ✅ | ✅ | Es la misma asignatura |
| HP | ✅ | ✅ | Es la misma asignatura |
| Créditos | ✅ | ✅ | Es la misma asignatura |
| No. de Unidades | ✅ | ✅ | Es la misma asignatura |
| Objetivo de la materia | ✅ | ✅ | Es la misma asignatura |
| Grupo | ✅ | ✅ | Es el mismo grupo |
| Carrera | ✅ | ✅ | Es la misma carrera |
| Docente | ✅ | ✅ | Es el mismo docente |
| Periodo | ✅ | ✅ | Es el mismo periodo |
| Unidad Temática | ✅ | ✅ | Son las mismas unidades |
| Subtemas | ✅ | ✅ | Son los mismos subtemas |
| Competencia de la asignatura | ❌ | ✅ | Solo en Instrumentación |
| Competencias específicas | ❌ | ✅ | Solo en Instrumentación |
| Actividades de aprendizaje | ❌ | ✅ | Solo en Instrumentación |
| Actividades de enseñanza | ❌ | ✅ | Solo en Instrumentación |
| Competencias genéricas | ❌ | ✅ | Solo en Instrumentación |
| Horas teórico-prácticas | ❌ | ✅ | Solo en Instrumentación |
| Indicadores de alcance | ❌ | ✅ | Solo en Instrumentación |
| Niveles de desempeño | ❌ | ✅ | Solo en Instrumentación |
| Matriz de evaluación | ❌ | ✅ | Solo en Instrumentación |
| Fuentes de información | ❌ | ✅ | Solo en Instrumentación |
| Apoyos didácticos | ❌ | ✅ | Solo en Instrumentación |
| Calendarización de evaluación | ❌ | ✅ | Solo en Instrumentación |
| Fechas Programado | ✅ | ❌ | Solo en AvancePro |
| Fechas Real | ✅ | ❌ | Solo en AvancePro |
| Evaluación Programada | ✅ | ❌ | Solo en AvancePro |
| Evaluación Real | ✅ | ❌ | Solo en AvancePro |
| Observaciones | ✅ | ❌ | Solo en AvancePro |
| Fechas de seguimiento | ✅ | ❌ | Solo en AvancePro |

### 5.2 Campos que NO necesitan coincidir

| Campo | Motivo |
|-------|--------|
| Fechas Real | Se capturan durante el semestre |
| Evaluación Real | Se capturan durante el semestre |
| Observaciones | Son notas del seguimiento |
| Fechas de seguimiento | Son específicas del AvancePro |

---

## 6. CALENDARIZACIÓN CENTRAL

### 6.1 Concepto

```
CALENDARIZACIÓN CENTRAL
        ↓
Fuente única de fechas
        ↓
┌──────────────────┬──────────────────┐
│                  │                  │
│  AvancePro       │  Instrumentación │
│                  │                  │
└──────────────────┴──────────────────┘
```

### 6.2 Entradas de la calendarización central

| Entrada | Fuente | ¿Quién la proporciona? |
|---------|--------|------------------------|
| Calendario escolar | JSON TESCHA | Sistema |
| Horario del grupo | PDF Horarios | Sistema |
| Periodo | Calendario escolar | Sistema |
| Temas/Subtemas | PDF Temario | Sistema |
| Horas definidas por el docente | Planeación | Docente |
| Actividades | Planeación | Docente |
| Evaluaciones | Planeación | Docente |
| Evidencias | Planeación | Docente |

### 6.3 Salidas de la calendarización central

| Salida | Uso | ¿Quién la utiliza? |
|--------|-----|-------------------|
| Fechas propuestas | AvancePro | Sistema |
| Distribución de sesiones | Ambos | Sistema |
| Conflictos | Ambos | Sistema |
| Escenarios posibles | Ambos | Sistema |

### 6.4 Reglas de la calendarización central

| Regla | Descripción |
|-------|-------------|
| Solo días con clase | Usar horario del grupo |
| Excluir feriados | Calendario escolar |
| Excluir vacaciones | Calendario escolar |
| Excluir suspensiones | Calendario escolar |
| Recorrer actividades | Si cae en fecha no disponible |
| Respetar decisiones del docente | Planeación del docente |
| Permitir revisar y modificar | Ajustes del docente |

---

## 7. REGLAS QUE SIGUEN PENDIENTES REALMENTE

### 7.1 HORARIO OFICIAL DEL GRUPO 4701 (CONFIRMADO)

**Fuente oficial:** `docs/Horarios 2026-2 -Presencial.pdf`

| Día | Horario | Horas |
|-----|---------|-------|
| Lunes | 12:00 - 14:00 | 2h |
| Martes | 11:00 - 12:00 | 1h |
| Miércoles | 11:00 - 12:00 | 1h |
| Jueves | 12:00 - 14:00 | 2h |
| Viernes | Sin clase | 0h |
| **Total** | | **6h** |

**Estado:** ✅ CONFIRMADO — El PDF oficial es la fuente autoritaria.

### 7.2 Pendientes de verificación de documentos (NO requieren preguntas a la profesora)

| # | Verificación | Estado | Impacto |
|---|--------------|--------|---------|
| 1 | Formato AvancePro: ¿HT aparece dos veces? | 📄 Se verifica en el documento | Posible error del formato |
| 2 | Formato Instrumentación: ¿17 semanas o 22? | 📄 Se verifica en el documento | Afecta la calendarización |
| 3 | ¿Los indicadores A-F son los mismos para todas las competencias? | 📄 Se verifica en el documento | Afecta la evaluación |

### 7.3 Pendientes de diseño del sistema (NO son preguntas a la profesora)

| # | Diseño | Estado | Impacto |
|---|--------|--------|---------|
| 1 | Arquitectura de base de datos | 🔧 Pendiente de diseño | Migraciones y modelos |
| 2 | Sistema de generación de escenarios | 🔧 Pendiente de diseño | Múltiples propuestas |
| 3 | Sistema de ajustes del docente | 🔧 Pendiente de diseño | Modificación de propuestas |
| 4 | Generación de documentos PDF | 🔧 Pendiente de diseño | Instrumentación + AvancePro |

---

## 8. RESUMEN EJECUTIVO

### 8.1 ¿Qué captura el profesor?

- Selecciona: asignatura, grupo, periodo
- Proporciona: fechas reales, evaluaciones reales, observaciones
- Ajusta: fechas programadas, evaluaciones programadas, horas, matriz de evaluación

### 8.2 ¿Qué obtiene el sistema automáticamente?

- Del temario: asignatura, unidades, subtemas, competencias, actividades
- Del calendario: periodo, feriados, vacaciones, suspensiones
- Del horario: días de clase, horas de sesión
- Institucional: carrera, docente, indicadores, niveles de desempeño

### 8.3 ¿Qué calcula el sistema?

- Horas totales
- Fechas programadas
- Fechas de evaluación
- Fechas de seguimiento
- Horas teórico-prácticas
- Valor del indicador
- Calendarización de evaluación

### 8.4 ¿Qué debe coincidir entre documentos?

- Datos de la asignatura (nombre, HT, HP, créditos, unidades, subtemas)
- Datos del grupo (grupo, carrera, docente, periodo)
- Competencias y actividades (Instrumentación)
- Fechas programadas (AvancePro)

---

> **NOTA IMPORTANTE:** Esta matriz es la base para definir la arquitectura definitiva del sistema. No se debe programar nada hasta confirmar las reglas pendientes y diseñar la base de datos.
