<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Escenarios - TESCHA</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .encabezado {
            background: #123b63;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .encabezado h1 {
            margin: 0;
            font-size: 28px;
        }

        .contenedor {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .formulario {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .formulario h2 {
            color: #123b63;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            background: #123b63;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #0d2d4b;
        }

        .resultados {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .resultados h2 {
            color: #123b63;
            margin-top: 0;
        }

        .info-asignatura {
            background: #f7f9fb;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-asignatura p {
            margin: 5px 0;
        }

        .advertencias {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .advertencias h3 {
            color: #856404;
            margin-top: 0;
        }

        .advertencias ul {
            margin: 0;
            padding-left: 20px;
        }

        .advertencias li {
            color: #856404;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #123b63;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .estado-programado {
            color: #28a745;
            font-weight: bold;
        }

        .estado-pendiente {
            color: #ffc107;
            font-weight: bold;
        }

        .resumen {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .resumen-item {
            background: #f7f9fb;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .resumen-item .numero {
            font-size: 24px;
            font-weight: bold;
            color: #123b63;
        }

        .resumen-item .label {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header class="encabezado">
    <h1>Generador de Escenarios de Calendarización</h1>
    <p>Tecnológico de Estudios Superiores de Chalco</p>
</header>

<main class="contenedor">

    <section class="formulario">
        <h2>Datos de la Asignatura</h2>

        <form method="GET" action="{{ route('planeacion.escenarios') }}">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre de la asignatura</label>
                    <input type="text" id="nombre" name="nombre" value="{{ request('nombre', 'Gestión de Proyectos de Software') }}" required>
                </div>

                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" id="grupo" name="grupo" value="{{ request('grupo', '4701') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="ciclo_escolar">Ciclo escolar</label>
                    <input type="text" id="ciclo_escolar" name="ciclo_escolar" value="{{ request('ciclo_escolar', '2026-2027') }}" required>
                </div>

                <div class="form-group">
                    <label for="horas_semanales">Horas semanales</label>
                    <input type="number" id="horas_semanales" name="horas_semanales" value="{{ request('horas_semanales', 6) }}" min="1" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio</label>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio', '2026-09-01') }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin">Fecha de fin</label>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin', '2027-01-29') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Unidades y temas (formato: Unidad 1: Tema 1, Tema 2, Tema 3 | Unidad 2: Tema 1, Tema 2)</label>
                <textarea name="unidades_temas" rows="5" placeholder="Unidad 1: Introducción, Variables, Estructuras | Unidad 2: Funciones, Clases">{{ request('unidades_temas', 'Unidad 1: Introducción, Variables, Estructuras | Unidad 2: Funciones, Clases') }}</textarea>
            </div>

            <button type="submit" class="btn">Generar escenarios</button>
        </form>
    </section>

    @if(isset($resultado))
    <section class="resultados">
        <h2>Resultados</h2>

        <div class="info-asignatura">
            <p><strong>Asignatura:</strong> {{ $resultado['asignatura']['nombre'] }}</p>
            <p><strong>Grupo:</strong> {{ $resultado['asignatura']['grupo'] }}</p>
            <p><strong>Ciclo escolar:</strong> {{ $resultado['asignatura']['ciclo_escolar'] }}</p>
            <p><strong>Periodo:</strong> {{ $resultado['asignatura']['fecha_inicio'] }} al {{ $resultado['asignatura']['fecha_fin'] }}</p>
            <p><strong>Horas semanales:</strong> {{ $resultado['asignatura']['horas_semanales'] }}</p>
        </div>

        @if(count($resultado['advertencias']) > 0)
        <div class="advertencias">
            <h3>Advertencias</h3>
            <ul>
                @foreach($resultado['advertencias'] as $advertencia)
                <li>{{ $advertencia }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="resumen">
            <div class="resumen-item">
                <div class="numero">{{ $resultado['total_dias_laborables'] }}</div>
                <div class="label">Días laborables</div>
            </div>
            <div class="resumen-item">
                <div class="numero">{{ $resultado['total_temas_asignados'] }}</div>
                <div class="label">Temas asignados</div>
            </div>
        </div>

        <h3>Escenario 1</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Unidad</th>
                    <th>Tema</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultado['escenarios'][0] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['fecha'] }}</td>
                    <td>{{ $item['unidad'] }}</td>
                    <td>{{ $item['tema'] }}</td>
                    <td class="estado-{{ $item['estado'] == 'Programado' ? 'programado' : 'pendiente' }}">{{ $item['estado'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    @endif

</main>

</body>
</html>
