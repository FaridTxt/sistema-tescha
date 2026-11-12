# RESULTADO DE CARGA — FASE B

> **Fecha de generación:** 2026-10-08
> **Estado:** ✅ COMPLETADA
> **Pruebas:** 55/55 pasando

---

## 1. REGISTROS CREADOS POR TABLA

| Tabla | Registros | Fuente |
|-------|-----------|--------|
| `docentes` | 1 | Horarios PDF |
| `asignaturas` | 1 | Horarios PDF + Temario |
| `grupos` | 1 | Horarios PDF |
| `horarios` | 4 | Horarios PDF |
| `periodos` | 1 | Calendario JSON |
| `calendarios_escolares` | 1 | Calendario JSON |
| `unidades` | 5 | Temario PDF |
| `competencias` | 5 | Temario PDF |
| `temas` | 37 | Temario PDF |
| `actividades` | 0 | No se cargan (decisiones del docente) |
| `evidencias` | 0 | No se cargan (decisiones del docente) |
| `evaluaciones` | 0 | No se cargan (decisiones del docente) |
| `calendarizaciones` | 0 | No se cargan (se crean en Fase C) |
| `escenarios` | 0 | No se cargan (se crean en Fase C) |
| `documentos_generados` | 0 | No se cargan (se crean en Fase D) |
| `versiones` | 0 | No se cargan (se crean en Fase C) |

**Total de registros cargados:** 55

---

## 2. FUENTE DE CADA GRUPO DE DATOS

| Datos | Fuente oficial |
|-------|----------------|
| Docente | `docs/Horarios 2026-2 -Presencial.pdf` |
| Asignatura | `docs/Horarios 2026-2 -Presencial.pdf` + `docs/Gestión de Proyectos de Software.pdf` |
| Grupo | `docs/Horarios 2026-2 -Presencial.pdf` |
| Horario | `docs/Horarios 2026-2 -Presencial.pdf` |
| Periodo | `docs/calendario_TESCHA_2026_2027.json` |
| Calendario escolar | `docs/calendario_TESCHA_2026_2027.json` |
| Unidades | `docs/Gestión de Proyectos de Software.pdf` |
| Competencias | `docs/Gestión de Proyectos de Software.pdf` |
| Temas/Subtemas | `docs/Gestión de Proyectos de Software.pdf` |

---

## 3. VALIDACIONES REALIZADAS

| Validación | Resultado |
|------------|-----------|
| Existe periodo 2026-2 | ✅ |
| Existe docente | ✅ |
| Existe asignatura | ✅ |
| Existe grupo 4701 | ✅ |
| Grupo y asignatura relacionados | ✅ |
| Existen exactamente 4 días de clase | ✅ |
| Las horas suman 6 por semana | ✅ |
| Viernes no aparece como clase | ✅ |
| Existen 5 unidades | ✅ |
| Existen 5 competencias | ✅ |
| Existen 37 temas/subtemas | ✅ |
| Las horas de unidades coinciden con la fuente | ✅ |
| El calendario tiene restricciones cargadas | ✅ |
| No existen duplicados al ejecutar seeders varias veces | ✅ |

---

## 4. PRUEBAS

### 4.1 Pruebas de carga (CargaFaseBTest)

```bash
php artisan test tests/Unit/Database/CargaFaseBTest.php
```

**Resultado:** ✅ 20/20 pasando

### 4.2 Suite completa

```bash
php artisan test
```

**Resultado:** ✅ 55/55 pasando

---

## 5. ERRORES ENCONTRADOS Y CORREGIDOS

| Error | Causa | Corrección |
|-------|-------|------------|
| `email` no permite NULL | Migración tenía `email` como NOT NULL | Se cambió a `nullable()` |
| Formato de hora en pruebas | `hora_inicio` es string, no Carbon | Se usó `substr()` para extraer `H:i` |

---

## 6. DATOS QUE QUEDARON PENDIENTES

| Dato | Motivo |
|------|--------|
| Actividades | Son decisiones del docente, no están en las fuentes oficiales |
| Evidencias | Son decisiones del docente, no están en las fuentes oficiales |
| Evaluaciones | Son decisiones del docente, no están en las fuentes oficiales |
| Calendarizaciones | Se crean en Fase C |
| Escenarios | Se crean en Fase C |
| Documentos generados | Se crean en Fase D |
| Versiones | Se crean en Fase C |

---

## 7. AMBIGÜEDADES ENCONTRADAS

**Ninguna.** Todos los datos cargados tienen una fuente oficial clara.

---

## 8. CONFIRMACIONES

| Confirmación | Estado |
|--------------|--------|
| El horario suma 6h | ✅ Sí (2+1+1+2) |
| El calendario quedó cargado | ✅ Sí |
| El temario quedó cargado | ✅ Sí (5 unidades, 5 competencias, 37 temas) |
| Los seeders son reproducibles | ✅ Sí (usan `updateOrCreate`) |
| La BD de testing está aislada | ✅ Sí |

---

## 9. ARCHIVOS CREADOS/MODIFICADOS

| Archivo | Tipo |
|---------|------|
| `docs/MAPEO_FUENTES_FASE_B.md` | Creado |
| `docs/MAPEO_FUENTES_A_BD.md` | Creado |
| `docs/RESULTADO_CARGA_FASE_B.md` | Creado |
| `database/seeders/FaseB/DatosOficialesSeeder.php` | Creado |
| `database/seeders/FaseB/TemarioSeeder.php` | Creado |
| `tests/Unit/Database/CargaFaseBTest.php` | Creado |
| `database/migrations/2026_10_07_000001_create_docentes_table.php` | Modificado (email nullable) |

---

## 10. CONCLUSIÓN

✅ **Fase B completada exitosamente.**

- 55 registros cargados desde fuentes oficiales
- 55/55 pruebas pasando
- Seeders reproducibles y seguros
- Sin ambigüedas
- Datos trazables a fuentes oficiales

---

> **NOTA IMPORTANTE:** Fase B está cerrada. No se continúa con Fase C hasta nueva instrucción.
