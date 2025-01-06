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
    <script src="../assets/js/sociosValidaciones.js" defer></script>

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar nuevo socio</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar un nuevo socio";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_socios">
        <a href="index.php" class="btn btn-primary mb-4">Volver a la pagina de socios</a>

        <form id="formularioSocio" action="procesar.php" method="post" enctype="multipart/form-data" class="shadow p-4 rounded bg-white mx-auto" style="max-width: 600px;">
            <h2 class="text-center mb-4">Registrar Nuevo Socio</h2>

            <div class="mb-3">
                <label for="nombreSocio" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    id="nombreSocio"
                    name="nombreSocio"
                    placeholder="Introduce el nombre completo del socio"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="edadSocio" class="form-label">Edad:</label>
                <input
                    type="number"
                    class="form-control"
                    id="edadSocio"
                    name="edadSocio"
                    placeholder="Introduce la edad del socio"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="usuarioSocio" class="form-label">Usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    id="usuarioSocio"
                    name="usuarioSocio"
                    placeholder="Introduce un nombre de usuario único"
                    autocomplete="username"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="passwordSocio" class="form-label">Contraseña:</label>
                <input
                    type="password"
                    class="form-control"
                    id="passwordSocio"
                    name="passwordSocio"
                    placeholder="Introduce una contraseña segura"
                    autocomplete="current-password"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="telefonoSocio" class="form-label">Teléfono:</label>
                <input
                    type="tel"
                    class="form-control"
                    id="telefonoSocio"
                    name="telefonoSocio"
                    placeholder="Introduce el número de teléfono"
                />
                <span class="error"></span>
            </div>

            <div class="mb-3">
                <label for="fotoSocio" class="form-label">Foto:</label>
                <input
                    type="file"
                    class="form-control"
                    id="fotoSocio"
                    name="fotoSocio"
                />
                <span class="error"></span>
            </div>

            <button type="submit" class="btn btn-success w-100">Registrar Socio</button>
        </form>




    </section>
    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>