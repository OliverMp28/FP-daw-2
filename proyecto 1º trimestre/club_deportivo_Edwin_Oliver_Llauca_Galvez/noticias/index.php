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
    <title>Noticias</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Noticias";
        require_once "../requires/cabecera.php"
    ?>


    <main>
        <section class="container py-4 seccion_noticias">

            <a href="agregar.php" class="btn btn-primary mb-4">Crear una nueva noticia</a>

            <?php
                $xNoticiasPorPagina = 4;

               // $paginaActual =  ? (int)$_GET['pagina'] : 1;

                if(isset($_GET['pagina'])){
                    $paginaActual =(int)$_GET['pagina'];
                }else{
                    $paginaActual = 1;
                }
                
                $totalNoticias = totalNoticias($conexion);
                $totalPaginas = (int)($totalNoticias / $xNoticiasPorPagina);

                if ($totalNoticias % $xNoticiasPorPagina > 0) {
                    // Añade una pagina si hay un resto
                    $totalPaginas++; 
                }
                
                $noticias = obtenerNoticiasPaginadas($conexion, $paginaActual, $xNoticiasPorPagina);
                
                foreach ($noticias as $noticia) {
                    echo '<div class="noticia card mb-4 shadow-sm">';
                    echo '<div class="row g-0">';
                    
                        echo "<div class='noticia-img col-md-4'>";
                        echo "<img src='../{$noticia['imagen']}' class='img-fluid rounded-start' alt='Noticia'>";
                        echo "</div>";

                        echo '<div class="noticia-contenido col-md-8">'; 
                        echo '<div class="card-body">';
                            echo "<h5 class='card-title'>{$noticia['titulo']}</h5>";
                            echo "<p class='card-text'>" . substr($noticia['contenido'], 0, 100) . "...</p>";//muestro los primeros 100 caracteres
                            echo "<p class='fecha text-muted'>Publicada el " . date('d \d\e F \d\e Y', strtotime($noticia['fecha_publicacion'])) . "</p>";
                            echo "<p class='autor text-muted'>Por Autor</p>";
                            echo '<a href="ver.php?id=' . $noticia['id'] . '"  class="btn btn-link">Leer más...</a>';
                        echo '</div>';
                        echo '</div>';

                    echo '</div>';
                    echo '</div>';
                }
                

                //navegacion
                echo '<div class="d-flex justify-content-between mt-4">';
                if ($paginaActual > 1) {
                    echo '<a href="?pagina=' . ($paginaActual - 1) . '" class="btn btn-secondary">Anterior</a> ';
                }
                if ($paginaActual < $totalPaginas) {
                    echo '<a href="?pagina=' . ($paginaActual + 1) . '" class="btn btn-secondary">Siguiente</a>';
                }
                echo '</div>';
            
            ?>

            <!-- <div class="noticia">
                <img src="../assets/img/fondo1.avif" alt="Noticia 1">
                <div>
                    <h2>Título de la noticia</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>

                    <p class="fecha">Publicada el 15 de octubre de 2021</p>
                    <p class="autor">Por Autor</p>

                    <a href="ver.php">Leer más...</a>
                </div>  
            </div>

            <div class="noticia">
                <img src="../assets/img/fondo1.avif" alt="Noticia 2">
                <div>
                    <h2>Título de la noticia</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                    
                    <p class="fecha">Publicada el 15 de octubre de 2021</p>
                    <p class="autor">Por Autor</p>
                    
                    <a href="./noticiaCompleta.html">Leer más...</a>
                </div>
            </div> -->
            
        </section>
    </main>
    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>