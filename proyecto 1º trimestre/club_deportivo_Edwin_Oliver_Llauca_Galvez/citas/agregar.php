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
    require_once "../funciones/funcionesCitas.php";
    require_once "../funciones/funcionesServicios.php";
    require_once "../funciones/funcionesSocios.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="../assets/js/citasValidaciones.js" defer></script>

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar nueva cita</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar nueva cita";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_socios">
        <a href="index.php" class="btn btn-primary mb-4">Volver a la pagina de citas</a>

        <?php
            $socios = getSociosDesplegable($conexion);
            $servicios = getServiciosDesplegable($conexion);
        ?>

        <form id="formularioCita" action="procesar.php" method="post" class="shadow p-4 rounded bg-white mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Crear Nueva Cita</h2>

            <div class="mb-3">
                <label for="socioCita" class="form-label">Selecciona Socio:</label>
                <select class="form-select" id="socioCita" name="socioCita">
                    <option value="0" selected class="text-muted">Selecciona Socio</option>
                    <?php foreach ($socios as $socio): ?>
                        <option value="<?= $socio['id'] ?>"><?= $socio['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="servicioCita" class="form-label">Seleccionar servicio:</label>
                <select class="form-select" id="servicioCita" name="servicioCita">
                    <option value="0" selected class="text-muted">Seleccionar servicio</option>
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?= $servicio['id'] ?>"><?= $servicio['descripcion'] ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="fechaCita" class="form-label">Fecha:</label>
                <input
                    type="date"
                    class="form-control"
                    id="fechaCita"
                    name="fechaCita"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="horaCita" class="form-label">Hora:</label>
                <input
                    type="time"
                    class="form-control"
                    id="horaCita"
                    name="horaCita"
                />
                <span class="error"></span>
            </div>


            <button type="submit" class="btn btn-success w-100">Crear Cita</button>
        </form>






    </section>
    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>