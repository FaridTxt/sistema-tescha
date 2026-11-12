# MAPA DE DATOS ENTRE DOCUMENTOS

> **Fecha de generación:** 2026-09-28
> **Propósito:** Identificar qué información es compartida entre la Instrumentación Didáctica y el AvancePro, y qué información es independiente.

---

## 1. INFORMACIÓN IDÉNTICA ENTRE AMBOS DOCUMENTOS

Esta información debe ser **exactamente igual** en ambos documentos. Si cambia en uno, debe cambiar en el otro.

### 1.1 Datos de la Asignatura

| Campo | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-------|---------------------------|-----------|------------|
| Nombre de la asignatura | GESTIÓN DE PROYECTOS DE SOFTWARE | GESTIÓN DE PROYECTOS DE SOFTWARE | ✅ Sí |
| Clave de la asignatura | SCG-1009 | — | ⚠️ No aparece en AvancePro |
| Horas teoría (HT) | 3 | 3 | ✅ Sí |
| Horas práctica (HP) | 3 | 3 | ✅ Sí |
| Horas totales | 6 | 6 | ✅ Sí |
| Créditos | 6 | — | ⚠️ No aparece en AvancePro |
| Número de unidades | 5 | 5 | ✅ Sí |
| Periodo | 2026-2 | 2026-2 | ✅ Sí |
| Grupo | — | 4701 | ⚠️ No aparece en Instrumentación Didáctica |
| Carrera | INGENIERÍA EN SISTEMAS COMPUTACIONALES | INGENIERÍA EN SISTEMAS COMPUTACIONALES | ✅ Sí |
| Docente | Fabiola García Gutiérrez | Fabiola García Gutierrez | ✅ Sí |
| Jefe de División | Dra. Fabiola Orquídea Sánchez Hernández | DRA. FABIOLA ORQUÍDEA SÁNCHEZ HERNÁNDEZ | ✅ Sí |

### 1.1.1 Horario Semanal del Grupo (confirmado con profesora)

| Día | Horario | Horas | ¿Tiene clase? |
|-----|---------|-------|--------------|
| Lunes | 12:00-14:00 | 2 | Sí |
| Martes | — | 0 | No |
| Miércoles | 11:00-12:00 | 1 | Sí |
| Jueves | 11:00-12:00 | 1 | Sí |
| Viernes | 12:00-14:00 | 2 | Sí |
| **Total** | | **6** | |

**Nota:** Este horario es específico del grupo 4701. No aparece en los documentos oficiales, fue confirmado directamente por la profesora.

### 1.1.2 Distribución de Horas por Tema (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Distribución de horas por tema | Libre, decidida por el docente | Profesora |
| Distribución institucional preestablecida | No existe | Profesora |
| Regla "cada subtema = 1 hora" | No existe | Profesora |
| Duración fija de cada unidad | No existe | Profesora |
| El sistema impone horas por tema | No | Profesora |

**Implicación:** El docente captura las horas por tema/subtema. El sistema propone una calendarización basada en esas horas + horario + calendario escolar. La propuesta es revisable y modificable por el docente.

### 1.1.3 Exclusión de Días Feriados (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Días feriados | Se excluyen automáticamente | Profesora |
| Actividad en día feriado | Se recorre a la siguiente fecha disponible | Profesora |
| Ajuste de programación posterior | Se ajusta cuando el desplazamiento afecta fechas siguientes | Profesora |

**Implicación:** Esta regla debe aplicarse a la calendarización y mantenerse consistente entre Instrumentación Didáctica y Planeación / AvancePro. El sistema debe conocer el calendario de feriados (fuente: calendario escolar oficial).

### 1.1.4 Exclusión de Períodos Vacacionales (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Períodos vacacionales | Se excluyen automáticamente | Profesora |
| Actividad en período vacacional | Se recorre a la siguiente fecha disponible | Profesora |
| Ajuste de programación posterior | Se ajusta cuando el desplazamiento afecta fechas siguientes | Profesora |

**Implicación:** Esta regla debe aplicarse de forma consistente en Instrumentación Didáctica y Planeación / AvancePro. El sistema debe conocer los períodos vacacionales (fuente: calendario escolar oficial).

### 1.1.5 Fechas de Evaluación (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Fechas de evaluación | Definidas por el docente | Profesora |
| Existen fechas fijas institucionales | No | Profesora |
| El sistema propone fechas | Sí, pero el docente decide | Profesora |
| Revisión antes de generar documentos | Obligatoria | Profesora |

