# CIERRE DE FASE C — MOTOR DE CALENDARIZACIÓN

> **Fecha de generación:** 2026-10-08
> **Estado:** ✅ CERRADA
> **Pruebas:** 73/73 pasando

---

## 1. PROBLEMA ORIGINAL DE LAS 2 PRUEBAS

### Pruebas fallidas

| Prueba | Error original |
|--------|----------------|
| `test_generacion_sesiones` | `Failed asserting that an array is not empty` |
| `test_acumulacion_horas` | `Failed asserting that 0 is greater than 0` |

### Causa real

El `DisponibilidadService` usaba `$fechaActual->format('l')` que devuelve el día en **inglés** (Monday, Tuesday, etc.), pero la tabla `horarios` almacena los días en **español** (lunes, martes, etc.).

Al no coincidir, el servicio no encontraba horarios para ningún día y retornaba un array vacío.

### Segunda causa

En el contexto de testing, los campos de hora (`hora_inicio`, `hora_fin`) se devuelven como **strings**, no como objetos Carbon. El servicio intentaba llamar `->format('H:i')` sobre un string, causando error fatal.

---

## 2. SOLUCIÓN

### Corrección 1: Traducción de días

Se agregó método `traducirDia()` en `DisponibilidadService`:

```php
private function traducirDia(string $diaIngles): string
{
    $dias = [
        'monday' => 'lunes',
        'tuesday' => 'martes',
        'wednesday' => 'miercoles',
        'thursday' => 'jueves',
        'friday' => 'viernes',
        'saturday' => 'sabado',
        'sunday' => 'domingo',
    ];

    return $dias[$diaIngles] ?? $diaIngles;
}
```

### Corrección 2: Manejo de horas como strings

Se modificó la obtención de horas para manejar ambos casos:

```php
$horaInicio = is_string($horarioDia->hora_inicio)
    ? substr($horarioDia->hora_inicio, 0, 5)
    : $horarioDia->hora_inicio->format('H:i');
```

---

## 3. RESULTADO FINAL DE PRUEBAS

### 3.1 MotorCalendarizacionTest

```bash
php artisan test tests/Unit/Services/MotorCalendarizacionTest.php
```

**Resultado:** ✅ 18/18 pasando

### 3.2 Suite completa desde BD limpia

```bash
php artisan migrate:fresh --env=testing
php artisan db:seed --env=testing
php artisan test
```

**Resultado:** ✅ 73/73 pasando

---

## 4. PRUEBA DE INTEGRACIÓN 4701

### Entrada
- Periodo: 2026-2
- Grupo: 4701
- Horario: Cargado desde BD
- Calendario: Cargado desde BD
- Temario: Cargado desde BD

### Verificación

| Criterio | Resultado |
|----------|-----------|
| Sesiones solo lunes-jueves | ✅ |
| Viernes ausente | ✅ |
| 6 horas semanales disponibles | ✅ |
| Restricciones del calendario respetadas | ✅ |
| Horas de la carga académica distribuibles | ✅ |
| Resultado reproducible | ✅ |

---

## 5. VERIFICACIÓN ANTI-HARDCODE

### Búsqueda en `app/Services`

| Patrón buscado | Resultado |
|-----------------|-----------|
| `4701` | ❌ No encontrado |
| `Gestión de Proyectos de Software` | ✅ Solo en `TemarioService` (correcto) |
| `Fabiola Garcia Gutierrez` | ❌ No encontrado |
| `lunes.*12:00` | ❌ No encontrado |
| `martes.*11:00` | ❌ No encontrado |
| `miercoles.*11:00` | ❌ No encontrado |
| `jueves.*12:00` | ❌ No encontrado |

### Conclusión

✅ **No existe hardcodeo de reglas del grupo 4701 en los servicios del motor.**

---

## 6. VERIFICACIÓN DE PERSISTENCIA

### Flujo verificado

```
Crear calendarización
    ↓
Generar escenario
    ↓
Guardar en BD
    ↓
Recuperar de BD
    ↓
Validar datos
```

### Pruebas de persistencia

| Prueba | Resultado |
|--------|-----------|
| `test_generacion_escenario_uniforme` | ✅ |
| `test_generacion_escenario_compacto` | ✅ |
| `test_generacion_escenario_extendido` | ✅ |
| `test_validacion_escenario` | ✅ |
| `test_comparacion_escenarios` | ✅ |

---

## 7. ARCHIVOS MODIFICADOS

| Archivo | Cambio |
|---------|--------|
| `app/Services/DisponibilidadService.php` | Traducción de días + manejo de strings |
| `tests/Unit/Services/MotorCalendarizacionTest.php` | Sin cambios (las pruebas estaban bien) |

---

## 8. SERVICIOS DEFINITIVOS UTILIZADOS

| Servicio | Responsabilidad |
|----------|-----------------|
| `DisponibilidadService` | Obtener sesiones reales disponibles |
| `CalendarizacionService` | Construir calendarización base |
| `EscenarioService` | Generar escenarios |
| `ValidacionCalendarizacionService` | Validar y puntuar |

---

## 9. CÓDIGO PROVISIONAL QUE TODAVÍA PERMANECE

| Archivo | Estado |
|---------|--------|
| `GeneradorPropuestaService.php` | ⚠️ Reemplazado |
| `GeneradorEscenariosService.php` | ⚠️ Reemplazado |
| `tests/Unit/Services/GeneradorPropuestaServiceTest.php` | ⚠️ Obsoleta |

---

## 10. CRITERIOS DE CIERRE

| Criterio | Estado |
|----------|--------|
| Pruebas relevantes 100% pasando | ✅ 73/73 |
| Pruebas reproducibles desde BD limpia | ✅ |
| BD de testing aislada | ✅ |
| Caso real 4701 correcto | ✅ |
| Horario obtenido desde BD | ✅ |
| Calendario obtenido desde BD | ✅ |
| Temario obtenido desde BD | ✅ |
| Restricciones respetadas | ✅ |
| Sin hardcodeo de reglas de 4701 | ✅ |
| Escenarios reproducibles | ✅ |
| Persistencia funcional | ✅ |
| Documentación actualizada | ✅ |

---

## APROBADO PARA FASE D: **SÍ**

---

> **NOTA IMPORTANTE:** Fase C está cerrada. No se continúa con Fase D hasta nueva instrucción.
