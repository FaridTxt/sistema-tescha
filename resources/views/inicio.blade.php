<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Planeación Académica TESCHA</title>

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
            font-size: 30px;
        }

        .encabezado p {
            margin: 8px 0 0;
        }

        .contenido {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
        }

        .bienvenida {
            text-align: center;
            margin-bottom: 35px;
        }

        .bienvenida h2 {
            color: #123b63;
        }

        .modulos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .tarjeta {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.10);
            text-align: center;
        }

        .tarjeta h3 {
            color: #123b63;
        }

        .tarjeta p {
            color: #666;
            min-height: 45px;
        }

        .boton {
            display: inline-block;
            padding: 10px 20px;
            background: #123b63;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .boton:hover {
            background: #0d2d4b;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: #123b63;
            color: white;
        }
    </style>
</head>

<body>

    <header class="encabezado">
        <h1>Sistema de Planeación Académica</h1>
        <p>Tecnológico de Estudios Superiores de Chalco</p>
    </header>

    <main class="contenido">

        <section class="bienvenida">
            <h2>Bienvenido</h2>

            <p>
                Sistema para la elaboración, administración y consulta
                de planeaciones académicas.
            </p>
        </section>

        <section class="modulos">

            <div class="tarjeta">
                <h3>Planeaciones</h3>
                <p>Crear y administrar las planeaciones académicas.</p>
                <a href="#" class="boton">Entrar</a>
            </div>

            <div class="tarjeta">
                <h3>Asignaturas</h3>
                <p>Registrar y consultar las asignaturas.</p>
                <a href="#" class="boton">Entrar</a>
            </div>

            <div class="tarjeta">
                <h3>Competencias</h3>
                <p>Administrar las competencias de las asignaturas.</p>
                <a href="#" class="boton">Entrar</a>
            </div>

            <div class="tarjeta">
                <h3>Unidades</h3>
                <p>Gestionar las unidades de aprendizaje.</p>
                <a href="#" class="boton">Entrar</a>
            </div>

            <div class="tarjeta">
                <h3>Actividades</h3>
                <p>Registrar las actividades de cada unidad.</p>
                <a href="#" class="boton">Entrar</a>
            </div>

            <div class="tarjeta">
                <h3>Generar PDF</h3>
                <p>Generar las planeaciones en formato PDF.</p>
                <a href="#" class="boton">Generar</a>
            </div>

        </section>

    </main>

    <footer>
        TESCHA © {{ date('Y') }}
    </footer>

</body>
</html>