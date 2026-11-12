# MODELO DE DATOS DEFINITIVO — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-10-07
> **Estado:** Diseño definitivo (no implementado)
> **Principio central:** UNA SOLA CALENDARIZACIÓN CENTRAL

---

## 1. DIAGRAMA ER

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│    docentes     │     │   asignaturas   │     │     grupos      │
├─────────────────┤     ├─────────────────┤     ├─────────────────┤
│ id              │     │ id              │     │ id              │
│ nombre          │     │ nombre          │     │ nombre          │
│ email           │     │ clave           │     │ asignatura_id    │
│ ...             │     │ ht              │     │ periodo_id      │
└─────────────────┘     │ hp              │     └─────────────────┘
                        │ creditos        │              │
                        │ objetivo        │              │
                        └─────────────────┘              │
                                 │                       │
                                 │                       │
                                 ▼                       ▼
                        ┌─────────────────┐     ┌─────────────────┐
                        │    unidades     │     │    horarios     │
                        ├─────────────────┤     ├─────────────────┤
                        │ id              │     │ id              │
                        │ asignatura_id   │     │ grupo_id        │
                        │ numero          │     │ dia             │
                        │ nombre          │     │ hora_inicio     │
                        │ horas_teoria    │     │ hora_fin        │
                        │ horas_practica  │     │ duracion_horas  │
                        └─────────────────┘     └─────────────────┘
                                 │
                                 │
                                 ▼
                        ┌─────────────────┐     ┌─────────────────┐
                        │  competencias   │     │     temas      │
                        ├─────────────────┤     ├─────────────────┤
                        │ id              │     │ id              │
                        │ unidad_id       │     │ unidad_id       │
                        │ numero          │     │ numero          │
                        │ descripcion     │     │ nombre          │
                        │ horas_teoria    │     │ padre_id        │
                        │ horas_practica  │     └─────────────────┘
                        └─────────────────┘              │
                                 │                       │
                                 ▼                       ▼
                        ┌─────────────────┐     ┌─────────────────┐
                        │   evidencias    │     │   actividades   │
                        ├─────────────────┤     ├─────────────────┤
                        │ id              │     │ id              │
                        │ competencia_id  │     │ tema_id         │
                        │ nombre          │     │ tipo            │
                        │ porcentaje      │     │ descripcion     │
                        │ indicador       │     └─────────────────┘
                        └─────────────────┘
                                 │
                                 ▼
                        ┌─────────────────┐     ┌─────────────────┐
                        │  evaluaciones   │     │   periodos      │
                        ├─────────────────┤     ├─────────────────┤
                        │ id              │     │ id              │
                        │ evidencia_id    │     │ nombre          │
                        │ fecha           │     │ fecha_inicio    │
                        │ tipo            │     │ fecha_fin       │
                        └─────────────────┘     │ semanas         │
                                                └─────────────────┘
                                                         │
                                                         ▼
                                                ┌─────────────────┐
                                                │calendarios_esc. │
                                                ├─────────────────┤
                                                │ id              │
                                                │ nombre          │
                                                │ fecha_inicio    │
                                                │ fecha_fin       │
                                                │ feriados        │
                                                │ vacaciones      │
                                                └─────────────────┘
                                                         │
                                                         ▼
                                                ┌─────────────────┐
                                                │ calendarizaciones│
                                                ├─────────────────┤
                                                │ id              │
                                                │ periodo_id      │
                                                │ grupo_id        │
                                                │ estado          │
                                                │ fecha_creacion  │
                                                └─────────────────┘
                                                         │
                                                         ▼
                                                ┌─────────────────┐
                                                │   escenarios     │
                                                ├─────────────────┤
                                                │ id              │
                                                │ calendarizacion_id│
                                                │ nombre          │
                                                │ descripcion     │
                                                │ estado          │
                                                └─────────────────┘
                                                         │
                                                         ▼
                                                ┌─────────────────┐
                                                │documentos_gener. │
                                                ├─────────────────┤
                                                │ id              │
                                                │ escenario_id    │
                                                │ tipo            │
                                                │ contenido       │
                                                │ fecha_generacion│
                                                └─────────────────┘
