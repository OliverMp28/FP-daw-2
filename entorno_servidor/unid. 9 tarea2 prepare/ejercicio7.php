<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 7</h1>
    <h2>Mostrar alumnos que en un año estuvieron matriculados en una asignatura</h2>

    <form action="" method="POST">
        <?php
            $conexion = new mysqli("localhost", "root", "", "centro");
            $conexion->set_charset("utf8"); 

            $html_select='';

            $consulta = "SELECT id_asignatura, nombre_asignatura FROM asignaturas";
            $resultado = $conexion->query($consulta);

            if($resultado){
                $html_select.="<label for='opcion_asignatura'>Seleccione la asignatura</label>";
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

        <label for="anio">Inserte un año</label>
        <input type="number" id="anio" name="anio" required>

        <input type="submit" value="Enviar">
    </form>

    <?php
        if(isset($_POST['anio']) && isset($_POST['opcion_asignatura'])){
            $opcion_asignatura = null;
            $anio = null;

            $opcion_asignatura = $_POST['opcion_asignatura'];
            $anio = $_POST['anio'];

            //verificar que el anio tenga solo 4 digitos
            if(strlen($anio) == 4){
                $consulta = "SELECT a.nombre_completo FROM Matriculas m
                JOIN alumnos a ON m.dni_alumno = a.dni
                WHERE m.anio = '$anio' AND m.id_asignatura = '$opcion_asignatura'";

                $resultado = $conexion->query($consulta);

                if($resultado){
                    echo "<h2>Alumnos matriculados en la asignatura ". $opcion_asignatura. " del año ". $anio. " son:</h2>";
                    echo "<ul>";
                    while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
                        echo "<li>". $fila['nombre_completo']. "</li>";
                    }
                    echo "</ul>";
                }
            }else{
                echo "Error en el año, debe ser de 4 dígitos";
            }



        //     if (isset($_POST['asignatura'])) {
        //         $asignatura = $_POST['asignatura'];
        //     }
        //     if (isset($_POST['anio'])) {
        //         $anio = $_POST['anio'];
        //     }
        }
    ?>
</body>
</html>