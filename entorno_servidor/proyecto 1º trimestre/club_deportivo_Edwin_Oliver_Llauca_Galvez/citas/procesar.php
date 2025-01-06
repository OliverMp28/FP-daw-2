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
       
        if (isset($_POST['socioCita'], $_POST['servicioCita'], $_POST['fechaCita'], $_POST['horaCita'])) {
            $socioId = intval($_POST['socioCita']);
            $servicioId = intval($_POST['servicioCita']);
            $fechaCita = trim($_POST['fechaCita']);
            $horaCita = trim($_POST['horaCita']);

        
            $resultado = crearCita($conexion, $socioId, $servicioId, $fechaCita, $horaCita);
        
            echo "<p>{$resultado}</p>";
            echo "<p>Redirigiendo a la página principal en 4 segundos...</p>";
            header("refresh:4;url=index.php");
       } else {
           echo "<p>Error: Faltan datos necesarios. Redirigiendo en 4 segundos...</p>";
           header("refresh:4;url=index.php");
           exit;
       }
       
       
        ?>
    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>
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
       
        if (isset($_POST['socioCita'], $_POST['servicioCita'], $_POST['fechaCita'], $_POST['horaCita'])) {
            $socioId = intval($_POST['socioCita']);
            $servicioId = intval($_POST['servicioCita']);
            $fechaCita = trim($_POST['fechaCita']);
            $horaCita = trim($_POST['horaCita']);

        
            $resultado = crearCita($conexion, $socioId, $servicioId, $fechaCita, $horaCita);
        
            echo "<p>{$resultado}</p>";
            echo "<p>Redirigiendo a la página principal en 4 segundos...</p>";
            header("refresh:4;url=index.php");
       } else {
           echo "<p>Error: Faltan datos necesarios. Redirigiendo en 4 segundos...</p>";
           header("refresh:4;url=index.php");
           exit;
       }
       
       
        ?>
    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>