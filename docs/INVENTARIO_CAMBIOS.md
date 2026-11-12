# INVENTARIO DE CAMBIOS — ETAPA DE ANÁLISIS/PROTOTIPO

> **Fecha de generación:** 2026-10-07
> **Nota:** El proyecto NO es un repositorio git. Este inventario se basa en el historial de la sesión.

---

## 1. ARCHIVOS CREADOS

### 1.1 Documentos de análisis

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `docs/PLAN_PROYECTO.md` | Creado | Plan inicial del proyecto | Definitivo | ✅ Sí |
| `docs/REQUISITOS_CONFIRMADOS.md` | Creado | Requisitos confirmados por la profesora | Definitivo | ✅ Sí |
| `docs/PREGUNTAS_PARA_PROFESORA.md` | Creado | Cuestionario para la profesora | Definitivo | ✅ Sí |
| `docs/MAPA_DE_DATOS_DOCUMENTOS.md` | Creado | Análisis de datos compartidos | Definitivo | ✅ Sí |
| `docs/ESTADO_ACTUAL_PROYECTO.md` | Creado | Estado actual del proyecto | Definitivo | ✅ Sí |
| `docs/INVENTARIO_CAMBIOS.md` | Creado | Este documento | Definitivo | ✅ Sí |

### 1.2 Servicios (PROVISIONALES)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `app/Services/CalendarioService.php` | Creado | Lee y consulta el JSON del calendario | Provisional | ✅ Sí (mientras esperamos formatos en blanco) |
| `app/Services/TemarioService.php` | Creado | Lee y extrae datos del PDF del temario | Provisional | ✅ Sí |
| `app/Services/HorarioService.php` | Creado | Lee y extrae datos del PDF de horarios | Provisional | ✅ Sí |
| `app/Services/GeneradorPropuestaService.php` | Creado | Genera propuestas de calendarización | Provisional | ✅ Sí |
| `app/Services/GeneradorEscenariosService.php` | Creado | Versión anterior del generador | Provisional | ✅ Sí |

### 1.3 Pruebas (PROVISIONALES)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `tests/Unit/Services/HorarioServiceTest.php` | Creado | Pruebas para HorarioService | Provisional | ✅ Sí |
| `tests/Unit/Services/GeneradorPropuestaServiceTest.php` | Creado | Pruebas para GeneradorPropuestaService | Provisional | ✅ Sí |

### 1.4 Vistas (PROVISIONALES)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `resources/views/planeacion/escenarios.blade.php` | Creado | Formulario y tabla de resultados | Provisional | ✅ Sí |

### 1.5 Configuración (PROVISIONAL)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `config/calendario.php` | Creado | Configuración del calendario | Provisional | ✅ Sí |

### 1.6 Rutas (PROVISIONAL)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `routes/web.php` | Modificado | Agregada ruta `/planeacion/escenarios` | Provisional | ✅ Sí |

### 1.7 Controlador (PROVISIONAL)

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `app/Http/Controllers/PlaneacionController.php` | Modificado | Método `escenarios()` | Provisional | ✅ Sí |

### 1.8 Dependencias

| Archivo | Tipo | Propósito | Estado | ¿Conservar? |
|---------|------|-----------|--------|-------------|
| `composer.json` | Modificado | Agregado `smalot/pdfparser` | Provisional | ✅ Sí |
| `composer.lock` | Modificado | Actualizado con dependencias | Provisional | ✅ Sí |

---

## 2. ARCHIVOS NO MODIFICADOS

### 2.1 Servicios existentes (NO tocar)

| Archivo | Estado | ¿Por qué no modificar? |
|---------|--------|------------------------|
| `app/Services/CalendarioService.php` | Creado en esta sesión | Provisional, pero funcional |
| `app/Models/*.php` | Existentes (vacíos) | No diseñados todavía |
| `database/migrations/*.php` | Existentes | No rediseñar hasta definir arquitectura |

### 2.2 Documentos de referencia (NO tocar)

| Archivo | Estado | ¿Por qué no modificar? |
|---------|--------|------------------------|
| `docs/Instrumentación Didáctica GPS.docx` | Existente | Fuente oficial |
| `docs/AvancePro GPS 4701.docx` | Existente | Fuente oficial |
| `docs/CALENDARIO27.pdf` | Existente | Fuente oficial |
| `docs/Gestión de Proyectos de Software.pdf` | Existente | Fuente oficial |
| `docs/Horarios 2026-2 -Presencial.pdf` | Existente | Fuente oficial |
| `docs/calendario_TESCHA_2026_2027.json` | Existente | Fuente oficial |

---

## 3. DISCREPANCIA PENDIENTE DE VERIFICACIÓN

### 3.1 Horario del grupo 4701

| Fuente | Lunes | Martes | Miércoles | Jueves | Viernes |
|--------|-------|--------|-----------|--------|---------|
| **Profesora** | 2h | Sin clase | 1h | 1h | 2h |
| **PDF Horarios** | 2h | 1h | 1h | 2h | Sin clase |

**Estado:** ⏳ PENDIENTE DE VERIFICACIÓN

**Acción:** No resolver por tu cuenta. Marcar como pendiente y esperar confirmación de la profesora.

---

## 4. RESUMEN DE ESTADO

| Categoría | Cantidad | Estado |
|-----------|----------|--------|
| Documentos de análisis | 6 | ✅ Definitivos |
| Servicios provisionales | 5 | ⚠️ Provisionales |
| Pruebas provisionales | 2 | ⚠️ Provisionales |
| Vistas provisionales | 1 | ⚠️ Provisional |
| Configuración provisional | 1 | ⚠️ Provisional |
| Rutas provisionales | 1 | ⚠️ Provisional |
| Controlador provisional | 1 | ⚠️ Provisional |
| Dependencias provisionales | 2 | ⚠️ Provisionales |

---

## 5. INSTRUCCIONES MIENTRAS ESPERAMOS FORMATOS EN BLANCO

### 5.1 NO hacer

- ❌ No desarrollar nuevas funcionalidades
- ❌ No avanzar el algoritmo de calendarización
- ❌ No diseñar la base de datos definitiva
- ❌ No crear nuevas migraciones
- ❌ No modificar los modelos actuales
- ❌ No generar documentos todavía
- ❌ No instalar dependencias
- ❌ No eliminar archivos provisionales

### 5.2 SÍ hacer

- ✅ Mantener la aplicación en estado seguro
- ✅ Documentar cualquier cambio
- ✅ Esperar formatos en blanco
- ✅ Verificar discrepancias con la profesora

---

## 6. ARCHIVOS QUE DEBEMOS OBTENER

| Archivo | Prioridad | ¿Para qué? |
|---------|-----------|------------|
| Instrumentación Didáctica en blanco | 🔴 Alta | Definir qué captura el profesor |
| AvancePro en blanco | 🔴 Alta | Definir qué captura el profesor |

---

> **NOTA IMPORTANTE:** Todos los servicios y vistas creados en esta etapa son PROVISIONALES. No deben considerarse definitivos hasta obtener los formatos en blanco y definir la arquitectura correcta.
