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
    require_once "../funciones/funcionesNoticias.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar noticia nueva</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar noticia nueva";
        require_once "../requires/cabecera.php"
    ?>

    <main>
        <!-- Aqui ira la respuesta despues de agregar la nueva noticia a la bd (noticia insertada/ no insertada) -->
        <?php

            if (isset($_POST['tituloNoticia'], $_POST['contenidoNoticia'], $_POST['fechaPublicacion'], $_FILES['imagenNoticia'])) {
                $titulo = trim($_POST['tituloNoticia']);
                $contenido = trim($_POST['contenidoNoticia']);
                $fechaPublicacion = $_POST['fechaPublicacion'];
            
                $imagen = $_FILES['imagenNoticia'];
                $directorioDestino = 'assets/img/';
                $nombreImagen = basename($imagen['name']);
                $rutaImagen = $directorioDestino . time() . "_" . $nombreImagen;
            
                if (!move_uploaded_file($imagen['tmp_name'], "../".$rutaImagen)) {
                    die("Error: No se pudo mover la imagen a la carpeta img");
                }
            
                $resultado = crearNoticia($conexion, $titulo, $contenido, $rutaImagen, $fechaPublicacion);
            
                echo "<p>{$resultado}</p>";
                echo "<p>Redirigiendo a la pagina de noticias 4s</p>";
                header("refresh:4;url=index.php");
            } else {
                echo "<p>Error: No se han enviado todos los campos de la noticia para crearla. REDIRIGIENTO EN 4s.</p>";
                header("refresh:4;url=index.php");
            }
        ?>

    </main>
    <?php
        include('../requires/footer.php');
    ?>
    
</body>
</html>