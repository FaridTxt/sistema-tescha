# REGLAS DEL MOTOR DE CALENDARIZACIÓN — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-08
> **Estado:** Diseño definitivo (no implementado)
> **Principio central:** El sistema propone, el docente decide

---

## 1. REGLAS ACADÉMICAS CONFIRMADAS

### 1.1 Reglas del periodo

| Regla | Valor |
|-------|-------|
| Periodo | 2026-2 |
| Semanas efectivas | 22 |
| Fecha de inicio | 2026-09-01 |
| Fecha de fin | 2027-01-29 |

### 1.2 Reglas de horario

| Día | Horario | Horas |
|-----|---------|-------|
| Lunes | 12:00-14:00 | 2h |
| Martes | 11:00-12:00 | 1h |
| Miércoles | 11:00-12:00 | 1h |
| Jueves | 12:00-14:00 | 2h |
| Viernes | Sin clase | 0h |
| **Total** | | **6h** |

**Nota:** El horario se obtiene de la BD, NO está hardcodeado.

### 1.3 Reglas de distribución

| Regla | Descripción |
|-------|-------------|
| Horas semanales | 6h |
| Horas teóricas | 3h |
| Horas prácticas | 3h |
| Distribución teoría/práctica | Libre por día, siempre que el total semanal sea 3h + 3h |

### 1.4 Reglas de contenido

| Regla | Descripción |
|-------|-------------|
| Unidades | 5 |
| Competencias | 5 |
| Temas/Subtemas | 37 |
| Orden | Debe respetarse el orden del temario |

---

## 2. RESTRICCIONES DURAS

| # | Restricción | Descripción | Efecto |
|---|-------------|-------------|--------|
| 1 | Fecha fuera del periodo | Fecha antes del inicio o después del fin | Invalida escenario |
| 2 | Día sin clase | Programar en un día que no tiene clase | Invalida escenario |
| 3 | Vacaciones | Programar en periodo vacacional | Invalida escenario |
| 4 | Feriado | Programar en día feriado | Invalida escenario |
| 5 | Suspensión | Programar en suspensión institucional | Invalida escenario |
| 6 | Exceder horas disponibles | Más horas de las disponibles en una sesión | Invalida escenario |
| 7 | Sesión fuera del horario | Hora de inicio/fin fuera del horario del grupo | Invalida escenario |
| 8 | Conflicto imposible | Dos actividades en la misma fecha/hora | Invalida escenario |

---

## 3. RESTRICCIONES BLANDAS

| # | Restricción | Descripción | Efecto |
|---|-------------|-------------|--------|
| 1 | Distribución poco uniforme | Muchas horas en pocas semanas | Reduce puntuación |
| 2 | Agrupación excesiva | Demasiados temas en pocas sesiones | Reduce puntuación |
| 3 | Espacios grandes entre actividades | Huecos grandes sin actividad | Reduce puntuación |
| 4 | Última semana muy cargada | Muchas horas en la última semana | Reduce puntuación |

---

## 4. TIPO DE SESIÓN

| Tipo | Descripción |
|------|-------------|
| TEORIA | Sesión de teoría |
| PRACTICA | Sesión de práctica |

**Regla semanal:** 3h teoría + 3h práctica

**Nota:** La distribución por día es libre. No se asume que un día específico sea teoría o práctica.

---

## 5. CARGA ACADÉMICA

### 5.1 Concepto

La carga académica representa las horas que deben cubrirse según las fuentes y decisiones del docente.

### 5.2 Cálculo

| Métrica | Cálculo |
|---------|---------|
| Horas requeridas | Suma de horas de temas/subtemas |
| Horas programadas | Suma de horas asignadas a sesiones |
| Horas restantes | Horas requeridas - Horas programadas |
| Avance acumulado | (Horas programadas / Horas requeridas) × 100 |

---

## 6. EVALUACIONES Y EVIDENCIAS

### 6.1 Reglas

| Regla | Descripción |
|-------|-------------|
| Las evaluaciones las define el docente | El sistema NO inventa evaluaciones |
| Las evidencias las define el docente | El sistema NO inventa evidencias |
| Las fechas deben ser días reales de clase | Validación obligatoria |
| Las fechas deben estar dentro del periodo | Validación obligatoria |
| Las fechas no deben estar bloqueadas | Validación obligatoria |

### 6.2 Propuestas del sistema

Cuando el docente no ha indicado una fecha:
- El sistema puede sugerir una fecha
- Debe marcarse como PROPUESTA
- El docente puede modificarla

---

## 7. ESCENARIOS

### 7.1 Escenario Uniforme

| Aspecto | Descripción |
|---------|-------------|
| Distribución | Equilibrada a lo largo del periodo |
| Horas por semana | Constantes |
| Uso | Propuesta estándar |

### 7.2 Escenario Compacto

| Aspecto | Descripción |
|---------|-------------|
| Distribución | Bloques concentrados |
| Horas por semana | Variables, más al inicio |
| Uso | Cuando se necesita terminar antes |

### 7.3 Escenario Extendido

| Aspecto | Descripción |
|---------|-------------|
| Distribución | Mayor separación temporal |
| Horas por semana | Variables, más espaciadas |
| Uso | Cuando se necesita más tiempo por tema |

---

## 8. PUNTUACIÓN DE ESCENARIOS

### 8.1 Criterios

| Criterio | Peso | Descripción |
|----------|------|-------------|
| Cobertura | 40% | Porcentaje de horas cubiertas |
| Uniformidad | 25% | Distribución equilibrada |
| Espaciado | 20% | Separación adecuada entre actividades |
| Flexibilidad | 15% | Capacidad de ajuste |

### 8.2 Fórmula

```
Puntuación = (Cobertura × 0.40) + (Uniformidad × 0.25) + (Espaciado × 0.20) + (Flexibilidad × 0.15)
```

---

## 9. CASOS EXTREMOS

| Caso | Descripción | Comportamiento esperado |
|------|-------------|-------------------------|
| Semana con feriado | Feriado en medio de la semana | Excluir fecha, ajustar sesiones |
| Semana con vacaciones | Semana completa de vacaciones | Excluir todas las fechas |
| Varias restricciones consecutivas | Múltiples bloqueos seguidos | Mover actividades a fechas válidas |
| Actividad cruza periodo bloqueado | Actividad que abarca feriado | Dividir o mover actividad |
| Última semana del periodo | Límite del periodo | Respetar fecha fin |
| Insuficiencia de horas | No hay suficientes horas | Generar advertencia |
| Actividad requiere más horas que sesión | Actividad grande | Dividir en varias sesiones |

---

## 10. FLUJO DEL MOTOR

```
ENTRADAS
├── Periodo
├── Grupo
├── Horario (de BD)
├── Calendario escolar (de BD)
├── Temario (de BD)
├── Planeación del docente
│   ├── Horas por tema
│   ├── Actividades
│   ├── Evaluaciones
│   └── Evidencias
│
PROCESO
├── A. Obtener disponibilidad real
├── B. Construir sesiones disponibles
├── C. Obtener carga académica
├── D. Obtener planeación docente
├── E. Aplicar restricciones
├── F. Construir propuesta base
├── G. Generar variantes (Uniforme, Compacto, Extendido)
├── H. Validar cada escenario
├── I. Puntuar cada escenario
└── J. Guardar escenarios válidos
│
SALIDAS
├── Escenarios generados
├── Puntuaciones
├── Conflictos detectados
└── Advertencias
```

---

> **NOTA IMPORTANTE:** Este documento define las reglas del motor de calendarización. No se debe implementar nada hasta revisar y aprobar este diseño.
