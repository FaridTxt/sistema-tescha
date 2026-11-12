# PLAN DE PROYECTO — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-09-27
> **Última actualización:** 2026-10-07
> **Estado:** Diseño definitivo completado
> **Programación definitiva:** NO iniciada

---

## 1. OBJETIVO DEL SISTEMA

Automatizar la generación de documentos académicos institucionales del TESCHA:

1. **Instrumentación Didáctica**
2. **Planeación / Avance Programático**

### Principios de diseño

| Principio | Descripción |
|-----------|-------------|
| **Mínima captura** | El profesor captura la menor cantidad posible de información |
| **Fuente única** | La información repetida se almacena una sola vez |
| **Consistencia** | Los dos documentos utilizan una fuente de información central |
| **No invención** | No se inventan reglas académicas ni fechas institucionales |
| **Prioridad documental** | Los documentos institucionales tienen prioridad sobre suposiciones |

---

## 2. ALCANCE

### 2.1 Caso inicial

| Dato | Valor |
|------|-------|
| Asignatura | Gestión de Proyectos de Software |
| Clave | SCG-1009 |
| Grupo | 4701 |
| Carrera | Ingeniería en Sistemas Computacionales |
| HT | 3 horas |
| HP | 3 horas |
| Créditos | 6 |
| Periodo | 2026-2 |
| Docente | Fabiola García Gutiérrez |

### 2.2 Horario oficial del grupo 4701

| Día | Horario | Horas |
|-----|---------|-------|
| Lunes | 12:00 - 14:00 | 2h |
| Martes | 11:00 - 12:00 | 1h |
| Miércoles | 11:00 - 12:00 | 1h |
| Jueves | 12:00 - 14:00 | 2h |
| Viernes | Sin clase | 0h |
| **Total** | | **6h** |

**Fuente oficial:** `docs/Horarios 2026-2 -Presencial.pdf`

---

## 3. DOCUMENTOS DE REFERENCIA

| Documento | Tipo | Uso |
|-----------|------|-----|
| `docs/SGI_G3_3.1_PLAN_Y_AV_PROGRA_2025.docx` | Formato oficial en blanco | AvancePro |
| `docs/SGI_G3_3.5_INSTRUMENTACIÓN_DIDÁCTICA_2025.docx` | Formato oficial en blanco | Instrumentación Didáctica |
| `docs/Instrumentación Didáctica GPS.docx` | Ejemplo lleno | Referencia |
| `docs/AvancePro GPS 4701.docx` | Ejemplo lleno | Referencia |
| `docs/CALENDARIO27.pdf` | Calendario escolar | Fuente de fechas |
| `docs/Gestión de Proyectos de Software.pdf` | Temario oficial | Fuente de contenido |
| `docs/Horarios 2026-2 -Presencial.pdf` | Horario oficial | Fuente de horario |

---

## 4. DISEÑO DEFINITIVO

### 4.1 Documentos de diseño

| Documento | Descripción |
|-----------|-------------|
| `docs/ARQUITECTURA_DEFINITIVA.md` | Modelo de dominio, flujo completo, reglas de consistencia |
| `docs/REGLAS_CALENDARIZACION.md` | Reglas de calendarización, generación de escenarios, validaciones |
| `docs/MODELO_DATOS_DEFINITIVO.md` | Tablas definitivas, relaciones Eloquent, servicios |
| `docs/MATRIZ_AUTOMATIZACION.md` | Matriz campo por campo |

### 4.2 Principios fundamentales

1. **Una sola calendarización central** alimenta ambos documentos
2. **El sistema propone, el docente decide**
3. **No se inventan reglas académicas**
4. **Los documentos oficiales tienen prioridad**

---

## 5. PLAN DE IMPLEMENTACIÓN POR FASES

### Fase A: Modelo de datos
- [ ] Diseñar tablas definitivas
- [ ] Definir relaciones
- [ ] Crear diagrama ER

### Fase B: Migraciones
- [ ] Crear migraciones
- [ ] Ejecutar migraciones
- [ ] Verificar estructura

### Fase C: Modelos/Relaciones
- [ ] Crear modelos Eloquent
- [ ] Definir relaciones
- [ ] Probar relaciones

### Fase D: Carga de fuentes oficiales
- [ ] Implementar lectura de PDFs
- [ ] Implementar lectura de JSONs
- [ ] Probar carga de datos

### Fase E: Motor de calendarización
- [ ] Implementar construcción de calendarización base
- [ ] Implementar restricciones
- [ ] Probar calendarización

### Fase F: Escenarios
- [ ] Implementar generación de escenarios
- [ ] Implementar comparación
- [ ] Probar escenarios

### Fase G: Interfaz de revisión
- [ ] Crear vistas de revisión
- [ ] Implementar modificación
- [ ] Probar flujo completo

### Fase H: Generación de documentos
- [ ] Implementar generación de Instrumentación
- [ ] Implementar generación de AvancePro
- [ ] Probar generación

### Fase I: Validación final
- [ ] Implementar validaciones
- [ ] Probar consistencia
- [ ] Verificar documentos

### Fase J: Limpieza del código provisional
- [ ] Eliminar código provisional
- [ ] Refactorizar servicios
- [ ] Documentar código final

---

## 6. ESTADO ACTUAL

| Aspecto | Estado |
|---------|--------|
| **Entorno de desarrollo** | ✅ Terminado |
| **Documentación de análisis** | ✅ Completa |
| **Diseño definitivo** | ✅ Completado |
| **Fase A — Modelo de datos** | ✅ Completada (16 tablas, 16 modelos, 18 relaciones) |
| **Fase B — Carga de fuentes** | ✅ Completada (55 registros cargados) |
| **Fase C — Motor de calendarización** | ✅ Cerrada (73/73 pruebas) |
| **Servicios provisionales** | ⚠️ Existentes (no definitivos) |
| **Generación de documentos** | ❌ No implementado |
| **Preguntas académicas pendientes** | 0 |

---

## 7. HISTORIAL DE CAMBIOS

| Fecha | Descripción |
|-------|-------------|
| 2026-09-27 | Creación inicial del plan |
| 2026-10-07 | Actualización con diseño definitivo completado |

---

> **NOTA IMPORTANTE:** El diseño definitivo está completado. No se debe programar nada hasta revisar y aprobar el diseño.
