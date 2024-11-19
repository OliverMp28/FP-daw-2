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
    <h1>Ejercicio 2</h1>
    <h2>mostrar matriculas que hay en el cnetro</h2>
    <?php
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 

        $consulta = "SELECT * FROM Matriculas";

        $resultado = $conexion->query($consulta);
        $html="";
        if ($resultado){
            $html .= "<table> ";
            $html .= "<tr> <th>DNI</th> <th>CÓDIGO</th> <th>AÑO</th> <th>NOTA</th> </tr>";
            while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
                $dni_alumno = $fila["dni_alumno"];
                $id_asignatura = $fila["id_asignatura"];
                $anio = $fila["anio"];
                $nota = $fila["nota"];

                $html.= "<tr>";
                $html.= "<td>".$dni_alumno."</td>";
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
    ?>
</body>
</html>