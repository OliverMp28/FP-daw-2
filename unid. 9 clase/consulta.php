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

        // $consultar = "SELECT * FROM Alumnos";

        // $resultado = $conexion->query($consultar);
        // echo "Hay $resultado->num_rows alumnos<br>";

        // // while($fila=$resultado->fetch_array()){
        // //     echo "$fila[0]<br>$fila[1]<br>$fila[2]<br><br>";
        // // }

        // while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
        //     $dni_alumno = $fila["dni"];
        //     $nombre_completo = $fila["nombre_completo"];
        //     $edad_alumno=$fila["edad"];
    

        //     echo "$dni_alumno<br>$nombre_completo<br>$edad_alumno<br><br>";
        // }

        $DNI_nuevo = "9999999l";
        $nombre_nuevo = "Juan Torres";
        $edad_nueva = 20;

        $insertar = "INSERT INTO Alumnos
                    VALUES ('$DNI_nuevo', '$nombre_nuevo', '$edad_nueva')";
                    echo $insertar . "<br>";

        $resultado = $conexion->query($insertar);

        if ($resultado){
            echo"sE HA INSERTADO UN NUEVO ALUMNO <br>";
        }else{
            echo "No se ha insertado un nuevo alumno, posiblemente ya existia";
        }

        $nuevo_nombre="Jaime Torres Molina";
        $actualizar = "UPDATE Alumnos
                        SET nombre_completo='$nuevo_nombre'
                        WHERE dni = '$DNI_nuevo'";

        $resultado=$conexion->query($actualizar);
        if($resultado){
            echo "Nombre corregido <br>";
            echo $conexion->affected_rows ."<br>";
        } else{
            echo "No se ha actualizado el alumno con DNI $DNI_nuevo";
        }


        //mostrar datos insertados
        $consultar = "SELECT * FROM Alumnos WHERE dni = '$DNI_nuevo'";
        $resultado = $conexion->query($consultar);
        while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
            $dni_alumno = $fila["dni"];
            $nombre_completo = $fila["nombre_completo"];
            $edad_alumno=$fila["edad"];
            echo "$dni_alumno<br>$nombre_completo<br>$edad_alumno<br><br>";
        }

        //===================
        $borrar="DELETE FROM Alumnos
                WHERE dni='$DNI_nuevo'";

        $resultado=$conexion->query($borrar);

        if($resultado){
            echo "Se ha borrado el alumno con DNI $DNI_nuevo";
        }else{
            echo "No se ha borrado el alumno con DNI $DNI_nuevo";
        }


        $conexion->close();
    ?>
</body>
</html>