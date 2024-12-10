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
    <title>Noticia Completa</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Noticia";
        require_once "../requires/cabecera.php"
    ?>
    <main>
        <section class="noticia_completa container py-5">
            <a href="index.php" class="btn btn-secondary mt-4 mb-3">Volver a la página de noticias</a>


            <div class="row">
            <?php

                if($_GET['id']){
                    $id_noticia = $_GET['id'];
                    $noticia = obtenerNoticiaPorId($conexion, $id_noticia);
                    if($noticia){
                        echo " <div class='col-12 mb-4'>";
                        echo "<img src='../$noticia[imagen]' alt='Noticia' class='img-fluid rounded'>";
                        echo "</div>";

                        echo "<div class='col-12'>";
                        echo "<h2 class='mb-3'>{$noticia['titulo']}</h2>";
                        echo "<p class='mb-4'> {$noticia['contenido']}</p>";
                        echo "<div class='referencia_autor text-end'>";
                            echo "<p class='mb-1'>Por Oliver</p>";
                            echo "<p class='mb-1'>Publicado el: " . date('d \d\e F \d\e Y', strtotime($noticia['fecha_publicacion'])). "</p>";
                            echo "<p class='mb-1'>Fuente: Depor</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                    else{
                        echo "<p>No se ha encontrado la noticia con el id ". $id_noticia. "</p>";
                        header("refresh:3;url=index.php");
                    }
                }else{
                    echo "<p>No se ha seleccionado ninguna noticia</p>";
                    header("refresh:3;url=index.php");
                }
            ?>

            </div>
        </section>
    </main>
    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>