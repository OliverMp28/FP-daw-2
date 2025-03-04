<?php
    require_once "./config/init.php";  //Inicia la sesinn, carga config y conecta a la BD

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
        $titulo = "Inicio";
        require_once "./requires/cabecera.php";
    ?>

    <main>
        <section class="seccion_ultimas_noticias">
            <h2>Ultimas noticias</h2>
            
            <?php if ($ADMIN || $SOCIO) { ?>
                <a class="boton_estilizado" href="./noticias/index.php">Ver todas las noticias</a>
            <?php } ?>

            <div class="contenedor_noticias">
                <?php
                    $ultimasNoticias = obtenerUltimasNoticias($conexion);
                    if($ultimasNoticias){
                        foreach($ultimasNoticias as $noticia){
                            echo '<div class="noticia transition">';
                            echo '<img src="'.$noticia['imagen'].'" 
                                alt="'.$noticia['titulo'].'" 
                                class="noticia-imagen">';
                            echo '<h3>'.$noticia['titulo'].'</h3>';
                            echo '<p>'.substr($noticia['contenido'], 0, 100).'...</p>';
                            echo '<a href="noticias/ver.php?id='.$noticia['id'].'" 
                                class="noticia-enlace">
                                    Leer más <i class="bi bi-arrow-right"></i>
                                </a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center py-4 text-muted">No hay noticias disponibles</p>';
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

            <div class="container contenedor_testimonios">
                <h2 class="text-center mb-4">Testimonios</h2>
                <?php
                    $testimonioAleatorio = getTestimoniosAleatorios($conexion, 1);

                    //como getTestimoniosAleatorios() me devuelve un array de array
                    // tomo el primer valor con [0], pues solo me da 1 testimonio aleatorio

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

                ?>
            </div>

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

            <!-- Carrusel de testimonios NO LO ESTOY MOSTRANDO-->
            <?php if (!true) { ?>
                <div class="container contenedor_testimonios_carrusel mt-5">
                    <div id="testimoniosCarrusel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php
                            $listaTestimoniosAl = getTestimoniosAleatorios($conexion, 0);

                            //este bucle es para los botones indicativos del carrusel, coloca "active" al primero
                            foreach ($listaTestimoniosAl as $index => $testimonioAl) {
                                $activeClass = ($index === 0) ? 'active' : ''; 
                                echo '<button type="button" data-bs-target="#testimoniosCarrusel" data-bs-slide-to="' . $index . '" class="' . $activeClass . '" aria-label="Testimonio ' . ($index + 1) . '"></button>';
                            }
                            ?>
                        </div>

                        <div class="carousel-inner">
                            <?php
                            foreach ($listaTestimoniosAl as $index => $testimonioAl) {
                                $activeClass = ($index === 0) ? 'active' : ''; // La clase active solo para el primer item
                                echo '<div class="carousel-item ' . $activeClass . '">';
                                echo '<div class="testimonio">';
                                echo '<i class="bi bi-chat-quote-fill"></i>';
                                echo '<h3>' . $testimonioAl['autor'] . '</h3>'; // Evita inyección de código
                                echo '<p>' . $testimonioAl['contenido'] . '</p>'; // Evita inyección de código
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
            <?php } ?>
            





        </section>

        <!-- <section class="seccion_servicios">
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
        </section> -->

        <section class="seccion_contacto py-5 bg-light text-center">
            <div class="container">
                <h2 class="text-primary mb-4">Contacto</h2>
                <p class="lead">Tienes dudas o consultas? Contáctanos y con gusto te ayudaremos.</p>
                <div class="card  p-4 border-0">
                    <h4 class="text-dark"><strong>Club Deportivo Depor</strong></h4>
                    <p class="mb-1"><i class="bi bi-geo-alt-fill text-primary"></i> Dirección: Dirección: Calle asequia del zute, Granada, España</p>
                    <p class="mb-1"><i class="bi bi-telephone-fill text-primary"></i> Teléfono: +34 999999999</p>
                    <p class="mb-1">
                        <i class="bi bi-envelope-fill text-primary"></i>  
                        Email: <a href="mailto:contacto@deporclub.com" class="text-decoration-none">contacto@clubdeportivo.com</a>
                    </p>
                    <p><i class="bi bi-clock-fill text-primary"></i> Horario: Lunes a viernes de 9:00 a 20:00 hs</p>
                </div>
            </div>
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
