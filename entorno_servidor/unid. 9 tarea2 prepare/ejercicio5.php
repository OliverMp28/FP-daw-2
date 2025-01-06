<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <h2>Buscar matricula por nombre</h2>
    <form action="" method="POST">
        <label for="nombre">inserte nombre: </label>
        <input type="text" id="nombre" name="nombre"><br>

        <input type="submit" value="enviar">
    </form>

    <?php
        $nombre = null;
        
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];

            $conexion = new mysqli("localhost", "root", "", "centro");
            $conexion->set_charset("utf8"); 
    
            $consulta = "SELECT 
                mat.id_matricula,
                alum.nombre_completo,
                mat.id_asignatura,
                mat.anio,
                mat.nota
            FROM 
                matriculas mat
            JOIN 
                alumnos alum ON mat.dni_alumno = alum.dni
            WHERE alum.nombre_completo = '$nombre';
            ";
    
            $resultado = $conexion->query($consulta);
            $html="";
            if ($resultado){
                $html .= "<table> ";
                $html .= "<tr> <th>ID MATRICULA</th> <th>ALUMNO</th> <th>ID ASIGNATURA</th> <th>ANIO</th> <th>NOTA</th></tr>";
                while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
                    $id_matricula = $fila["id_matricula"];
                    $nombre_alumno = $fila["nombre_completo"];
                    $id_asignatura = $fila["id_asignatura"];
                    $anio = $fila["anio"];
                    $nota = $fila["nota"];
    
                    $html.= "<tr>";
                    $html.= "<td>".$id_matricula."</td>";
                    $html.= "<td>".$nombre_alumno."</td>";
                    $html.= "<td>".$id_asignatura."</td>";
                    $html.= "<td>".$anio."</td>";
                    $html.= "<td>".$nota."</td>";
                    $html.= "</tr>";
                }
                $html .= "</table> ";
            }else{
                $html= "Eror, No se han podido obtener alumnos.";
            }
    
            echo $html;
    
            $conexion->close();
        }

        

    ?>
</body>
</html>