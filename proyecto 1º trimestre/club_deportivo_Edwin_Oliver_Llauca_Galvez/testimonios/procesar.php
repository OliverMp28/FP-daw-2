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
    require_once "../funciones/funcionesTestimonios.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar Testimonio nuevo</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar Testimonio nuevo";
        require_once "../requires/cabecera.php"
    ?>

    <main>
        <!-- Aqui ira la respuesta despues de agregar el testimonio a la bd (testimonio insertada/ no insertada) -->
        <?php
             if (isset($_POST['autorTestimonio'], $_POST['contenidoTestimonio'])) {

                $id = (int)($_POST['autorTestimonio']);
                $contenidoTestimonio = trim($_POST['contenidoTestimonio']);
    
                $respuesta = crearTestimonio($conexion, $id, $contenidoTestimonio);
                echo $respuesta;
            } else {
                echo "<p>Error: No se han enviado todos los campos de la noticia para crearla. REDIRIGIENTO EN 4s.</p>";
                header("refresh:4;url=index.php");
            }
            echo "<p>Redirigiendo a la pagina de noticias 4s</p>";
            header("refresh:4;url=index.php");
        ?>

    </main>
    <?php
        include('../requires/footer.php');
    ?>
    
</body>
</html>