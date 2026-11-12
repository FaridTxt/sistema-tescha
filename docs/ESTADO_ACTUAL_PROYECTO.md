# ESTADO ACTUAL DEL PROYECTO — SISTEMA ACADÉMICO TESCHA

> **Fecha de generación:** 2026-09-28
> **Última actualización:** 2026-10-07
> **Estado general:** Diseño definitivo completado
> **Programación definitiva:** NO iniciada

---

## 1. QUÉ YA ESTÁ TERMINADO

### 1.1 Entorno de desarrollo

| Componente | Estado | Detalle |
|------------|--------|---------|
| PHP | ✅ Instalado | 8.5.10 |
| Composer | ✅ Instalado | 2.10.3 |
| Laravel | ✅ Instalado | 13.29.0 |
| XAMPP | ✅ Funcionando | Apache + MariaDB |
| phpMyAdmin | ✅ Accesible | Para administración de BD |
| Visual Studio Code | ✅ Disponible | Editor de código |

### 1.2 Estructura base del proyecto

| Elemento | Estado | Detalle |
|----------|--------|---------|
| Estructura Laravel | ✅ Completa | app/, routes/, resources/, database/ |
| Vite + Tailwind CSS | ✅ Configurado | Para assets frontend |
| PHPUnit | ✅ Configurado | Para pruebas unitarias |
| smalot/pdfparser | ✅ Instalado | Para lectura de PDFs |

### 1.3 Documentación de análisis y diseño

| Documento | Estado | Descripción |
|-----------|--------|-------------|
| `docs/PLAN_PROYECTO.md` | ✅ Creado | Plan inicial del proyecto |
| `docs/REQUISITOS_CONFIRMADOS.md` | ✅ Creado | Requisitos confirmados |
| `docs/PREGUNTAS_PARA_PROFESORA.md` | ✅ Actualizado | Preguntas pendientes (0) |
| `docs/MAPA_DE_DATOS_DOCUMENTOS.md` | ✅ Creado | Análisis de datos compartidos |
| `docs/MATRIZ_AUTOMATIZACION.md` | ✅ Creado | Matriz de automatización |
| `docs/ARQUITECTURA_DEFINITIVA.md` | ✅ Creado | Arquitectura definitiva |
| `docs/REGLAS_CALENDARIZACION.md` | ✅ Creado | Reglas de calendarización |
| `docs/MODELO_DATOS_DEFINITIVO.md` | ✅ Creado | Modelo de datos definitivo |
| `docs/ESTADO_ACTUAL_PROYECTO.md` | ✅ Actualizado | Este documento |
| `docs/INVENTARIO_CAMBIOS.md` | ✅ Creado | Inventario de cambios |

### 1.4 Reglas académicas confirmadas

| Regla | Estado | Fuente |
|-------|--------|--------|
| 6 horas semanales (3 HT + 3 HP) | ✅ Confirmada | Profesora |
| Horario del grupo 4701 | ✅ Confirmada | PDF Horarios oficial |
| Distribución libre de horas por tema | ✅ Confirmada | Profesora |
| Exclusión de feriados | ✅ Confirmada | Profesora |
| Exclusión de vacaciones | ✅ Confirmada | Profesora |
| Fechas de evaluación definidas por docente | ✅ Confirmada | Profesora |
| Fechas de evidencias definidas por docente | ✅ Confirmada | Profesora |
| Periodo 2026-2: 22 semanas | ✅ Confirmada | Profesora |
| Días no laborables: solo calendario escolar | ✅ Confirmada | Profesora |

### 1.5 Horario oficial del grupo 4701

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

## 2. QUÉ ESTÁ EN PROTOTIPO (PROVISIONAL)

### 2.1 Servicios provisionales

| Servicio | Estado | Descripción |
|----------|--------|-------------|
| `CalendarioService` | ⚠️ Provisional | Lee y consulta el JSON del calendario |
| `TemarioService` | ⚠️ Provisional | Lee y extrae datos del PDF del temario |
| `HorarioService` | ⚠️ Provisional | Lee y extrae datos del PDF de horarios |
| `GeneradorPropuestaService` | ⚠️ Provisional | Genera propuestas de calendarización |
| `GeneradorEscenariosService` | ⚠️ Provisional | Versión anterior (posiblemente obsoleta) |

### 2.2 Vistas provisionales

| Vista | Estado | Descripción |
|-------|--------|-------------|
| `resources/views/planeacion/escenarios.blade.php` | ⚠️ Provisional | Formulario y tabla de resultados |
| `resources/views/planeacion/gps-4701.blade.php` | ⚠️ Provisional | Vista estática |

### 2.3 Pruebas provisionales

