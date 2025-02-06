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
    require_once "../funciones/funcionesAcceder.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Acceder</title>

    <style>
        main {
            background: url('../assets/img/portada2.avif') no-repeat center center fixed;
            background-size: cover;
        }
        .contenedor-formulario {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <?php
        $nivel = 1;
        require_once "../requires/menu.php"
    ?>

    <main>
        <?php
            if (isset($_POST['usuario'], $_POST['password'], $_POST['tipo_usuario'])) {

                $usuario     = trim($_POST['usuario']);
                $password    = $_POST['password'];
                $tipo_usuario = trim($_POST['tipo_usuario']);

                //Usamos la funcion para verificar las credenciales
                $socio = verificarCredenciales($conexion, $usuario, $tipo_usuario, $password);

                if ($socio !== null) {
                    session_start();
                    $_SESSION['id'] = $socio['id'];
                    $_SESSION['usuario'] = $socio['usuario'];
                    $_SESSION['tipo_usuario'] = $tipo_usuario;

                    echo "<p>Acceso correcto. Redirigiendo...</p>";
                    header("refresh:3;url=../index.php");
                    exit;
                } else {
                    echo "<p>Error: Usuario no encontrado o contraseña incorrecta. Redirigiendo en 4s...</p>";
                    header("refresh:4;url=index.php");
                }
            } else {
                echo "<p>Error: No se han enviado todos los campos requeridos. Redirigiendo en 4s...</p>";
                header("refresh:4;url=index.php");
            }

            echo "<p>Redirigiendo a la página de inicio en 4s...</p>";
            header("refresh:4;url=index.php");
        ?>
    </main>
    <?php
        include('../requires/footer.php');
    ?>
    
</body>
</html>