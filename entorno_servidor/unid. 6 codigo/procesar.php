<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="" alt="">
    
    <?php
        for($i = 0; $i < count($_FILES["foto"]["name"]); $i++){
            $nombre = $_FILES['foto']['name'][$i];
            $tipo = $_FILES['foto']['type'][$i];
            $tamaño = $_FILES['foto']['size'][$i];
            $temp = $_FILES['foto']['tmp_name'][$i];

            echo "Datos archivo: <br>"
            . "Nombre: ". $nombre. "<br>"
            . "Tipo: ". $tipo. "<br>"
            . "Tamaño: ". $tamaño. " bytes<br>"
            . "Ruta temporal: ". $temp . "<br>";

            if($tipo == "image/jpeg" || $tipo == "image/png"){
                if(!file_exists("./imagenes")){
                    mkdir("./imagenes");
                }
                $ruta = "./imagenes/".$nombre;
                if(file_exists($ruta)){
                    echo "Error: el archivo ya existe.";

                }else{
                    move_uploaded_file($temp, $ruta);

                    echo "Imagen subida correctamente a: ". $ruta . "<br>";
                    echo "<img src='". $ruta. "' alt='Imagen subida' width='400px'>";
                }
            }else{
                echo "Error: el archivo no es una imagen.";
            }
        }
     
        header("refresh: 3; url=formularioFoto.html");
    ?>
    <a href="formularioFoto.html">Volver</a>
</body>
</html>