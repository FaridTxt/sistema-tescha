<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Ruta del archivo JSON del calendario escolar
    |--------------------------------------------------------------------------
    |
    | Ruta absoluta al archivo JSON que contiene el calendario escolar.
    |
    */
    'ruta_json' => base_path('docs/calendario_TESCHA_2026_2027.json'),

    /*
    |--------------------------------------------------------------------------
    | Formato de fecha
    |--------------------------------------------------------------------------
    |
    | Formato de fecha utilizado en el calendario.
    |
    */
    'formato_fecha' => 'Y-m-d',

    /*
    |--------------------------------------------------------------------------
    | Días sin clase
    |--------------------------------------------------------------------------
    |
    | Días de la semana en los que no hay clase.
    | 0 = lunes, 1 = martes, 2 = miércoles, 3 = jueves, 4 = viernes, 5 = sábado, 6 = domingo
    |
    | NOTA: El grupo 4701 NO tiene clase los viernes.
    | Se excluyen viernes, sábados y domingos.
    |
    */
    'dias_sin_clase' => [4, 5, 6], // Viernes, sábado y domingo
];
