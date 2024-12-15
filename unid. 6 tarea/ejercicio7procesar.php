<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if (isset($_POST['usuario']) && isset($_FILES['archivos'])) {
        $usuario = $_POST['usuario'];
        $archivos = $_FILES['archivos'];
        $carpetaGeneral = './usuarios';

        if (!is_dir($carpetaGeneral)) {
            mkdir($carpetaGeneral);
        }

        $carpetaUsuario = $carpetaGeneral . '/' .$usuario;
        if (!is_dir($carpetaUsuario)) {
            mkdir($carpetaUsuario);
        }

        $mensajes = [];
        for ($i = 0; $i < count($archivos['name']); $i++) {
            $nombreArchivo = $archivos['name'][$i];
            $rutaTemporal = $archivos['tmp_name'][$i];

            if ($rutaTemporal) {
                $rutaDestino = $carpetaUsuario . '/' . $nombreArchivo;

                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    $mensajes[] = "El archivo '$nombreArchivo' ha sido subido correctamente";
                } else {
                    $mensajes[] = "Error, No se pudo subir el archivo '$nombreArchivo'";
                }
            } else {
                $mensajes[] = "Error, No se recibio un archivo valido";
            }
        }

        $mensaje = implode('<br> ', $mensajes);

        echo "Se han procesado sus datos correectamente";
        header("Refresh: 3; url=ejercicio7.php?mensaje=" . $mensaje);
    } else {
        echo "No se enviaron datos validos a procesar";
        $mensaje = "Error: No se enviaron datos validos";
        header("Refresh: 3; url=ejercicio7.php?mensaje=" . $mensaje);
    }
?>

</body>
</html>