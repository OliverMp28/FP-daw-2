<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 9</h1>
    <h2>borrar asignatura</h2>
    
    <form action="" method="POST">
        <?php
            $conexion = new mysqli("localhost", "root", "", "centro");
            $conexion->set_charset("utf8"); 

            $html_select='';

            $consulta = "SELECT id_asignatura, nombre_asignatura FROM asignaturas";
            $resultado = $conexion->query($consulta);

            if($resultado){
                $html_select.="<label for='opcion_asignatura'>Seleccione la asignatura a borrar</label>";
                $html_select.='<select name="opcion_asignatura"  id="opcion_asignatura">';
                while($fila = $resultado->fetch_array(MYSQLI_ASSOC)){
                    $id_asignatura = $fila["id_asignatura"];
                    $nombre_asignatura = $fila["nombre_asignatura"];

                    $html_select.='<option value="'.$id_asignatura.'">'.$nombre_asignatura.'</option>';
                }
                $html_select.='</select>';
                echo $html_select;
            }else{
                echo "Error en consultar las asignaturas";
            }
        ?>
        <input type="submit" value="Borrar">
    </form>

    <?php
        $id_asignatura = null;
        if(isset($_POST['opcion_asignatura'])){
            $id_asignatura = $_POST['opcion_asignatura'];

            //borro las que estasn el la tabla amtriculas
            $sql_matriculas = "DELETE FROM Matriculas WHERE id_asignatura = $id_asignatura";
            $resultado = $conexion->query($sql_matriculas);

            if (!$resultado) {
                echo "Error al eliminar las matriculas: " . $conexion->error;
                $conexion->close();
                exit;
            }

            $sql_asignatura = "DELETE FROM Asignaturas WHERE id_asignatura = $id_asignatura";
            $resultado = $conexion->query($sql_asignatura);

            if (!$resultado) {
                echo "Error al eliminar la asignatura: " . $conexion->error;
                $conexion->close();
                exit;
            }

            echo "Asignatura borrada de la tabla asignatura y matricula exitosamente";
        }
    ?>

</body>
</html>