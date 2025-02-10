<?php
   require_once "../config/init.php";

    //aca llamo a los archivos para las funciones necesarias
    require_once "../funciones/funcionesServicios.php";
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
    <title>Servicios</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Servicios";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_servicios">
        <a href="agregar.php" class="btn btn-primary mb-4">Crear un nuevo Servicio</a>

        <!-- <h1 class="text-center mb-4">Listado de Servicios</h1> -->

        <!-- Este miniformulario sera usado para la busqueda de servicios por nombre -->
        <form method="GET" action="" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-8">
                    <label for="buscar" class="form-label">Buscar servicio:</label>
                    <input 
                        type="text" 
                        name="buscar" 
                        id="buscar" 
                        class="form-control" 
                        placeholder="Buscar por nombre" 
                        value="<?php  isset($_GET['buscar']) ? $_GET['buscar'] : '' ?>"
                    />
                </div>
                <div class="col-12 col-md-4 mt-auto">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        
        <div class="contenedor_servicios_acordeon my-4">
            <h2 class="text-center mb-4">Servicios (en Acordeon)</h2>

            <div class="accordion" id="serviciosAccordion">


                <?php
                $terminoBusqueda = isset($_GET['buscar']) ? $_GET['buscar'] : null;
     
                 // Obtener la lista de servicios si es que se hizo una busqueda
                if ($terminoBusqueda) {
                    $servicios = getServiciosConBusqueda($conexion, $terminoBusqueda);
                } else {
                    $servicios = getServicios($conexion);
                }
     
                if ($terminoBusqueda) {
                    echo "<p class='text-muted'>Resultados para: <strong>" . $terminoBusqueda ."</strong></p>";
                }

                if(count($servicios) > 0){
                    //en algunas partes uso el id para usarlo en el heading y collapse ya que bootstrap los necesita para q funcione el acordeon
                    foreach ($servicios as $servicio):?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $servicio['id']?>">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse<?php echo $servicio['id']?>"
                                    aria-expanded="false"
                                    aria-controls="collapse<?php echo $servicio['id']?>"> Servicio: <?php echo $servicio['descripcion']?>
                                </button>
                            </h2>
                            <div id="collapse<?php echo $servicio['id']?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $servicio['id']?>" data-bs-parent="#serviciosAccordion">
                                <div class="accordion-body">
                                    <p><strong>Descripción:</strong> <?php echo $servicio['descripcion']?></p>
                                    <p><strong>Duración:</strong> <?php echo $servicio['duracion']?> minutos</p>
                                    <p><strong>Precio:</strong> $<?php echo $servicio['precio']?></p>
                                
                                    <!-- Botón para ver más detalles del servicio -->
                                    <div class="text-end mt-3">
                                        <a href="editar.php?id=<?php echo $servicio['id']?>" class="btn btn-primary btn-sm">Ver más detalles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                }else {
                    echo "<p class='text-danger'>No se encontraron resultados.</p>";
                }

            ?>
            <!-- Servicio 1
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse1"
                        aria-expanded="true"
                        aria-controls="collapse1">
                        Servicio: Entrenamiento Personalizado
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#serviciosAccordion">
                    <div class="accordion-body">
                        <p><strong>Descripción:</strong> Entrenamiento diseñado para alcanzar tus objetivos físicos.</p>
                        <p><strong>Duración:</strong> 60 minutos</p>
                        <p><strong>Precio:</strong> $40</p>
                    </div>
                </div>
            </div> -->

            </div>
        </div>
    </section>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>