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
    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Agregar un nuevo socio</title>
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Agregar un nuevo socio";
        require_once "../requires/cabecera.php"
    ?>

    <main>
        <?php
        // Verificar si es una actualizacion(modificacion) o una creacion de un socio comprobando si llego una id
        if (isset($_POST['idSocio'])) {
            $idSocio = intval($_POST['idSocio']);
            $nombre = trim($_POST['nombreSocio']);
            $edad = intval($_POST['edadSocio']);
            $usuario = trim($_POST['usuarioSocio']);
            $password = trim($_POST['passwordSocio']);
            $telefono = trim($_POST['telefonoSocio']);


            if (isset($_FILES['fotoSocio']) && strlen($_FILES['fotoSocio']['name']) > 0) {
                $foto = $_FILES['fotoSocio'];
                $directorioDestino = 'assets/img/';
                $nombreFoto = basename($foto['name']);
                $rutaFoto = $directorioDestino . time() . "_" . $nombreFoto;
            
                if (!move_uploaded_file($foto['tmp_name'], "../" . $rutaFoto)) {
                    die("Error: No se pudo mover la foto a la carpeta especificada.");
                }
            } else {
                // Si no se subio una nueva foto, mantener la existente, enviaremos null
                $rutaFoto = null;
            }
            

            $resultado = modificarSocioPorId($conexion, $idSocio, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto);

            if ($resultado) {
                echo "<p>Datos del socio actualizados exitosamente.</p>";
            } else {
                echo "<p>Error: No se pudieron actualizar los datos del socio. Verifica los datos ingresados.</p>";
            }
        } 
        
        elseif (isset($_POST['nombreSocio'], $_POST['edadSocio'], $_POST['usuarioSocio'], $_POST['passwordSocio'], $_POST['telefonoSocio'], $_FILES['fotoSocio'])) {
            // Crear nuevo socio
            $nombre = trim($_POST['nombreSocio']);
            $edad = intval($_POST['edadSocio']);
            $usuario = trim($_POST['usuarioSocio']);
            $password = trim($_POST['passwordSocio']);
            $telefono = trim($_POST['telefonoSocio']);

            $foto = $_FILES['fotoSocio'];
            $directorioDestino = 'assets/img/';
            $nombreFoto = basename($foto['name']);
            $rutaFoto = $directorioDestino . time() . "_" . $nombreFoto;

            if (!move_uploaded_file($foto['tmp_name'], "../" . $rutaFoto)) {
                die("Error: No se pudo mover la foto a la carpeta especificada.");
            }

            $resultado = crearSocio($conexion, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto);

            if ($resultado) {
                echo "<p>Socio registrado exitosamente.</p>";
            } else {
                echo "<p>Error: No se pudo registrar el socio. Verifica los datos ingresados.</p>";
            }
        } else {
            echo "<p>Error: Faltan datos necesarios. Redirigiendo en 4 segundos...</p>";
            header("refresh:4;url=index.php");
        }

        echo "<p>Redirigiendo a la pagina principal en 4 segundos...</p>";
        header("refresh:4;url=index.php");
        ?>
    </main>


    <?php
        include('../requires/footer.php');
    ?>
    
</body>
</html>