**Implicación:** El sistema propone fechas de evaluación basadas en la planeación del docente. El docente puede modificar y acomodar las fechas. El sistema valida que las fechas respeten las restricciones del calendario escolar. El docente revisa y confirma la planeación antes de generar los documents.

### 1.1.6 Fechas de Entrega de Evidencias (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Fechas de entrega de evidencias | Definidas por el docente | Profesora |
| El sistema considera esas fechas al generar escenarios | Sí | Profesora |
| Las fechas deben respetar el calendario escolar y el horario disponible | Sí | Profesora |
| El docente conserva la decisión final | Sí | Profesora |

### 1.1.7 Generación de Escenarios de Calendarización (requisito funcional)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| La aplicación NO debe generar una única propuesta | Confirmado | Profesora |
| Debe generar diferentes escenarios de programación | Confirmado | Profesora |
| Debe trabajar con UNA SOLA CALENDARIZACIÓN CENTRAL | Confirmado | Profesora |
| La calendarización será la fuente de información para ambos documentos | Confirmado | Profesora |

### 1.1.8 Duración del Periodo (confirmado con profesora)

| Aspecto | Valor | Fuente |
|---------|-------|--------|
| Periodo 2026-2 | 22 semanas efectivas | Profesora |
| Las 22 semanas son el rango de calendarización | Sí | Profesora |

### 1.1.9 Días No Laborables vs Días Sin Clase (confirmado con profesora)

| Concepto | Definición | Fuente |
|----------|------------|--------|
| Día no laborable | No hay clases en toda la institución (feriados, vacaciones, suspensiones) | Calendario escolar |
| Día sin clase | No hay clases para este grupo específico (ej: martes para grupo 4701) | Profesora |

**Reglas confirmadas:**
- No se conocen otros días de suspensión o actividades institucionales adicionales para el grupo 4701.
- El sistema utilizará el calendario escolar como fuente para feriados, suspensiones y periodos vacacionales.
- El martes NO es un día no laborable; simplemente el grupo 4701 no tiene clase ese día.
- No deben inventarse suspensiones adicionales.

**Principio fundamental:** "Mejor adaptación al calendario" NO significa inventar contenido ni cambiar las decisiones académicas del docente. Significa encontrar alternativas de distribución que cumplan la mayor cantidad posible de restricciones ya confirmadas y que sean válidas dentro del calendario disponible.

**Flujo de generación de escenarios:**

```
Escenario A: Tema 1.1 → fecha X, Tema 1.2 → fecha Y, Evaluación → fecha Z
Escenario B: Tema 1.1 → fecha X2, Tema 1.2 → fecha Y2, Evaluación → fecha Z2
                    ↓
        El docente selecciona uno
                    ↓
        CALENDARIZACIÓN ELEGIDA (fuente única)
                    ↓
        Instrumentación Didáctica + AvancePro
```

### 1.2 Estructura de Unidades

| Unidad | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|--------|---------------------------|-----------|------------|
| 1 | Introducción a la gestión de proyectos | INTRODUCCIÓN A LA GESTIÓN DE PROYECTOS | ✅ Sí |
| 2 | Gestión de calidad | GESTIÓN DE CALIDAD | ✅ Sí |
| 3 | Planificación del proyecto | PLANIFICACIÓN DEL PROYECTO | ✅ Sí |
| 4 | Presentación de la información | PRESENTACIÓN DE LA INFORMACIÓN | ✅ Sí |
| 5 | Supervisión y Revisión del proyecto | SUPERVISIÓN Y REVISIÓN DEL PROYECTO | ✅ Sí |

### 1.3 Estructura de Temas y Subtemas

