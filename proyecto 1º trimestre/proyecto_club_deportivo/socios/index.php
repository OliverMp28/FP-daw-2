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
    require_once "../funciones/funcionesSocios.php";
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
    <title>Socios</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Socios";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_socios">
        <a href="agregar.php" class="btn btn-primary mb-4">Agregar un nuevo socio</a>

        <h1 class="text-center mb-4">Listado de Socios</h1>

        <!-- Este miniformulario sera usado para la busqueda de socios por nombre o telefono -->
        <form method="GET" action="" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-8">
                    <label for="buscar" class="form-label">Buscar socio:</label>
                    <input 
                        type="text" 
                        name="buscar" 
                        id="buscar" 
                        class="form-control" 
                        placeholder="Buscar por nombre o telefono" 
                        value="<?= isset($_GET['buscar']) ? $_GET['buscar'] : '' ?>"
                    />
                </div>
                <div class="col-12 col-md-4 mt-auto">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>


        <div class="contenedor_socios row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php 
            $terminoBusqueda = isset($_GET['buscar']) ? $_GET['buscar'] : null;

            // Obtener la lista de socios
            if ($terminoBusqueda) {
                $socios = getSociosConBusqueda($conexion, $terminoBusqueda);
            } else {
                $socios = getSocios($conexion);
            }

            if ($terminoBusqueda) {
                echo "<p class='text-muted'>Resultados para: <strong>" . $terminoBusqueda ."</strong></p>";
            }

            if(count($socios) > 0){
                foreach ($socios as $socio) {
                    echo '
                    <div class="col">
                        <div class="card h-100 shadow">
                            <img src="../'. $socio['foto'] . '" class="card-img-top" alt="Foto de ' . $socio['nombre'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $socio['nombre'] . '</h5>
                                <p class="card-text">
                                    <strong>Edad:</strong> ' . $socio['edad'] . '<br>
                                    <strong>Usuario:</strong> ' . $socio['usuario'] . '<br>
                                    <strong>Teléfono:</strong> ' . $socio['telefono'] . '
                                </p>
                                <a href="perfil.php?id=' . $socio['id'] . '" class="btn btn-primary w-100 mt-2">Ver Perfil</a>
                            </div>
                        </div>
                    </div>';
                }
            }else {
                echo "<p class='text-danger'>No se encontraron resultados.</p>";
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