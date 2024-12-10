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

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Servicios</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Servicios";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_servicios">
        <a href="agregar.php" class="btn btn-primary mb-4">Crear un nuevo Servicio</a>

        <?php
       
       //compruebo si le paso una id es por que ya tengo el servicio y solo la quiero modificar con nuevos datos
        if (isset($_POST['idServicio']) && (isset($_POST['descripcionServicio'], $_POST['duracionServicio'], $_POST['precioServicio']))) {
            $id = intval($_POST['idServicio']);
            $descripcion = trim($_POST['descripcionServicio']);
            $duracion = intval($_POST['duracionServicio']);
            $precio = floatval($_POST['precioServicio']);

            $resultado = modificarServicioPorId($conexion, $id, $descripcion, $duracion, $precio);


            if ($resultado) {
                echo "<p>Servicio actualizado exitosamente</p>";
            } else {
                echo "<p>Error: No se pudo actualizar el servicio. Verifica los datos ingresados</p>";
            }
        }
        elseif (isset($_POST['descripcionServicio'], $_POST['duracionServicio'], $_POST['precioServicio'])) {
            $descripcion = trim($_POST['descripcionServicio']);
            $duracion = intval($_POST['duracionServicio']);
            $precio = floatval($_POST['precioServicio']);

            $resultado = crearServicio($conexion, $descripcion, $duracion, $precio);

            if ($resultado) {
                echo "<p>Servicio registrado exitosamente.</p>";
            } else {
                echo "<p>Error: No se pudo registrar el servicio. Verifica los datos ingresados.</p>";
            }
        } else {
            echo "<p>Error: Faltan datos necesarios. Redirigiendo en 4 segundos...</p>";
            header("refresh:4;url=index.php");
        }

        echo "<p>Redirigiendo a la pagina principal en 4 segundos...</p>";
        header("refresh:4;url=index.php");
        ?>
    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>