| Tema/Subtema | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|--------------|---------------------------|-----------|------------|
| 1.1. Conceptos básicos para la gestión de proyectos | ✅ | ✅ | ✅ Sí |
| 1.2. Fases de la gestión de proyectos | ✅ | ✅ | ✅ Sí |
| 1.2.1. Planificación de proyectos | ✅ | ✅ | ✅ Sí |
| 1.2.2. Propuesta | ✅ | ✅ | ✅ Sí |
| 1.2.3. Selección y Evaluación de personal | ✅ | ✅ | ✅ Sí |
| 1.2.4. Supervisión y Revisión del proyecto | ✅ | ✅ | ✅ Sí |
| 1.2.5. Informes | ✅ | ✅ | ✅ Sí |
| 1.3. Fundamentos of Project Management Institute | ✅ | ✅ | ✅ Sí |
| 2.1. Plan de calidad del software | ✅ | ✅ | ✅ Sí |
| 2.2. La gestión de proyectos usando un marco de calidad | ✅ | ✅ | ✅ Sí |
| 2.3. Estándares y Métricas de calidad en la ingeniería de software | ✅ | ✅ | ✅ Sí |
| 2.3.1. CMMI | ✅ | ✅ | ✅ Sí |
| 2.3.2. MoProSoft | ✅ | ✅ | ✅ Sí |
| 2.4. Impacto de la calidad en tiempo, costo y alcance del proyecto | ✅ | ✅ | ✅ Sí |
| 2.5. Control del cambio | ✅ | ✅ | ✅ Sí |
| 3.1. Objetivo del proyecto | ✅ | ✅ | ✅ Sí |
| 3.2. Estimaciones de tiempo | ✅ | ✅ | ✅ Sí |
| 3.3. Estimaciones de costos | ✅ | ✅ | ✅ Sí |
| 3.4. Estimación de personal requerido | ✅ | ✅ | ✅ Sí |
| 3.5. Análisis de riesgos | ✅ | ✅ | ✅ Sí |
| 3.5.1. Tipos de riesgos | ✅ | ✅ | ✅ Sí |
| 3.5.2. Identificación, Impacto y proyección del riesgo | ✅ | ✅ | ✅ Sí |
| 3.5.3. Evaluación del riesgo | ✅ | ✅ | ✅ Sí |
| 3.5.4. Estrategias frente al riesgo | ✅ | ✅ | ✅ Sí |
| 3.6. Análisis de la viabilidad del proyecto | ✅ | ✅ | ✅ Sí |
| 4.1. Propuesta | ✅ | ✅ | ✅ Sí |
| 4.1.1. Justificación del proyecto | ✅ | ✅ | ✅ Sí |
| 4.1.2. Calendario de actividades | ✅ | ✅ | ✅ Sí |
| 4.1.3. Personal involucrado | ✅ | ✅ | ✅ Sí |
| 4.1.4. Políticas de comunicación y seguimiento | ✅ | ✅ | ✅ Sí |
| 4.2. Lineamientos de comunicación y seguimiento | ✅ | ✅ | ✅ Sí |
| 4.2.1. Formatos | ✅ | ✅ | ✅ Sí |
| 4.2.2. Herramientas | ✅ | ✅ | ✅ Sí |
| 4.3. Contrato | ✅ | ✅ | ✅ Sí |
| 5.1. Administración de actividades | ✅ | ✅ | ✅ Sí |
| 5.2. Administración del tiempo | ✅ | ✅ | ✅ Sí |
| 5.3. Evaluación y ajustes del proyecto | ✅ | ✅ | ✅ Sí |

### 1.4 Competencias Específicas

| Competencia | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-------------|---------------------------|-----------|------------|
| 1. Conoce y comprende el entorno de la gestión de proyectos | ✅ | — | ⚠️ No aparece en AvancePro |
| 2. Identifica y selecciona estándares y métricas de calidad... | ✅ | — | ⚠️ No aparece en AvancePro |
| 3. Planifica un proyecto de software utilizando una metodología... | ✅ | — | ⚠️ No aparece en AvancePro |
| 4. Identifica y selecciona propuestas de proyecto de software... | ✅ | — | ⚠️ No aparece en AvancePro |
| 5. Aplica políticas de comunicación y seguimiento... | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.5 Competencia General de la Asignatura

| Competencia | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-------------|---------------------------|-----------|------------|
| Aplica metodologías e instrumentos, para garantizar la gestión adecuada de un proyecto de software | ✅ | ✅ | ✅ Sí |

### 1.6 Actividades de Aprendizaje

