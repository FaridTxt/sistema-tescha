# DIAGRAMA ER — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Estado:** Diseño definitivo (implementado)
> **Total de tablas:** 16

---

## 1. DIAGRAMA DE RELACIONES

```
┌─────────────────┐
│    docentes     │
├─────────────────┤
│ id (PK)         │
│ nombre          │
│ email (UQ)      │
│ created_at      │
│ updated_at      │
└────────┬────────┘
         │ 1
         │
         │ N
┌────────┴────────┐     ┌─────────────────┐
│     grupos      │     │   periodos      │
├─────────────────┤     ├─────────────────┤
│ id (PK)         │     │ id (PK)         │
│ nombre (UQ)     │     │ nombre (UQ)     │
│ asignatura_id   │─────┤ fecha_inicio    │
│ periodo_id (FK) │─────┤ fecha_fin       │
│ docente_id (FK) │     │ semanas         │
│ created_at      │     │ created_at      │
│ updated_at      │     │ updated_at      │
└────────┬────────┘     └────────┬────────┘
         │ 1                     │ 1
         │                       │
         │ N                     │ N
┌────────┴────────┐     ┌────────┴────────┐
│    horarios     │     │ calendarizaciones│
├─────────────────┤     ├─────────────────┤
│ id (PK)         │     │ id (PK)         │
│ grupo_id (FK)   │     │ periodo_id (FK) │
│ dia             │     │ grupo_id (FK)   │
│ hora_inicio     │     │ estado          │
│ hora_fin        │     │ fecha_creacion  │
│ duracion_horas  │     │ created_at      │
│ salon           │     │ updated_at      │
│ edificio        │     └────────┬────────┘
│ created_at      │              │ 1
│ updated_at      │              │
│ UQ(grupo_id,dia)│              │ N
└─────────────────┘     ┌────────┴────────┐
                        │   escenarios    │
                        ├─────────────────┤
                        │ id (PK)         │
                        │ calendarizacion_id (FK) │
                        │ nombre          │
                        │ descripcion     │
                        │ estado          │
                        │ created_at      │
                        │ updated_at      │
                        └────────┬────────┘
                                 │ 1
                                 │
                                 │ N
                        ┌────────┴────────┐
                        │documentos_generados│
                        ├─────────────────┤
                        │ id (PK)         │
                        │ escenario_id (FK) │
                        │ tipo            │
                        │ contenido       │
                        │ fecha_generacion│
                        │ created_at      │
                        │ updated_at      │
                        └─────────────────┘

┌─────────────────┐     ┌─────────────────┐
│   asignaturas   │     │calendarios_esc. │
├─────────────────┤     ├─────────────────┤
│ id (PK)         │     │ id (PK)         │
│ nombre          │     │ nombre          │
│ clave (UQ)      │     │ fecha_inicio    │
│ ht              │     │ fecha_fin       │
│ hp              │     │ feriados        │
│ creditos        │     │ vacaciones      │
│ objetivo        │     │ suspensiones    │
│ carrera         │     │ created_at      │
│ created_at      │     │ updated_at      │
│ updated_at      │     └─────────────────┘
└────────┬────────┘
         │ 1
         │
         │ N
┌────────┴────────┐
│    unidades     │
├─────────────────┤
│ id (PK)         │
│ asignatura_id (FK) │
│ numero          │
│ nombre          │
│ horas_teoria    │
│ horas_practica  │
│ created_at      │
│ updated_at      │
│ UQ(asignatura_id,numero) │
└────────┬────────┘
         │ 1
         │
    ┌────┴────┐
    │         │
    │ N       │ N
┌───┴───┐ ┌───┴────────┐
│temas  │ │competencias│
├───────┤ ├────────────┤
│id(PK) │ │id (PK)     │
│unidad_id(FK) │unidad_id(FK) │
│numero │ │numero      │
│nombre │ │descripcion │
│padre_id(FK) │horas_teoria │
│orden  │ │horas_practica │
│created_at │ │created_at  │
│updated_at │ │updated_at  │
│UQ(unidad_id,numero) │ └─────┬──────┘
└───┬───┘       │ 1
    │ 1         │
    │           │ N
    │ N    ┌────┴────┐
┌───┴───┐ │evidencias│
│actividades │ ├─────────┤
├───────┤ │id (PK)   │
│id(PK) │ │competencia_id(FK) │
│tema_id(FK) │nombre   │
│tipo   │ │porcentaje│
│descripcion │ │indicador│
│created_at │ │created_at │
│updated_at │ │updated_at │
└───────┘ └────┬────┘
               │ 1
               │
               │ N
          ┌────┴────┐
          │evaluaciones│
          ├─────────┤
          │id (PK)  │
          │evidencia_id(FK) │
          │fecha    │
          │tipo     │
          │created_at │
          │updated_at │
          └─────────┘

┌─────────────────┐
│    versiones    │
├─────────────────┤
│ id (PK)         │
│ calendarizacion_id (FK) │
│ version         │
│ cambios         │
│ created_at      │
│ updated_at      │
└─────────────────┘
```

