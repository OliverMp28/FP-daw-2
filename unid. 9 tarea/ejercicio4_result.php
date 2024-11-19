<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre = null;
        $creditos = null;
      
        $errores=[];

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['creditos'])) {
            $creditos = $_POST['creditos'];
        }
   
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 


        $sql="INSERT INTO Asignaturas (nombre_asignatura, creditos)
            VALUES ('$nombre','$creditos')";

        $resultado = $conexion->query($sql);

        if($resultado){
            echo "Asignatura añadida correctamente <br>";
            echo "nueva asignatura $nombre con creditos: $creditos";
        } else{
            echo "Error al añadir la asignatura: ". $conexion->error;
        }
    ?>
</body>
</html>