| Actividad | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-----------|---------------------------|-----------|------------|
| Gestiona información sobre la terminología... | ✅ | — | ⚠️ No aparece en AvancePro |
| Gestiona información, en equipo, sobre los subtemas... | ✅ | — | ⚠️ No aparece en AvancePro |
| Gestiona información sobre las funciones principales del PMI... | ✅ | — | ⚠️ No aparece en AvancePro |
| Gestiona información sobre los requerimientos... | ✅ | — | ⚠️ No aparece en AvancePro |
| Gestiona información de al menos tres herramientas... | ✅ | — | ⚠️ No aparece en AvancePro |
| Plantea 3 métricas y los indicadores... | ✅ | — | ⚠️ No aparece en AvancePro |
| Representa los enfoques CMMI y MoProSoft... | ✅ | — | ⚠️ No aparece en AvancePro |
| Selecciona un proyecto de software, en equipo | ✅ | — | ⚠️ No aparece en AvancePro |
| Planifica un proyecto de software, elaborando un reporte técnico... | ✅ | — | ⚠️ No aparece en AvancePro |
| Elabora la propuesta del proyecto de desarrollo de software... | ✅ | — | ⚠️ No aparece en AvancePro |
| Gestiona información sobre las diferentes herramientas... | ✅ | — | ⚠️ No aparece en AvancePro |
| Aplica una herramienta para la administración y seguimiento... | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.7 Actividades de Enseñanza

| Actividad | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-----------|---------------------------|-----------|------------|
| Recuperación de conocimientos previos... | ✅ | — | ⚠️ No aparece en AvancePro |
| Exposición dialogada de la gestión de proyectos | ✅ | — | ⚠️ No aparece en AvancePro |
| Análisis comparativo de metodologías tradicionales y ágiles | ✅ | — | ⚠️ No aparece en AvancePro |
| Modelado guiado de la estructura de desglose del trabajo | ✅ | — | ⚠️ No aparece en AvancePro |
| Demostración del uso de herramientas para planificación... | ✅ | — | ⚠️ No aparece en AvancePro |
| Ejemplificación del cálculo de estimaciones de tiempo y costos | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.8 Indicadores de Alcance

| Indicador | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-----------|---------------------------|-----------|------------|
| A - Se adapta a situaciones y contextos complejos | ✅ | — | ⚠️ No aparece en AvancePro |
| B - Hace aportaciones a las actividades académicas... | ✅ | — | ⚠️ No aparece en AvancePro |
| C - Propone y/o explica soluciones o procedimientos... | ✅ | — | ⚠️ No aparece en AvancePro |
| D - Introduce recursos y experiencias... | ✅ | — | ⚠️ No aparece en AvancePro |
| E - Incorpora conocimientos y actividades interdisciplinarias... | ✅ | — | ⚠️ No aparece en AvancePro |
| F - Realiza su trabajo de manera autónoma y autorregulada | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.9 Niveles de Desempeño

| Nivel | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-------|---------------------------|-----------|------------|
| Excelente (95-100) | ✅ | — | ⚠️ No aparece en AvancePro |
| Notable (85-94) | ✅ | — | ⚠️ No aparece en AvancePro |
| Bueno (75-84) | ✅ | — | ⚠️ No aparece en AvancePro |
| Suficiente (70-74) | ✅ | — | ⚠️ No aparece en AvancePro |
| Insuficiente (NA) | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.10 Matriz de Evaluación

| Elemento | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|----------|---------------------------|-----------|------------|
| Proyecto Integrador y defensa (40%) | ✅ | — | ⚠️ No aparece en AvancePro |
| Actividades en clase, Estudios de caso, Tareas... (30%) | ✅ | — | ⚠️ No aparece en AvancePro |
| Evaluación Escrita (30%) | ✅ | — | ⚠️ No aparece en AvancePro |
| Instrumentos: Rubrica, Lista de cotejo, Cuestionario | ✅ | — | ⚠️ No aparece en AvancePro |

### 1.11 Tipos de Evaluación

| Tipo | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|------|---------------------------|-----------|------------|
| ED - Evaluación Diagnóstica | ✅ | — | ⚠️ No aparece en AvancePro |
| EFn - Evaluación Formativa | ✅ | — | ⚠️ No aparece en AvancePro |
| ES - Evaluación Sumativa | ✅ | — | ⚠️ No aparece en AvancePro |
| 2DA OP. - Segunda oportunidad | ✅ | ✅ | ✅ Sí |

### 1.12 Firmas

| Firma | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|-------|---------------------------|-----------|------------|
| Profesor(a) - Fabiola García Gutiérrez | ✅ | ✅ | ✅ Sí |
| Jefe(a) de división - Dra. Fabiola Orquídea Sánchez Hernández | ✅ | ✅ | ✅ Sí |