---

## 2. CARDINALIDADES

| Relación | Cardinalidad | Descripción |
|----------|--------------|-------------|
| Docente → Grupo | 1:N | Un docente tiene varios grupos |
| Asignatura → Grupo | 1:N | Una asignatura tiene varios grupos |
| Periodo → Grupo | 1:N | Un periodo tiene varios grupos |
| Grupo → Horario | 1:1 | Un grupo tiene un horario |
| Grupo → Calendarización | 1:N | Un grupo tiene varias calendarizaciones |
| Periodo → Calendarización | 1:N | Un periodo tiene varias calendarizaciones |
| Calendarización → Escenario | 1:N | Una calendarización tiene varios escenarios |
| Calendarización → Versión | 1:N | Una calendarización tiene varias versiones |
| Escenario → DocumentoGenerado | 1:N | Un escenario tiene varios documentos |
| Asignatura → Unidad | 1:N | Una asignatura tiene varias unidades |
| Unidad → Competencia | 1:N | Una unidad tiene varias competencias |
| Unidad → Tema | 1:N | Una unidad tiene varios temas |
| Tema → Tema (padre) | 1:N | Un tema tiene varios subtemas |
| Tema → Actividad | 1:N | Un tema tiene varias actividades |
| Competencia → Evidencia | 1:N | Una competencia tiene varias evidencias |
| Evidencia → Evaluación | 1:N | Una evidencia tiene varias evaluaciones |

---

## 3. RESTRICCIONES

| Tabla | Restricción | Descripción |
|-------|-------------|-------------|
| `docentes` | UQ(email) | Email único |
| `asignaturas` | UQ(clave) | Clave única |
| `grupos` | UQ(nombre) | Nombre único |
| `horarios` | UQ(grupo_id, dia) | Un horario por día por grupo |
| `periodos` | UQ(nombre) | Nombre único |
| `unidades` | UQ(asignatura_id, numero) | Número único por asignatura |
| `temas` | UQ(unidad_id, numero) | Número único por unidad |

---

## 4. REGLAS DE ELIMINACIÓN

| Tabla | Regla | Descripción |
|-------|-------|-------------|
| `grupos` | CASCADE | Si se elimina asignatura/periodo/docente, se eliminan grupos |
| `horarios` | CASCADE | Si se elimina grupo, se elimina horario |
| `calendarizaciones` | CASCADE | Si se elimina periodo/grupo, se eliminan calendarizaciones |
| `escenarios` | CASCADE | Si se elimina calendarización, se eliminan escenarios |
| `documentos_generados` | CASCADE | Si se elimina escenario, se eliminan documentos |
| `versiones` | CASCADE | Si se elimina calendarización, se eliminan versiones |
| `unidades` | CASCADE | Si se elimina asignatura, se eliminan unidades |
| `competencias` | CASCADE | Si se elimina unidad, se eliminan competencias |
| `temas` | CASCADE | Si se elimina unidad, se eliminan temas |
| `actividades` | CASCADE | Si se elimina tema, se eliminan actividades |
| `evidencias` | CASCADE | Si se elimina competencia, se eliminan evidencias |
| `evaluaciones` | CASCADE | Si se elimina evidencia, se eliminan evaluaciones |

---

## 5. RELACIÓN CON MODELO_DATOS_DEFINITIVO.md

Este diagrama coincide exactamente con `docs/MODELO_DATOS_DEFINITIVO.md`.

| Tabla en documento | Tabla en diagrama | ¿Coincide? |
|--------------------|--------------------|------------|
| `docentes` | `docentes` | ✅ |
| `asignaturas` | `asignaturas` | ✅ |
| `grupos` | `grupos` | ✅ |
| `horarios` | `horarios` | ✅ |
| `periodos` | `periodos` | ✅ |
| `calendarios_escolares` | `calendarios_escolares` | ✅ |
| `unidades` | `unidades` | ✅ |
| `competencias` | `competencias` | ✅ |
| `temas` | `temas` | ✅ |
| `actividades` | `actividades` | ✅ |
| `evidencias` | `evidencias` | ✅ |
| `evaluaciones` | `evaluaciones` | ✅ |
| `calendarizaciones` | `calendarizaciones` | ✅ |
| `escenarios` | `escenarios` | ✅ |
| `documentos_generados` | `documentos_generados` | ✅ |
| `versiones` | `versiones` | ✅ |

---

> **NOTA IMPORTANTE:** Este diagrama es la referencia visual del modelo de datos definitivo. Cualquier cambio debe reflejarse tanto aquí como en `docs/MODELO_DATOS_DEFINITIVO.md`.
