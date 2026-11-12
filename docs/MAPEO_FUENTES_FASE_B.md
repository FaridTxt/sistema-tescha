# MAPEO DE FUENTES — FASE B

> **Fecha de generación:** 2026-10-08
> **Propósito:** Analizar las fuentes oficiales antes de importar datos

---

## 1. FUENTES OFICIALES

### 1.1 Horarios 2026-2 -Presencial.pdf

| Aspecto | Detalle |
|---------|---------|
| **Archivo** | `docs/Horarios 2026-2 -Presencial.pdf` |
| **Tipo** | PDF oficial |
| **Propósito** | Fuente oficial del horario del grupo 4701 |
| **Datos que contiene** | Grupo, materia, docente, días, horas, salón, edificio |
| **Tablas que reciben datos** | `grupos`, `horarios`, `docentes`, `asignaturas` |
| **Datos que NO deben importarse** | Horarios de otros grupos (solo 4701) |
| **Ambigüedades** | Ninguna para el grupo 4701 |
| **Tipo de fuente** | Oficial |

### 1.2 Calendario escolar 2026-2027

| Aspecto | Detalle |
|---------|---------|
| **Archivo** | `docs/CALENDARIO27.pdf` + `docs/calendario_TESCHA_2026_2027.json` |
| **Tipo** | PDF oficial + JSON estructurado |
| **Propósito** | Fuente oficial para disponibilidad/no disponibilidad de fechas |
| **Datos que contiene** | Periodo, feriados, vacaciones, suspensiones |
| **Tablas que reciben datos** | `calendarios_escolares`, `periodos` |
| **Datos que NO deben importarse** | Eventos de otros periodos |
| **Ambigüedades** | Ninguna |
| **Tipo de fuente** | Oficial |

### 1.3 Temario de Gestión de Proyectos de Software

| Aspecto | Detalle |
|---------|---------|
| **Archivo** | `docs/Gestión de Proyectos de Software.pdf` |
| **Tipo** | PDF oficial (TecNM) |
| **Propósito** | Fuente para competencias, unidades, temas, subtemas, horas |
| **Datos que contiene** | 5 unidades, 37 subtemas, 5 competencias, horas por competencia |
| **Tablas que reciben datos** | `unidades`, `competencias`, `temas` |
| **Datos que NO deben importarse** | Actividades, evidencias, evaluaciones del docente |
| **Ambigüedades** | Ninguna |
| **Tipo de fuente** | Oficial |

### 1.4 Instrumentación Didáctica GPS (lleno)

| Aspecto | Detalle |
|---------|---------|
| **Archivo** | `docs/Instrumentación Didáctica GPS.docx` |
| **Tipo** | Documento lleno de referencia |
| **Propósito** | Validar estructura y verificar generación posterior |
| **Datos que contiene** | Datos completo de instrumentación |
| **Tablas que reciben datos** | Ninguna (solo referencia) |
| **Datos que NO deben importarse** | Fechas, decisiones del docente |
| **Ambigüedades** | Ninguna |
| **Tipo de fuente** | Referencia (documento lleno) |

### 1.5 AvancePro GPS 4701 (lleno)

| Aspecto | Detalle |
|---------|---------|
| **Archivo** | `docs/AvancePro GPS 4701.docx` |
| **Tipo** | Documento lleno de referencia |
| **Propósito** | Validar estructura y verificar generación posterior |
| **Datos que contiene** | Datos completos de planeación |
| **Tablas que reciben datos** | Ninguna (solo referencia) |
| **Datos que NO deben importarse** | Fechas, decisiones del docente |
| **Ambigüedades** | Ninguna |
| **Tipo de fuente** | Referencia (documento lleno) |

### 1.6 Formatos oficiales en blanco

| Aspecto | Detalle |
|---------|---------|
| **Archivos** | `docs/SGI_G3_3.1_PLAN_Y_AV_PROGRA_2025.docx`, `docs/SGI_G3_3.5_INSTRUMENTACIÓN_DIDÁCTICA_2025.docx` |
| **Tipo** | Formatos oficiales en blanco |
| **Propósito** | Definir estructura de documentos |
| **Datos que contiene** | Estructura de campos |
| **Tablas que reciben datos** | Ninguna (solo referencia) |
| **Datos que NO deben importarse** | Ninguna |
| **Ambigüedades** | Ninguna |
| **Tipo de fuente** | Oficial (formato) |

---

## 2. RESUMEN DE FUENTES

| Fuente | Tipo | Tablas destino |
|--------|------|----------------|
| Horarios PDF | Oficial | `grupos`, `horarios`, `docentes`, `asignaturas` |
| Calendario JSON | Oficial | `calendarios_escolares`, `periodos` |
| Temario PDF | Oficial | `unidades`, `competencias`, `temas` |
| Instrumentación llena | Referencia | Ninguna |
| AvancePro llena | Referencia | Ninguna |
| Formatos en blanco | Oficial | Ninguna |

---

## 3. DATOS QUE NO SE IMPORTANOS

| Dato | Motivo |
|------|--------|
| Fechas de AvancePro | Son decisiones del docente, no datos oficiales |
| Fechas de Instrumentación | Son decisiones del docente, no datos oficiales |
| Actividades del docente | No están en las fuentes oficiales |
| Evidencias del docente | No están en las fuentes oficiales |
| Evaluaciones del docente | No están en las fuentes oficiales |
| Horarios de otros grupos | Solo se carga el grupo 4701 |

---

> **NOTA IMPORTANTE:** Este documento es el análisis de fuentes. El mapeo detallado fuente → BD está en `docs/MAPEO_FUENTES_A_BD.md`.
