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
    <script src="../assets/js/testimoniosValidaciones.js" defer></script>

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar testimonio nuevo</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar testimonio nueva";
        require_once "../requires/cabecera.php";
    ?>
    
    <main class="container mt-5 mb-5">
        <a href="index.php" class="btn btn-primary mb-3">Volver a la pagina de todos los Testimonios</a>

        <?php
            //Obtengo los socios para el formulario (id y nombre)
            $socios = getSociosDesplegable($conexion);
        ?>

        <form id="miFormulario" action="procesar.php" method="post" class="shadow p-4 rounded bg-white mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Danos tu Testimonio :D</h2>

            <div class="mb-3">
                <label for="autorTestimonio" class="form-label">Autor:</label>
                <select class="form-select" id="autorTestimonio" name="autorTestimonio">
                    <option value="0" selected class="text-muted">Seleccionar autor...</option>
                    <?php                        
                        foreach ($socios as $socio) {
                            echo '<option value="' . $socio['id'] . '">' . $socio['nombre'] . '</option>';
                        }
                    ?>
                </select>
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="contenidoTestimonio" class="form-label">Contenido:</label>
                <textarea
                    class="form-control"
                    id="contenidoTestimonio"
                    name="contenidoTestimonio"
                    placeholder="Escribe el contenido del testimonio"
                ></textarea>
                <span class="error"></span>
            </div>

            <button type="submit" class="btn btn-success w-100">Enviar</button>
        </form>

        <br>



        <form id="miFormulario" action="procesar.php" method="post" class="shadow p-4 rounded bg-white mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Danos tu Testimonio :D</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="autorTestimonio" class="form-label">Autor:</label>
                    <select class="form-select" id="autorTestimonio" name="autorTestimonio">
                    <option value="0" selected class="text-muted">Seleccionar autor...</option>
                    <?php                        
                        foreach ($socios as $socio) {
                            echo '<option value="' . $socio['id'] . '">' . $socio['nombre'] . '</option>';
                        }
                    ?>
                </select>
                    <span class="error"></span>
                </div>

                <div class="col-md-6">
                    <label for="contenidoTestimonio" class="form-label">Contenido:</label>
                    <textarea
                        class="form-control"
                        id="contenidoTestimonio"
                        name="contenidoTestimonio"
                        placeholder="contenido del testimonio"
                    ></textarea>
                    <span class="error"></span>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Enviar</button>
        </form>


    </main>

    <?php
        include('../requires/footer.php');
    ?>

</body>
</html>