| Prueba | Estado | Descripción |
|--------|--------|-------------|
| `HorarioServiceTest` | ⚠️ Provisional | Pruebas para HorarioService |
| `GeneradorPropuestaServiceTest` | ⚠️ Provisional | Pruebas para GeneradorPropuestaService |

---

## 3. QUÉ ESTÁ PENDIENTE

### 3.1 Diseño definitivo (COMPLETADO)

| Tarea | Estado |
|-------|--------|
| Modelo de dominio definitivo | ✅ Completado |
| Matriz campo por campo | ✅ Completado |
| Reglas de calendarización | ✅ Completado |
| Generación de escenarios | ✅ Completado |
| Flujo completo del sistema | ✅ Completado |
| Regla de consistencia | ✅ Completado |
| Validaciones | ✅ Completado |
| Modo de cambio y regeneración | ✅ Completado |
| Arquitectura de implementación | ✅ Completado |
| Plan de implementación por fases | ✅ Completado |

### 3.2 Implementación (NO INICIADA)

| Tarea | Prioridad | Descripción |
|-------|-----------|-------------|
| Migraciones definitivas | 🔴 Alta | Basadas en el modelo de datos |
| Modelos Eloquent | 🔴 Alta | Basados en el modelo de datos |
| Servicios definitivos | 🔴 Alta | Basados en la arquitectura |
| Controladores definitivos | 🟡 Media | Basados en el flujo del sistema |
| Vistas definitivas | 🟡 Media | Interfaz completa del sistema |
| Generación de PDF | 🟡 Media | Librería y plantillas |
| Sistema de autenticación | 🟡 Media | Login de docentes |

---

## 4. QUÉ CÓDIGO ACTUAL PROBABLEMENTE SERÁ TEMPORAL

| Archivo | Probabilidad de cambio | Motivo |
|---------|------------------------|--------|
| `GeneradorEscenariosService.php` | 🔴 Alta | Versión anterior, posiblemente obsoleta |
| `GeneradorPropuestaService.php` | 🟡 Media | Algoritmo en desarrollo |
| Vistas de planeación | 🟡 Media | Prototipos de interfaz |
| `PlaneacionController.php` | 🟡 Media | Prototipo de controlador |

---

## 5. QUÉ NO DEBE TOCARSE TODAVÍA

| Elemento | Motivo |
|----------|--------|
| `config/calendario.php` | Configuración correcta |
| `docs/calendario_TESCHA_2026_2027.json` | Fuente de datos oficial |
| `docs/Gestión de Proyectos de Software.pdf` | Fuente de datos oficial |
| `docs/Horarios 2026-2 -Presencial.pdf` | Fuente de datos oficial |
| `docs/Instrumentación Didáctica GPS.docx` | Fuente de datos oficial |
| `docs/AvancePro GPS 4701.docx` | Fuente de datos oficial |
| `docs/SGI_G3_3.1_PLAN_Y_AV_PROGRA_2025.docx` | Formato oficial en blanco |
| `docs/SGI_G3_3.5_INSTRUMENTACIÓN_DIDÁCTICA_2025.docx` | Formato oficial en blanco |
| Migraciones existentes | No rediseñar hasta definir arquitectura |
| Modelos existentes | No rediseñar hasta definir arquitectura |
| `composer.json` | No instalar dependencias nuevas |

---

## 6. DOCUMENTOS DE DISEÑO DEFINITIVO

| Documento | Descripción |
|-----------|-------------|
| `docs/ARQUITECTURA_DEFINITIVA.md` | Modelo de dominio, flujo completo, reglas de consistencia |
| `docs/REGLAS_CALENDARIZACION.md` | Reglas de calendarización, generación de escenarios, validaciones |
| `docs/MODELO_DATOS_DEFINITIVO.md` | Tablas definitivas, relaciones Eloquent, servicios |

---

## 7. RESUMEN EJECUTIVO

| Aspecto | Estado |
|---------|--------|
| **Entorno de desarrollo** | ✅ Terminado |
| **Documentación de análisis** | ✅ Completa |
| **Diseño definitivo** | ✅ Completado |
| **Servicios provisionales** | ⚠️ Existentes (no definitivos) |
| **Base de datos definitiva** | ❌ No diseñada |
| **Programación definitiva** | ❌ No iniciada |
| **Preguntas académicas pendientes** | 0 |

---

## 8. SIGUIENTES PASOS

1. **Revisar y aprobar** el diseño definitivo
2. **Implementar** migraciones definitivas
3. **Crear** modelos Eloquent
4. **Implementar** servicios definitivos
5. **Crear** controladores y vistas
6. **Implementar** generación de PDF
7. **Limpiar** código provisional

---

> **NOTA IMPORTANTE:** El diseño definitivo está completado. No se debe programar nada hasta revisar y aprobar el diseño.
