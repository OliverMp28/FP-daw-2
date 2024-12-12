<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['dni'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];

        if (isset($_FILES['cv'])) {
            $archivo = $_FILES['cv'];
            $tipoArchivo = $archivo['type'];
            $tamañoArchivo = $archivo['size'];
            $rutaTemporal = $archivo['tmp_name'];

            if ($tipoArchivo !== 'application/pdf') {
                echo "Error: El archivo debe ser un PDF.";
                header("refresh:3; url=ejercicio6.html");
                exit;
            }

            if ($tamañoArchivo > 2 * 1024 * 1024) {
                echo "Error: El archivo supera los 2 MB.";
                header("refresh:3; url=ejercicio6.html");
                exit;
            }

            $carpetaCVs = './curriculums';
            if (!is_dir($carpetaCVs)) {
                mkdir($carpetaCVs);
            }

            $rutaDestino = $carpetaCVs . '/' . $dni .'.pdf';
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                echo "Registro completado con exito. Tu CV ha sido guardado. <br>";
                echo "El nombre del CV es: ". $dni. '.pdf <br>';
                echo "para " . $nombre . "  " . $apellido;
            } else {
                echo "Error al guardar el archivo intenta nuevamente.";
            }
        } else {
            echo "Error: No se subio ningún archivo";
            header("refresh:3; url=ejercicio6.html");
            exit;
        }
    } else {
        echo "Error: Acceso no válido.";
        header("refresh:3; url=ejercicio6.html");
        exit;
    }
    ?>

</body>
</html>