### 1.13 Datos Institucionales

| Dato | Instrumentación Didáctica | AvancePro | ¿Idéntico? |
|------|---------------------------|-----------|------------|
| Institución | — | TECNOLÓGICO DE ESTUDIOS SUPERIORES DE CHALCO | ⚠️ No aparece en Instrumentación Didáctica |
| Dirección | — | DIRECCIÓN ACADÉMICA | ⚠️ No aparece en Instrumentación Didáctica |
| Jefatura | — | JEFATURA DE DIVISIÓN DE INGENIERÍA EN SISTEMAS COMPUTACIONALES | ⚠️ No aparece en Instrumentación Didáctica |
| Dirección física | — | Carretera Federal México-Cuautla s/n... | ⚠️ No aparece en Instrumentación Didáctica |
| Teléfonos | — | 55 5982 10 88 y 55 5982 10 89 | ⚠️ No aparece en Instrumentación Didáctica |
| Email | — | dir.general@tesch.edu.mx | ⚠️ No aparece en Instrumentación Didáctica |

---

## 2. INFORMACIÓN QUE PUEDE CAMBIAR INDEPENDIENTEMENTE

Esta información es específica de cada documento y no necesita ser idéntica.

### 2.1 Solo en Instrumentación Didáctica

| Información | Descripción |
|-------------|-------------|
| Caracterización de la asignatura | Aportación al perfil profesional, relación con otras asignaturas |
| Intención didáctica | Enfoque pedagógico, organización de temas |
| Competencia de la asignatura | Competencia general |
| Análisis por competencias específicas | Tablas detalladas por competencia |
| Fuentes de información y apoyos didácticos | Bibliografía y recursos |
| Calendarización de evaluación en semanas | Cronograma de 22 semanas (TP, TR, SD) |
| Fecha de elaboración | Agosto de 2026 |
| Créditos | 6 |
| Clave de asignatura | SCG-1009 |
| Horas por competencia | 12, 12, 18, 12, 18 |
| Competencias específicas | 5 competencias detalladas |
| Actividades de aprendizaje | 12 actividades |
| Actividades de enseñanza | 6 actividades |
| Indicadores de alcance | 6 indicadores (A-F) |
| Niveles de desempeño | 5 niveles |
| Matriz de evaluación | 3 evidencias con porcentajes |
| Tipos de evaluación | ED, EFn, ES, 2DA OP. |
| Bibliografía | 5 libros |
| Apoyos didácticos | Videos, presentaciones, ejercicios, software, bibliotecas |

### 2.2 Solo en AvancePro

| Información | Descripción |
|-------------|-------------|
| Versión del formato | 2 |
| Fecha del formato | 19/Nov/2025 |
| Código del formato | S GI Del G3 |
| Nota de documento no controlado | "Toda copia en Papel es un 'Documento No Controlado'..." |
| Objetivo de la Materia | "Aplicar metodologías e instrumentos..." |
| Fechas programadas por subtema | Fechas específicas de cada subtema |
| Fechas reales por subtema | Fechas reales de cada subtema |
| Evaluación programada | Fechas de evaluación programadas |
| Evaluación real | Fechas de evaluación reales |
| Observaciones | Observaciones por subtema |
| Fechas de entrega de programación | 31 de agosto de 2026 |
| Fechas de seguimiento | 5-9 octubre, 23-27 noviembre |
| Fecha de reporte final | 23-27 de noviembre de 2026 |
| Segunda oportunidad | 14-18 de diciembre |
| Retroalimentación | 11-15 de enero |
| Vo.Bo. del Jefe de División | Vo.Bo. |

---

## 3. INFORMACIÓN QUE DEBE SER CALCULADA POR EL SISTEMA

| Cálculo | Descripción | Fórmula |
|---------|-------------|---------|
| Horas totales de la asignatura | Suma de HT + HP | HT + HP = 6 |
| Horas totales por competencia | Suma de HT + HP por competencia | HT + HP = 12, 12, 18, 12, 18 |
| Total de horas por asignatura | Suma de horas de todas las competencias | 12+12+18+12+18 = 72 |
| Suma de porcentajes de evaluación | Suma de % de evidencias | 40+30+30 = 100 |
| Suma de valores de indicadores | Suma de valores A-F | 5+5+5+5+2+8 = 25 |
| Semanas de calendarización | Número de semanas del periodo | 22 (en el ejemplo) |
| Fechas programadas | Cálculo basado en calendario escolar | Pendiente de confirmar |
| Fechas reales | Captura manual del docente | N/A |

