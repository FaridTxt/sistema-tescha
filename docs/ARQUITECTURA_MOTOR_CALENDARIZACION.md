# ARQUITECTURA DEL MOTOR DE CALENDARIZACIÓN — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-08
> **Estado:** Diseño definitivo (no implementado)
> **Principio central:** El sistema propone, el docente decide

---

## 1. MODELO DE CALENDARIZACIÓN

### 1.1 Concepto

Una **Calendarización** es la fuente única de fechas para ambos documentos (Instrumentación y AvancePro).

### 1.2 Estructura

```
Calendarización
├── periodo_id
├── grupo_id
├── estado (borrador, propuesta, aceptada)
└── escenarios
    └── Escenario
        ├── nombre (Uniforme, Compacto, Extendido)
        ├── descripción
        ├── estado (propuesta, seleccionado, descartado)
        └── sesiones
            └── Sesión
                ├── fecha
                ├── dia
                ├── hora_inicio
                ├── hora_fin
                ├── duracion_horas
                ├── tipo (TEORIA, PRACTICA)
                ├── tema_id
                └── actividad_id
```

### 1.3 Entidad "Sesión"

**Decisión arquitectónica:** Se requiere una entidad explícita para "Sesión" porque:

1. Permite validar sesiones individualmente
2. Permite consultar y modificar sesiones específicas
3. Permite detectar conflictos por sesión
4. Permite versionar cambios por sesión

**Implementación:** Las sesiones se almacenan como registros en la tabla `escenarios` con un campo JSON `sesiones` que contiene la estructura completa. Esto evita crear una tabla adicional mientras permite validar y consultar sesiones individualmente.

---

## 2. SERVICIOS

### 2.1 DisponibilidadService

**Responsabilidad:** Obtener las sesiones reales disponibles entre dos fechas.

**Métodos:**

| Método | Descripción |
|--------|-------------|
| `obtenerSesionesDisponibles(Periodo $periodo, Grupo $grupo): array` | Retorna lista de sesiones disponibles |

**Lógica:**

1. Obtener días laborables del periodo
2. Cruzar con horario del grupo
3. Excluir feriados, vacaciones, suspensiones
4. Retornar sesiones válidas

### 2.2 CalendarizacionService

**Responsabilidad:** Construir la calendarización base.

**Métodos:**

| Método | Descripción |
|--------|-------------|
| `construirBase(Periodo $periodo, Grupo $grupo): Calendarizacion` | Crea una calendarización base |

### 2.3 EscenarioService

**Responsabilidad:** Generar escenarios de calendarización.

**Métodos:**

| Método | Descripción |
|--------|-------------|
| `generarUniforme(Calendarizacion $cal): Escenario` | Distribución equilibrada |
| `generarCompacto(Calendarizacion $cal): Escenario` | Bloques concentrados |
| `generarExtendido(Calendarizacion $cal): Escenario` | Mayor separación temporal |

### 2.4 ValidacionCalendarizacionService

**Responsabilidad:** Validar restricciones y consistencia.

**Métodos:**

| Método | Descripción |
|--------|-------------|
| `validar(Escenario $esc): array` | Retorna lista de errores y advertencias |
| `puntuar(Escenario $esc): int` | Retorna puntuación del escenario |

---

## 3. ALGORITMO

### 3.1 Etapas

```
A. Obtener disponibilidad real
   ↓
B. Construir sesiones disponibles
   ↓
C. Obtener carga académica
   ↓
D. Obtener planeación docente
   ↓
E. Aplicar restricciones
   ↓
F. Construir propuesta base
   ↓
G. Generar variantes
   ↓
H. Validar cada escenario
   ↓
I. Puntuar cada escenario
   ↓
J. Guardar escenarios válidos
```

### 3.2 Restricciones duras vs blandas

| Tipo | Descripción | Efecto |
|------|-------------|--------|
| **Dura** | Fecha fuera del periodo | Invalida escenario |
| **Dura** | Día sin clase | Invalida escenario |
| **Dura** | Vacaciones/feriado/suspensión | Invalida escenario |
| **Dura** | Exceder horas disponibles | Invalida escenario |
| **Dura** | Sesión fuera del horario | Invalida escenario |
| **Blanda** | Distribución poco uniforme | Reduce puntuación |
| **Blanda** | Agrupación excesiva | Reduce puntuación |
| **Blanda** | Espacios grandes entre actividades | Reduce puntuación |

---

## 4. ESCENARIOS

### 4.1 Escenario Uniforme

- Distribución equilibrada de actividades
- Misma cantidad de horas por semana
- Propuesta estándar

### 4.2 Escenario Compacto

- Más actividades por sesión
- Menos sesiones necesarias
- Prioriza completar antes

### 4.3 Escenario Extendido

- Menos actividades por sesión
- Más sesiones necesarias
- Mayor separación temporal

---

## 5. PERSISTENCIA

### 5.1 Tabla `escenarios`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint PK | Identificador |
| calendarizacion_id | bigint FK | Calendarización padre |
| nombre | string | Nombre del escenario |
| descripcion | text | Descripción |
| estado | string | propuesta, seleccionado, descartado |
| sesiones | json | Lista de sesiones programadas |
| puntuacion | int | Puntuación del escenario |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 5.2 Tabla `versiones`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint PK | Identificador |
| calendarizacion_id | bigint FK | Calendarización padre |
| version | int | Número de versión |
| cambios | json | Descripción de cambios |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

## 6. PRUEBAS

### 6.1 Pruebas unitarias

| Prueba | Descripción |
|--------|-------------|
| `test_calculo_horas_horario` | Cálculo de horas de un horario |
| `test_generacion_sesiones` | Generación de sesiones a partir de horario |
| `test_exclusion_vacaciones` | Exclusión de vacaciones |
| `test_exclusion_feriados` | Exclusión de feriados |
| `test_exclusion_suspensiones` | Exclusión de suspensiones |
| `test_exclusion_viernes` | Exclusión de viernes para 4701 |
| `test_respeto_horarios_reales` | Respeto de horarios reales |
| `test_acumulacion_horas` | Acumulación correcta de horas |
| `test_separacion_teoria_practica` | Separación teoría/práctica |
| `test_deteccion_sobrecarga` | Detección de sobrecarga |
| `test_deteccion_fechas_invalidas` | Detección de fechas inválidas |
| `test_evaluacion_fecha_no_disponible` | Evaluación en fecha no disponible |
| `test_generacion_escenario_uniforme` | Generación de escenario uniforme |
| `test_generacion_escenario_compacto` | Generación de escenario compacto |
| `test_generacion_escenario_extendido` | Generación de escenario extendido |
| `test_validacion_escenario` | Validación de escenario |
| `test_comparacion_escenarios` | Comparación/puntuación de escenarios |

### 6.2 Pruebas de integración

| Prueba | Descripción |
|--------|-------------|
| `test_caso_real_4701` | Integración real para el caso 4701 |

---

## 7. CASOS EXTREMOS

| Caso | Descripción |
|------|-------------|
| Semana con feriado | Verificar exclusión correcta |
| Semana con vacaciones | Verificar exclusión correcta |
| Varias restricciones consecutivas | Verificar manejo correcto |
| Actividad que cruza periodo bloqueado | Verificar ajuste |
| Última semana del periodo | Verificar límite |
| Insuficiencia de horas | Verificar advertencia |
| Actividad requiere más horas que sesión | Verificar división |

---

> **NOTA IMPORTANTE:** Este documento es el diseño del motor de calendarización. No se debe implementar nada hasta revisar y aprobar este diseño.
