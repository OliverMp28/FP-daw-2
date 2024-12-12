<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Imagenes cargadas</h1>
    <?php
        if (isset($_FILES['imagenes'])) {
            $imagenes = $_FILES['imagenes'];
            $detallesImagenes = [];

            for ($i = 0; $i < count($imagenes['name']); $i++) {
                $nombre = $imagenes['name'][$i];
                $tipo = $imagenes['type'][$i];
                $tamaño = $imagenes['size'][$i];
                $temp = $imagenes['tmp_name'][$i];

                //aca creo la carpeta por si no esta creada, esta contendra las imagenes
                if ($tipo == "image/jpeg" || $tipo == "image/png") {
                    if (!file_exists("./imagenes")) {
                        mkdir("./imagenes");
                    }

                    $rutaDestino = "./imagenes/" . $nombre;
                    if (!file_exists($rutaDestino)) {
                        move_uploaded_file($temp, $rutaDestino);
                        $detallesImagenes[] = [
                        'nombre' => $nombre,
                        'ruta' => $rutaDestino,
                        'tamaño' => $tamaño
                        ];
                    } else {
                        echo "<p>el archivo " . $nombre . " ya existe.</p>";
                    }
                } else {
                    echo "<p>Error: el archivo " . $nombre . " no es una imagen valida.</p>";
                }
            }

            //reordeno por tamano
            usort($detallesImagenes, function ($a, $b) {
                return $b['tamaño'] <=> $a['tamaño'];
            });

            echo "<h2>Imágenes ordenadas por tamaño:</h2>";
            foreach ($detallesImagenes as $imagen) {
                echo "<p>{$imagen['nombre']}<br>";
                echo "Tamaño: {$imagen['tamaño']} bytes</p>";
                echo "<img src='{$imagen['ruta']}' alt='Imagen' style='max-width:300px;'><br><br>";
            }
        } else {
            echo "<p>No se subieron imagenes.</p>";
        }
	?>
</body>
</html>