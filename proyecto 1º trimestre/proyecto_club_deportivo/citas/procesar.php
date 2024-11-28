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
    <title>Citas</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Citas";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_citas">

        <?php
       
       if (
           isset($_POST['socioCita'], $_POST['servicioCita'], $_POST['fechaCita'], $_POST['horaCita'])
       ) {
           $socioId = intval($_POST['socioCita']);
           $servicioId = intval($_POST['servicioCita']);
           $fechaCita = trim($_POST['fechaCita']);
           $horaCita = trim($_POST['horaCita']);
       
           // Validaciones iniciales
           if ($socioId <= 0 || $servicioId <= 0) {
               echo "<p>Error: Debes seleccionar un socio y un servicio válidos.</p>";
               header("refresh:4;url=index.php");
               exit;
           }
       
           if (!validarFecha($fechaCita)) {
               echo "<p>Error: La fecha ingresada no es válida.</p>";
               header("refresh:4;url=index.php");
               exit;
           }
       
           if (!validarHora($horaCita)) {
               echo "<p>Error: La hora ingresada no es válida.</p>";
               header("refresh:4;url=index.php");
               exit;
           }
       
           // Crear la cita usando la función existente
           $resultado = crearCita($conexion, $socioId, $servicioId, $fechaCita, $horaCita);
       
           if ($resultado === "Cita creada exitosamente.") {
               echo "<p>$resultado</p>";
           } else {
               echo "<p>Error: $resultado</p>";
           }
       } else {
           echo "<p>Error: Faltan datos necesarios. Redirigiendo en 4 segundos...</p>";
           header("refresh:4;url=index.php");
           exit;
       }
       
       // Redirección final
       echo "<p>Redirigiendo a la página principal en 4 segundos...</p>";
       header("refresh:4;url=index.php");
       
       // Validación de fecha
       function validarFecha($fecha) {
           $fechaArray = explode("-", $fecha);
           if (count($fechaArray) === 3) {
               return checkdate(intval($fechaArray[1]), intval($fechaArray[2]), intval($fechaArray[0]));
           }
           return false;
       }
       
       // Validación de hora
       function validarHora($hora) {
           return preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $hora);
       }
       
        ?>
    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>