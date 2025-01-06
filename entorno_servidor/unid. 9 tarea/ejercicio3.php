<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid black;
        }
        td, th{
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <h2>mostrar matriculas de forma comprensible</h2>
    <?php
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 

        $consulta = "SELECT 
            alum.nombre_completo, asig.nombre_asignatura, mat.anio, mat.nota
        FROM 
            matriculas mat
        JOIN 
            alumnos alum ON mat.dni_alumno = alum.dni
        JOIN 
            asignaturas asig ON mat.id_asignatura = asig.id_asignatura;
        ";

        $resultado = $conexion->query($consulta);
        $html="";
        if ($resultado){
            $html .= "<table> ";
            $html .= "<tr> <th>ALUMNON</th> <th>ASIGNATURA</th> <th>AÑO</th> <th>NOTA</th> </tr>";
            while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
                $nombre_alumno = $fila["nombre_completo"];
                $nombre_asignatura = $fila["nombre_asignatura"];
                $anio = $fila["anio"];
                $nota = $fila["nota"];

                $html.= "<tr>";
                $html.= "<td>".$nombre_alumno."</td>";
                $html.= "<td>".$nombre_asignatura."</td>";
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
    ?>
</body>
</html>