<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 6</h1>
    <h2>Crear nueva matricula</h2>
    <form action="" method="POST">
     
        <?php
            $conexion = new mysqli("localhost", "root", "", "centro");
            $conexion->set_charset("utf8"); 

            $consulta = "SELECT dni, nombre_completo FROM alumnos";
            $resultado = $conexion->query($consulta);

            $html_select1='';
            $html_select2= '';

            //ALUMNOS
            if($resultado){
                $html_select1.="<label for='opcion_alumno'>Seleccione al alumno</label>";
                $html_select1.='<select name="opcion_alumno" id="opcion_alumno">';
                while($fila = $resultado->fetch_array(MYSQLI_ASSOC)){
                    $dni = $fila["dni"];
                    $nombre_completo = $fila["nombre_completo"];

                    $html_select1.='<option value="'.$dni.'">'.$nombre_completo.'</option>';
                }
                $html_select1.='</select>';
                echo $html_select1;
            }else{
                echo "Error en la consulta";
            }

            //ASIGNATURAS
            $consulta2 = "SELECT id_asignatura, nombre_asignatura FROM asignaturas";
            $resultado = $conexion->query($consulta2);

            if($resultado){
                $html_select2.="<label for='opcion_asignatura'>Seleccione la asignatura</label>";
                $html_select2.='<select name="opcion_asignatura"  id="opcion_asignatura">';
                while($fila = $resultado->fetch_array(MYSQLI_ASSOC)){
                    $id_asignatura = $fila["id_asignatura"];
                    $nombre_asignatura = $fila["nombre_asignatura"];

                    $html_select2.='<option value="'.$id_asignatura.'">'.$nombre_asignatura.'</option>';
                }
                $html_select2.='</select>';
                echo $html_select2;
            }else{
                echo "Error en la consulta";
            }
        ?>

        <label for="opcion_nota">Inserte la nota</label>
        <select name="opcion_nota" id="opcion_nota">
            <option value="1">1</option>
            <option value="2" selected>2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>

        <input type="submit" value="enviar">
    </form>

    <div id="respuesta">
        <?php
        //aca compruebo que se hayan enviado los datos antes de ejecutar este codigo ya que lo hago en el mismo archivo
            if(isset($_POST['opcion_alumno']) && isset($_POST['opcion_asignatura']) && isset($_POST['opcion_nota'])){
                //obtengo la respuesta
                $opcion_alumno = null;
                $opcion_asignatura = null;
                $opcion_nota = null;
                $anio_actual = null;

                //$errores=[];


                $opcion_alumno = $_POST['opcion_alumno'];
                $opcion_asignatura = $_POST['opcion_asignatura'];
                $opcion_nota = $_POST['opcion_nota'];
                

                $anio_actual = date("Y");

                $sql="INSERT INTO matriculas (dni_alumno,id_asignatura,anio,nota) 
                    VALUES ('$opcion_alumno', '$opcion_asignatura', '$anio_actual','$opcion_nota')";

                $conexion->query($sql);

                if($conexion->affected_rows > 0){
                    echo "<h2>Matricula insertada correctamente</h2>";
                } else{
                    echo "Error al insertar matricula: ". $conexion->error;
                }
            }
            
            $conexion->close();
        ?>
    </div>
    

</body>
</html>