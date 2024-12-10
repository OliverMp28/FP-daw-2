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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Testimonios</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Testimonios";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_testimonios">
        <a href="agregar.php" class="btn btn-primary mb-4">Crear una nuevo testimonio</a>

        <?php
            //Determinar el orden para los testimonios
            //aqui compruebo con isser si tengo  'orden' mediante GET o si es que vale 1
            //dependiendo de ello le doy valor 1 o 0
            $orden = isset($_GET['orden']) && $_GET['orden'] == '1' ? 1 : 0;
            $testimonios = getTestimoniosOrdenados($conexion, $orden);
        ?>

        <div class="contenedor_testimonios_ordenados p-4 bg-white rounded shadow-sm">
            <!-- Formulario para seleccionar el orden de los testimonios, se muestra como lista seleccionable -->
            <form method="GET" action="" class="mb-4 d-flex flex-column flex-sm-row align-items-sm-center gap-2">
                <label for="orden" class="fw-bold">Ordenar testimonios por:</label>
                <select name="orden" id="orden" class="form-select w-auto">
                    <option value="0" <?= ($orden == 0) ? 'selected' : '' ?> >Más antiguo a más reciente</option>
                    <option value="1" <?= ($orden == 1) ? 'selected' : '' ?> >Más reciente a más antiguo</option>
                </select>
                <button type="submit" class="btn btn-secondary">Ordenar</button>
            </form>


            <!-- Listado de testimonios -->
            <div class="list-group">
                <?php 
                foreach ($testimonios as $testimonio) {
                    echo '<div class="testimonio list-group-item flex-column align-items-start bg-light mb-3 p-3 rounded shadow-sm">';
                    echo '<p class="mb-1"><strong>' . $testimonio['autor'] . ':</strong></p>';
                    echo '<p class="mb-1">' . $testimonio['contenido'] . '</p>';
                    echo '<p class="text-muted"><em>Publicado el: ' . $testimonio['fecha'] . '</em></p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="contenedor_testimonios_acordeon my-4">
            <h2 class="text-center mb-4">Testimonios (Acordeón)</h2>
            <div class="accordion accordion-flush mx-auto" id="accordionTestimonios">
                <?php
                //aqui por defecto obtengo los testimonios en orden 1 Orden descendente (de mas reciente a mas antiguo).
                $testimoniosAcordeon = getTestimoniosOrdenados($conexion, 1);

                foreach ($testimoniosAcordeon as $index => $testimonio) {
                    /*Aqui genero un ID unico para cada elemento y encabezado, con heading y collapse
                    * pues en bootstrap es necesario que sean diferentes para que el funcionamiento del acordeon no falle
                    */
                    $collapseId = 'collapse' . ($index + 1);
                    $headingId = 'heading' . ($index + 1);  
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="<?php echo $headingId; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="false" aria-controls="<?php echo $collapseId; ?>">
                                <?php echo $testimonio['autor'] . ' - Publicado el: ' . $testimonio['fecha']; ?>
                            </button>
                        </h2>
                        <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $headingId; ?>" data-bs-parent="#accordionTestimonios">
                            <div class="accordion-body">
                                <strong>Contenido:</strong> <?php echo $testimonio['contenido']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>