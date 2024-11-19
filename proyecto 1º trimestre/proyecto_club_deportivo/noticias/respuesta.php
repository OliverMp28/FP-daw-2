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
            
                // Validación de tipo de archivo y tamaño
                $tipos_admitidos = ["image/png", "image/jpeg"];
                if (!in_array($imagen['type'], $tipos_admitidos)) {
                    die("Error: Solo se permiten archivos PNG o JPEG.");
                }
            
                if ($imagen['size'] > 2000000) {
                    die("Error: El archivo es demasiado grande Maximo 2MB");
                }
            
                if (!move_uploaded_file($imagen['tmp_name'], "../".$rutaImagen)) {
                    die("Error: No se pudo mover la imagen a la carpeta img");
                }
                
                // if(file_exists("../" . $rutaImagen)){
                //     echo "Error: el archivo ya existe.";
                // }else{
                //     move_uploaded_file($imagen['tmp_name'], $rutaImagen);
                // }

            
                $resultado = crearNoticia($conexion, $titulo, $contenido, $rutaImagen, $fechaPublicacion);
            
                echo "<p>{$resultado}</p>";
                echo "<p>Redirigiendo a la pagina de noticias 3s</p>";
                header("refresh:3;url=index.php");
            } else {
                echo "<p>Error: No se han enviado todos los campos de la noticia para crearla. REDIRIGIENTO EN 3s.</p>";
                header("refresh:3;url=index.php");
            }
        ?>

    </main>
    
</body>
</html>