---

## 4. INFORMACIÓN QUE VIENE PRECARGADA (CATÁLOGOS)

| Catálogo | Fuente | ¿Existe? |
|----------|--------|----------|
| Asignaturas | Catálogo del TESCHA | **Pendiente de confirmar** |
| Docentes | Catálogo del TESCHA | **Pendiente de confirmar** |
| Carreras | Catálogo del TESCHA | **Pendiente de confirmar** |
| Periodos escolares | Calendario escolar | ✅ Confirmado (2026-2) |
| Calendario escolar | CALENDARIO27.pdf | ✅ Confirmado |
| Feriados | Calendario escolar | ✅ Confirmado |
| Días no laborables | Calendario escolar | ✅ Confirmado |
| Competencias genéricas | Documento oficial | ✅ Confirmado (lista en Instrumentación Didáctica) |
| Tipos de evaluación | Documento oficial | ✅ Confirmado (ED, EFn, ES, 2DA OP.) |
| Niveles de desempeño | Documento oficial | ✅ Confirmado (5 niveles) |
| Instrumentos de evaluación | Documento oficial | ✅ Confirmado (Rubrica, Lista de cotejo, Cuestionario) |

---

## 5. INFORMACIÓN QUE CAPTURA EL DOCENTE

| Dato | ¿Quién lo captura? | ¿Es obligatorio? |
|------|-------------------|------------------|
| Nombre de la asignatura | Docente | Sí |
| Clave de asignatura | Docente | Sí |
| Horas teoría | Docente | Sí |
| Horas práctica | Docente | Sí |
| Créditos | Docente | Sí |
| Número de unidades | Docente | Sí |
| Periodo | Docente | Sí |
| Grupo | Docente | Sí |
| Carrera | Docente | Sí |
| Competencias específicas | Docente | Sí |
| Actividades de aprendizaje | Docente | Sí |
| Actividades de enseñanza | Docente | Sí |
| Indicadores de alcance | Docente | Sí |
| Niveles de desempeño | Docente | Sí |
| Matriz de evaluación | Docente | Sí |
| Tipos de evaluación | Docente | Sí |
| Fechas programadas | Docente | Sí |
| Fechas reales | Docente | No (se capturan después) |
| Observaciones | Docente | No |
| Bibliografía | Docente | Sí |
| Apoyos didácticos | Docente | Sí |

---

## 6. INFORMACIÓN QUE SE OBTIENE DEL TEMARIO

| Dato | Fuente | ¿Está en el temario? |
|------|--------|---------------------|
| Nombre de la asignatura | Temario | ✅ Sí |
| Clave de asignatura | Temario | ✅ Sí |
| Carrera | Temario | ✅ Sí |
| Horas teoría | Temario | ✅ Sí (SATCA1: 3-3-6) |
| Horas práctica | Temario | ✅ Sí (SATCA1: 3-3-6) |
| Créditos | Temario | ✅ Sí (SATCA1: 3-3-6) |
| Competencia general | Temario | ✅ Sí |
| Competencias específicas | Temario | ✅ Sí |
| Unidades | Temario | ✅ Sí |
| Temas y subtemas | Temario | ✅ Sí |
| Actividades de aprendizaje | Temario | ✅ Sí |
| Prácticas | Temario | ✅ Sí |
| Proyecto de asignatura | Temario | ✅ Sí |
| Evaluación por competencias | Temario | ✅ Sí |
| Fuentes de información | Temario | ✅ Sí |
| Relación con otras asignaturas | Temario | ✅ Sí |
| Competencias previas | Temario | ✅ Sí |
| Participantes en el diseño curricular | Temario | ✅ Sí |

---

## 7. INFORMACIÓN QUE SE OBTIENE DEL CALENDARIO ESCOLAR

