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


            <!-- <img src="../img/ejemplo1.jpg" alt="Noticia">
            <div>
                <h2>Título de la noticia</h2>
                <p>En un sorprendente giro de los acontecimientos, se ha descubierto que un fenómeno inesperado ha capturado la atención de la comunidad científica. Este hallazgo, que desafía las teorías actuales, ha sido objeto de numerosos debates y discusiones en conferencias internacionales. Los investigadores han estado trabajando incansablemente para desentrañar los misterios que rodean este descubrimiento, y los resultados preliminares son prometedores.</p>
                <p>Además, se ha observado que las implicaciones de este hallazgo podrían extenderse más allá del ámbito científico. Las industrias están comenzando a tomar nota de las posibles aplicaciones prácticas, y algunas empresas ya están invirtiendo en investigaciones adicionales para explorar cómo pueden integrar este descubrimiento en sus productos y servicios. Esto podría dar lugar a una nueva ola de innovación y desarrollo en el sector privado.</p>
                <p>Finalmente, se espera que en los próximos meses se realicen más estudios para confirmar los hallazgos iniciales y explorar nuevas áreas de investigación. Los científicos están optimistas sobre el futuro y creen que este descubrimiento podría marcar el comienzo de una nueva era en la ciencia. "Estamos solo en el comienzo de un viaje emocionante", concluyó el Dr. Pérez, invitando a la comunidad a unirse a este esfuerzo global.</p>
                <p>Para más información, visite nuestro sitio web o siga nuestras redes sociales, donde estaremos compartiendo actualizaciones y análisis detallados sobre este fascinante descubrimiento. No se pierda la oportunidad de ser parte de esta emocionante aventura científica.</p>
            
                <div class="referencia_autor">
                    <p>Autor: Dr. Pérez</p>
                    <p>Fecha de publicación: 2022-01-25</p>
                    <p>Fuente: El Escritorio</p>
                </div>
            </div> -->
            </div>
        </section>
    </main>
    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>