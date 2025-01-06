<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 

        $asignatura="Ingles";
        $credito=3;

        

        $sql="INSERT INTO asignaturas (id_asignatura, nombre_asignatura, creditos)
            VALUES (NULL, '$asignatura','$credito')";

        $resultado=$conexion->query($sql);

        if($resultado){
            echo "Asignatura $resultado añadida correctamente";
        }else{
            echo "Error al añadir la asignatura: ". $conexion->error;
        }
        
    ?>
</body>
</html>