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
    require_once "./funciones/funcionesTestimonios.php";
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

        <section class="seccion_testimonios  py-5 bg-light">
            <!-- <h2>Testimonios</h2>

            <div class="contenedor_testimonio_aleatorio">
              
                <div class="testimonio">
                    <img src="./assets/img/ejemplo1.jpg" alt="Testimonio x">
                    <h3>Nombre del cliente</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel ipsum vel dui scelerisque ultricies.</p>
                </div>
            </div> -->

            <?php
                $testimonioAleatorio = getTestimoniosAleatorios($conexion, 1);

                //como getTestimoniosAleatorios() me devuelve un array de array
                // tomo el primer valor con [0], pues solo me da 1 testimonio aleatorio
                echo '<div class="container contenedor_testimonios">';

                echo '<h2 class="text-center mb-4">Testimonios</h2>';
                echo '<div class="contenedor_testimonio_aleatorio mx-auto p-4 bg-white shadow rounded">';
                    echo '<div class="text-center mb-3">';
                    echo '<i class="bi bi-chat-left-quote fs-1 text-primary"></i>';
                    echo '</div>';
                    echo '<div class="testimonio text-center">';
                    //echo '<img src="'.$testimonioAleatorio[0]['imagen'].'" class="rounded-circle mx-auto d-block mb-3" style="width: 120px; height: 120px;">';
                    echo '<h3 class="fs-4 fw-bold text-dark">'.$testimonioAleatorio[0]['autor'].'</h3>';
                    echo '<p class="text-muted fs-5">'.$testimonioAleatorio[0]['contenido'].'</p>';
                    echo '</div>';
                echo '</div>';

                echo '</div>';
            ?>

<!-- 

            <div class="contenedor_testimonios_carrusel">

            </div>


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
            </div> -->

            <div class="container contenedor_testimonios_carrusel mt-5">
                <div id="testimoniosCarrusel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicadores -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Testimonio 1"></button>
                        <button type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide-to="1" aria-label="Testimonio 2"></button>
                        <button type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide-to="2" aria-label="Testimonio 3"></button>
                    </div>

                    <!-- Contenido del carrusel -->

                    <div class="carousel-inner"></div>
                    <?php
                        $listaTestimoniosAl = getTestimoniosAleatorios($conexion, 0);

                        foreach ($listaTestimoniosAl as $testimonioAl) {
                            echo '<div class="carousel-item">';  //PONER ACTIVE
                            echo '<div class="testimonio">';
                            echo '<i class="bi bi-chat-quote-fill"></i>';
                            echo '<h3>'.$testimonioAl['autor'].'</h3>';
                            echo '<p>'.$testimonioAl['contenido'].'</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
               

                    <!-- Controles de navegación -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
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

        <!-- <section class="seccion_testimonios">
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
        </section> -->

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
