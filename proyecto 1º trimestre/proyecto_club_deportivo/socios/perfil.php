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
        $titulo = "Perfil de socio";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_socios">
        <a href="index.php" class="btn btn-primary mb-4">Volver a la pagina de socios</a>



        <?php
        // Verificar si se pasa un ID válido en el GET
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $socio = getSocioPorId($conexion, $id);
            $password = getContrasenaPorId($conexion, $id);

            if ($socio) {
                //si todo ha ido bien, muestro el perfil del socio con form para que permita modificar sus datos
                echo '<h1 class="text-center mb-4">Soy '. $socio['nombre'] .'</h1>';
                
                echo '
                <div class="perfil shadow p-4 rounded bg-white mx-auto" style="max-width: 700px;">
                    <form id="formularioSocio" action="procesar.php" method="post" enctype="multipart/form-data">
                      
                    <!--ID del socio oculto) -->
                    <input type="hidden" name="idSocio" value="' . $socio['id'] . '">
                    
                    <!-- Foto-->
                        <div class="text-center mb-4">
                            <img src="../' . $socio['foto'] . '"
                                alt="Foto de ' . $socio['nombre'] . '"
                                class="rounded-circle border border-3"
                                style="width: 150px; height: 150px; object-fit: cover;"
                            />
                            <div class="mt-3">
                                <label for="fotoSocio" class="form-label">Cambiar foto de perfil</label>
                                <input 
                                    type="file" 
                                    class="form-control" 
                                    id="fotoSocio" 
                                    name="fotoSocio" 
                                />
                                <span class="error"></span>
                            </div>
                        </div>

                        <div class="row gy-3">
                            <!-- Nombre -->
                            <div class="col-12">
                                <label for="nombreSocio" class="form-label text-muted"><strong>Nombre:</strong></label>
                                <input
                                    type="text"
                                    class="form-control  border-0 bg-light rounded"
                                    id="nombreSocio"
                                    name="nombreSocio"
                                    value="' . $socio['nombre'] . '"
                                    placeholder="Introduce el nombre del socio"
                                />
                                <span class="error"></span>
                            </div>

                            <!-- Edad -->
                            <div class="col-md-6">
                                <label for="edadSocio" class="form-label text-muted"><strong>Edad:</strong></label>
                                <input
                                    type="number"
                                    class="form-control  border-0 bg-light rounded"
                                    id="edadSocio"
                                    name="edadSocio"
                                    value="' . $socio['edad'] . '"
                                    placeholder="Introduce la edad del socio"
                                />
                                <span class="error"></span>
                            </div>

                            <!-- Usuario -->
                            <div class="col-md-6">
                                <label for="usuarioSocio" class="form-label text-muted"><strong>Usuario:</strong></label>
                                <input
                                    type="text"
                                    class="form-control  border-0 bg-light rounded"
                                    id="usuarioSocio"
                                    name="usuarioSocio"
                                    value="' . $socio['usuario'] . '"
                                    placeholder="Introduce el nombre de usuario"
                                />
                                <span class="error"></span>
                            </div>

                            <!--telefono -->
                            <div class="col-12">
                                <label for="telefonoSocio" class="form-label text-muted"><strong>Telefono:</strong></label>
                                <input
                                    type="tel"
                                    class="form-control  border-0 bg-light rounded"
                                    id="telefonoSocio"
                                    name="telefonoSocio"
                                    value="' . $socio['telefono'] . '"
                                    placeholder="Introduce el número de teléfono"
                                />
                                <span class="error"></span>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mt-4">
                            <label for="passwordSocio" class="form-label text-muted"><strong>Contraseña:</strong></label>
                            <input 
                                type="text" 
                                class="form-control border-0 bg-light rounded" 
                                id="passwordSocio" 
                                name="passwordSocio" 
                                value="' . $password . '" />
                        </div>    

                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
                        </div>
                    </form>
                </div>';

            } else {
                echo '<p>No se encontró el socio con ID: ' . $id . '</p>';
            }
        } else {
            echo '<p>ID de socio no valida o no proporcionada.</p>';
        }
        ?>

    </section>
    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>