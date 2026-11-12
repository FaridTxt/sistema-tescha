<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Planeación GPS 4701</title>

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
        }

        .contenedor {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .informacion,
        .tabla-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
        }

        .datos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        }

        .dato {
            background: #f7f9fb;
            padding: 15px;
            border-radius: 8px;
        }

        .dato strong {
            display: block;
            margin-bottom: 5px;
            color: #123b63;
        }

        .boton {
            margin-top: 20px;
            padding: 12px 20px;
            background: #123b63;
            color: white;
            border: 0;
            border-radius: 6px;
            cursor: pointer;
        }

        .boton:hover {
            background: #0d2d4b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #123b63;
            color: white;
        }

        .propuesta {
            color: #8a6500;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            table {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<header class="encabezado">
    <h1>Planeación Académica</h1>
    <p>Gestión de Proyectos de Software — Grupo 4701</p>
</header>

<main class="contenedor">

    <section class="informacion">

        <h2>Información de la materia</h2>

        <div class="datos">

            <div class="dato">
                <strong>Materia</strong>
                Gestión de Proyectos de Software
            </div>

            <div class="dato">
                <strong>Clave</strong>
                SCG-1009
            </div>

            <div class="dato">
                <strong>Grupo</strong>
                4701
            </div>

            <div class="dato">
                <strong>Carrera</strong>
                Ingeniería en Sistemas Computacionales
            </div>

            <div class="dato">
                <strong>Periodo</strong>
                2026-2
            </div>

            <div class="dato">
                <strong>Docente</strong>
                Fabiola García Gutiérrez
            </div>

        </div>

        <button class="boton">
            Generar propuesta de calendarización
        </button>

    </section>

    <section class="tabla-container">

        <h2>Propuesta de calendarización</h2>

        <p>
            Estas fechas son una propuesta inicial y posteriormente
            serán calculadas automáticamente con base en el calendario escolar.
        </p>

        <table>

            <thead>
                <tr>
                    <th>Unidad</th>
                    <th>Tema / Subtema</th>
                    <th>Fecha propuesta</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>1.1 Conceptos básicos para la gestión de proyectos</td>
                    <td>01 - 04 septiembre</td>
                    <td class="propuesta">Propuesta</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>1.2 Fases de la gestión de proyectos</td>
                    <td>07 - 11 septiembre</td>
                    <td class="propuesta">Propuesta</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>1.2.1 Planificación de proyectos</td>
                    <td>14 - 18 septiembre</td>
                    <td class="propuesta">Propuesta</td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>1.2.2 Propuesta</td>
                    <td>21 - 25 septiembre</td>
                    <td class="propuesta">Propuesta</td>
                </tr>

            </tbody>

        </table>

    </section>

</main>

</body>
</html>