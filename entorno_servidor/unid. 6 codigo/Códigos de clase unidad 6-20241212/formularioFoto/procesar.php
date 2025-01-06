<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre=$_FILES["foto"]["name"];
        $tipo=$_FILES["foto"]["type"];
        $tamaño=$_FILES["foto"]["size"];
        $temp=$_FILES["foto"]["tmp_name"];

        echo "Datos archivo:<br>
              Nombre:$nombre<br>
              Tipo:$tipo<br>
              Tamaño:$tamaño<br>
              Nombre temporal:$temp<br>  
             ";

        if(str_contains($tipo,"image")){  //($tipo=="image/jpeg"){
            
            if(!file_exists("./imagenes")){
                mkdir("./imagenes");
            }
            $ruta="./imagenes/$nombre";

            if(file_exists($ruta)){
                echo "<h1>¡Ese nombre de archivo ya existe¡</h1>";
            }else{
                move_uploaded_file($temp,$ruta);
                echo "<h1>Imagen subida con éxito</h1>";
                echo "<img width='20%' src=$ruta>";
            }
        }else{
            echo "<h1>No es un archivo de imagen";
        }
        header("refresh:5;url=formularioFoto.html");
    ?>

    <h3><a href='formularioFoto.html'>Volver</a></h3>  

</body>
</html>