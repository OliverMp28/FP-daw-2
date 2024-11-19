<?php
    require_once "./config/config.php";
    require_once "./config/funciones.php";

    $conexion = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
    if (!$conexion) { 
        echo "Error en la conexión"; 
        die();
    } 
 
    // $consulta->close();
    // $conexion->close();


    //aca llamo a los archivos para las funciones necesarias
    require_once "./funciones/funcionesNoticias.php";
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <title>Depor, tu club deportivo</title>
    <style>

    </style>
</head>
<body>
    <?php
        $nivel = 0;
        require_once "./requires/cabecera.php";
    ?>

    <main>
        <section class="seccion_ultimas_noticias">
            <h2>Ultimas noticias</h2>
            
            <a class="boton_estilizado" href="./noticias/index.php">Ver todas las noticias</a>
            <div class="contenedor_noticias">
                <?php
                    $ultimasNoticias = obtenerUltimasNoticias($conexion);
                    if($ultimasNoticias){
                        foreach($ultimasNoticias as $noticia){
                            echo '<div class="noticia">';
                            echo '<img src="'.$noticia['imagen'].'" alt="'.$noticia['titulo'].'">';
                            echo '<h3>'.$noticia['titulo'].'</h3>';
                            echo '<p>'.substr($noticia['contenido'], 0, 100).'...</p>';
                            echo '<a href="noticias/ver.php?id=' . $noticia['id'] . '">Leer más...</a>';
                            echo '</div>';
                        }
                    }else{
                        echo "No hay noticias disponibles";
                    }

                ?>
            </div>
        </section>

        <section class="seccion_servicios">
            <h2>Nuestros servicios</h2>
                <div class="contenedor_servicios">
                    <div class="servicio">
                        <div>
                            <h3>Título del servicio</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                        </div>
                        <img src="./assets/img/ejemplo1.jpg" alt="Servicio 1">
                    </div>

                    <div class="servicio">
                        <img src="./assets/img/ejemplo1.jpg" alt="Servicio 2">
                        <div>
                            <h3>Título del servicio</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                        </div>
                    </div>

                    <div class="servicio">
                        <div>
                            <h3>Título del servicio</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                        </div>
                        <img src="./assets/img/ejemplo1.jpg" alt="Servicio 3">
                    </div>
                </div>
        </section>

        <section class="seccion_unirse">
            <!--esta seccion sera como una llamada a la accion, no sera un formulario, 
                será una llamada a la accion para que si no eres socio que te unas ya que tendras beneficios,
                esto en el futuro tal vez va a redirigir a otra pagina apra registrarse como usuario, como mencioné antes, solo sera una llamada a la accion-->
            <h2>Unirse al bar casino "La ruina"</h2>
            <p>Si no eres socio, pero te gustaría participar de nuestro bar casino, te invitamos a unirte. Esto te permitirá obtener beneficios como:</p>
            <ul>
                <li>Acceso a juegos exclusivos</li>
                <li>Descuentos en nuestros productos y servicios</li>
                <li>Recibir noticias de nuestro bar casino</li>
                <li>También podrás participar en nuestros eventos y actividades</li>
            </ul>
            <a href="#">Unirse al bar casino "La ruina"</a>



        </section>

        <section class="seccion_testimonios">
            <h2>Testimonios</h2>
            <div class="contenedor_testimonios">
                <div class="testimonio">
                    <img src="./assets/img/ejemplo1.jpg" alt="Testimonio 1">
                    <h3>Nombre del cliente</h3>
                    <div class="estrellas"> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                </div>
                <div class="testimonio">
                    <img src="./assets/img/ejemplo1.jpg" alt="Testimonio 2">
                    <h3>Nombre del cliente</h3>
                    <div class="estrellas"> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                </div>
                <div class="testimonio">
                    <img src="./assets/img/ejemplo1.jpg" alt="Testimonio 3">
                    <h3>Nombre del cliente</h3>
                    <div class="estrellas"> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                </div>
                <div class="testimonio">
                    <img src="./assets/img/ejemplo1.jpg" alt="Testimonio 4">
                    <h3>Nombre del cliente</h3>
                    <div class="estrellas"> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                        <span class="estrella">&#9733;</span> 
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                </div>
            </div>
        </section>

        <section class="seccion_contacto">
            <h2>Contacto</h2>
            <p>
                <strong>Casino "La Ruina"</strong><br>
                Calle 123, 456, CABA<br>
                Teléfono: 1234567890<br>
                Email:  <a href="mailto:contacto@clubdemesa.com">contacto@clubdemesa.com</a><br>
                Horario de atención: Lunes a viernes de 10:00 a 22:00 hs.
            </p>
        </section>

        <!-- <aside>
            <h3>secciones</h3>
            <ul>
                <li><a href="#">Ultimas noticias</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Noticia 3</a></li>
                <li><a href="#">Noticia 4</a></li>
            </ul>
            <h3>Contacto</h3>
            <p>
        </aside> -->
    </main>

    <?php
        include('requires/footer.php');
    ?>
</body>
</html>
