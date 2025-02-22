<?php
    require_once "../config/config.php";
    require_once "../config/funciones.php";

    $conexion = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
    if (!$conexion) { 
        echo "Error en la conexión"; 
        die();
    } 
 
    // $consulta->close();
    // $conexion->close();

    //aca llamo a los archivos para las funciones necesarias
    require_once "../funciones/funcionesServicios.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../assets/js/serviciosValidaciones.js" defer></script>

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Servicios</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar servicios";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_servicios">
        <a href="index.php" class="btn btn-primary mb-4">Volver a la pagina de servicios</a>

        <form id="formularioServicio" action="procesar.php" method="post" class="shadow p-4 rounded bg-white mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Registrar Nuevo Servicio</h2>

            <div class="mb-3">
                <label for="descripcionServicio" class="form-label">Descripción:</label>
                <input
                    type="text"
                    class="form-control"
                    id="descripcionServicio"
                    name="descripcionServicio"
                    placeholder="Describe el servicio"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="duracionServicio" class="form-label">Duración (minutos):</label>
                <input
                    type="number"
                    class="form-control"
                    id="duracionServicio"
                    name="duracionServicio"
                    placeholder="Introduce la duración en minutos"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="precioServicio" class="form-label">Precio €:</label>
                <input
                    type="number"
                    class="form-control"
                    id="precioServicio"
                    name="precioServicio"
                    placeholder="Introduce el precio del servicio"
                />
                <span class="error"></span>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrar Servicio</button>
        </form>


    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>