```

---

## 2. TABLAS DEFINITIVAS

### 2.1 Tabla: `docentes`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| nombre | string | Nombre completo del docente |
| email | string | Correo institucional |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.2 Tabla: `asignaturas`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| nombre | string | Nombre de la asignatura |
| clave | string | Clave de la asignatura |
| ht | int | Horas teóricas |
| hp | int | Horas prácticas |
| creditos | int | Créditos |
| objetivo | text | Objetivo de la materia |
| carrera | string | Carrera a la que pertenece (ej: "Ingeniería en Sistemas Computacionales") |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Nota:** `carrera` es un campo de texto, no una entidad separada.

### 2.3 Tabla: `grupos`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| nombre | string | Nombre del grupo (ej: 4701) |
| asignatura_id | bigint FK | Asignatura asignada |
| periodo_id | bigint FK | Periodo escolar |
| docente_id | bigint FK | Docente asignado |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.4 Tabla: `horarios`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| grupo_id | bigint FK | Grupo al que pertenece |
| dia | string | Día de la semana (lunes, martes, etc.) |
| hora_inicio | time | Hora de inicio |
| hora_fin | time | Hora de fin |
| duracion_horas | int | Duración en horas |
| salon | string | Salón de clases |
| edificio | string | Edificio |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.5 Tabla: `periodos`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| nombre | string | Nombre del periodo (ej: 2026-2) |
| fecha_inicio | date | Fecha de inicio |
| fecha_fin | date | Fecha de fin |
| semanas | int | Número de semanas efectivas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.6 Tabla: `calendarios_escolares`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| nombre | string | Nombre del calendario |
| fecha_inicio | date | Fecha de inicio |
| fecha_fin | date | Fecha de fin |
| feriados | json | Lista de feriados |
| vacaciones | json | Lista de periodos vacacionales |
| suspensiones | json | Lista de suspensiones |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.7 Tabla: `unidades`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| asignatura_id | bigint FK | Asignatura a la que pertenece |
| numero | int | Número de unidad |
| nombre | string | Nombre de la unidad |
| horas_teoria | int | Horas teóricas |
| horas_practica | int | Horas prácticas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.8 Tabla: `competencias`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| unidad_id | bigint FK | Unidad a la que pertenece |
| numero | int | Número de competencia |
| descripcion | text | Descripción de la competencia |
| horas_teoria | int | Horas teóricas |
| horas_practica | int | Horas prácticas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.9 Tabla: `temas`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| unidad_id | bigint FK | Unidad a la que pertenece |
| numero | string | Número del tema (ej: 1.1, 1.2.1) |
| nombre | string | Nombre del tema |
| padre_id | bigint FK | Tema padre (para subtemas) |
| orden | int | Orden de presentación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.10 Tabla: `actividades`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| tema_id | bigint FK | Tema al que pertenece |
| tipo | string | Tipo (aprendizaje/enseñanza) |
| descripcion | text | Descripción de la actividad |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.11 Tabla: `evidencias`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| competencia_id | bigint FK | Competencia a la que pertenece |
| nombre | string | Nombre de la evidencia |
| porcentaje | decimal | Porcentaje de evaluación |
| indicador | string | Indicador de alcance |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.12 Tabla: `evaluaciones`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| evidencia_id | bigint FK | Evidencia a la que pertenece |
| fecha | date | Fecha de evaluación |
| tipo | string | Tipo de evaluación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.13 Tabla: `calendarizaciones`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| periodo_id | bigint FK | Periodo escolar |
| grupo_id | bigint FK | Grupo |
| estado | string | Estado (borrador, propuesta, aceptada) |
| fecha_creacion | timestamp | Fecha de creación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.14 Tabla: `escenarios`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| calendarizacion_id | bigint FK | Calendarización a la que pertenece |
| nombre | string | Nombre del escenario |
| descripcion | text | Descripción del escenario |
| estado | string | Estado (propuesta, seleccionado, descartado) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.15 Tabla: `documentos_generados`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| escenario_id | bigint FK | Escenario al que pertenece |
| tipo | string | Tipo (instrumentacion, avancepro) |
| contenido | json | Contenido del documento |
| fecha_generacion | timestamp | Fecha de generación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### 2.16 Tabla: `versiones`

| Columna | Tipo | Descripción |
|---------|------|-------------|
| id | bigint PK | Identificador único |
| calendarizacion_id | bigint FK | Calendarización a la que pertenece |
| version | int | Número de versión |
| cambios | json | Descripción de cambios |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

## 3. RELACIONES ELOQUENT

### 3.1 Modelo: Asignatura

```php
class Asignatura extends Model
{
    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }

    public function unidades()
    {
        return $this->hasMany(Unidad::class);
    }
}
```

### 3.2 Modelo: Grupo

```php
class Grupo extends Model
{
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function horario()
    {
        return $this->hasOne(Horario::class);
    }
}
```

### 3.3 Modelo: Unidad

```php
class Unidad extends Model
{
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function competencias()
    {
        return $this->hasMany(Competencia::class);
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }
}
```

### 3.4 Modelo: Calendarización

```php
class Calendarización extends Model
{
    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function escenarios()
    {
        return $this->hasMany(Escenario::class);
    }

    public function versiones()
    {
        return $this->hasMany(Versión::class);
    }
}
```

---

## 4. SERVICIOS

| Servicio | Responsabilidad |
|----------|-----------------|
| `CalendarioService` | Leer y consultar el calendario escolar |
| `TemarioService` | Leer y extraer datos del temario |
| `HorarioService` | Leer y extraer datos del horario |
| `CalendarizaciónService` | Construir la calendarización central |
| `EscenarioService` | Generar escenarios de calendarización |
| `ValidacionService` | Validar restricciones y consistencia |
| `DocumentoService` | Generar documentos (Instrumentación + AvancePro) |

---

## 5. CONTROLADORES

| Controlador | Responsabilidad |
|-------------|-----------------|
| `PlaneacionController` | Captura de datos y revisión |
| `EscenarioController` | Generación y comparación de escenarios |
| `DocumentoController` | Generación de documentos |

---

## 6. VALIDADORES

| Validador | Responsabilidad |
|-----------|-----------------|
| `CalendarioValidador` | Validar fechas y restricciones |
| `HorarioValidador` | Validar horario del grupo |
| `ConsistenciaValidador` | Validar consistencia entre documentos |

---

> **NOTA IMPORTANTE:** Este documento define el modelo de datos definitivo. No se debe implementar nada hasta revisar y aprobar este diseño.