| Dato | Fuente | ¿Está en el calendario? |
|------|--------|------------------------|
| Ciclo escolar | Calendario | ✅ Sí (2026-2027) |
| Inicio de ciclo | Calendario | ✅ Sí (Septiembre 2026) |
| Fin de ciclo | Calendario | ✅ Sí (Agosto 2027) |
| Inscripciones | Calendario | ✅ Sí (Agosto 2026) |
| Reinscripciones | Calendario | ✅ Sí (Enero 2027) |
| Revisiones académicas | Calendario | ✅ Sí (11-22 enero 2027) |
| Captura de calificaciones | Calendario | ✅ Sí (28 junio - 9 julio 2027) |
| Período vacacional | Calendario | ✅ Sí (Diciembre 2026 - Enero 2027) |
| Feriados | Calendario | ✅ Sí |
| Días no laborables | Calendario | ✅ Sí |
| Semanas del periodo | Calendario | ⚠️ No está explícito |

---

## 8. INFORMACIÓN QUE SE GENERA AUTOMÁTICAMENTE EN LOS DOCUMENTOS

| Documento | Información generada automáticamente |
|-----------|--------------------------------------|
| Instrumentación Didáctica | Horas totales (HT + HP), total de horas, suma de porcentajes, suma de indicadores |
| AvancePro | Fechas programadas (basadas en calendario), semanas de calendarización |
| Ambos | Datos institucionales, datos del docente, datos de la asignatura |

---

## 9. REGLAS DE CALENDARIZACIÓN QUE TODAVÍA NO PUEDEN DETERMINARSE

| # | Regla | Por qué no se puede determinar |
|---|-------|-------------------------------|
| 1 | ¿Cómo se calculan las fechas programadas? | No hay fórmula explícita en los documentos |
| 2 | ¿Cómo se distribuyen las horas por unidad? | No hay regla explícita |
| 3 | ¿Cómo se distribuyen las horas por semana? | No hay regla explícita |
| 4 | ¿Qué días de la semana hay clases? | No está explícito en los documentos |
| 5 | ¿Cuántas horas por sesión? | No está explícito en los documentos |
| 6 | ¿Cómo se manejan los días feriados? | No hay regla explícita |
| 7 | ¿Cómo se manejan los períodos vacacionales? | No hay regla explícita |
| 8 | ¿Cómo se calculan las semanas de evaluación? | No hay regla explícita |
| 9 | ¿Cómo se calculan las fechas de segunda oportunidad? | No hay regla explícita |
| 10 | ¿Cómo se calculan las fechas de retroalimentación? | No hay regla explícita |
| 11 | ¿Las fechas reales pueden ser diferentes a las programadas? | Sí, pero no hay regla para calcular la diferencia |
| 12 | ¿Qué pasa si una fecha programada cae en día no laborable? | No hay regla explícita |

---

## 10. RESUMEN EJECUTIVO

### 10.1 Información compartida (debe ser idéntica)

| Categoría | Campos |
|-----------|--------|
| Datos de la asignatura | Nombre, HT, HP, horas totales, número de unidades, periodo, carrera, docente, jefe de división |
| Estructura de unidades | 5 unidades con sus nombres |
| Estructura de temas y subtemas | Todos los temas y subtemas |
| Competencia general | "Aplica metodologías e instrumentos..." |
| Tipos de evaluación | ED, EFn, ES, 2DA OP. |
| Firmas | Docente y jefe de división |

### 10.2 Información exclusiva de Instrumentación Didáctica

| Categoría | Campos |
|-----------|--------|
| Caracterización | Aportación al perfil profesional, relación con otras asignaturas |
| Intención didáctica | Enfoque pedagógico |
| Competencias específicas | 5 competencias detalladas |
| Actividades | 12 de aprendizaje, 6 de enseñanza |
| Evaluación | Indicadores A-F, niveles de desempeño, matriz de evaluación |
| Bibliografía | 5 libros |
| Apoyos didácticos | Videos, presentaciones, etc. |
| Calendarización | 22 semanas (TP, TR, SD) |

### 10.3 Información exclusiva de AvancePro

| Categoría | Campos |
|-----------|--------|
| Metadatos del formato | Versión, fecha, código, nota |
| Objetivo de la materia | "Aplicar metodologías e instrumentos..." |
| Fechas | Programadas y reales por subtema |
| Evaluación | Programada y real |
| Observaciones | Por subtema |
| Entregas | Fechas de programación, seguimientos, reporte final |
| Segunda oportunidad | Fechas y retroalimentación |
| Vo.Bo. | Jefe de división |

---

## 11. HISTORIAL DE CAMBIOS

| Fecha | Autor | Descripción |
|-------|-------|-------------|
| 2026-09-28 | Agente IA | Creación inicial basada en análisis de documentos oficiales |
