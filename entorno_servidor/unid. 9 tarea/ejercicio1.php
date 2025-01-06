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
    <h1>Ejercicio 1</h1>
    <h2>Ordenado por edad de menor a mayor</h2>
    <?php
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 

        $consulta = "SELECT * FROM Alumnos
                    ORDER BY edad ASC";

        $resultado = $conexion->query($consulta);
        $html="";
        if ($resultado){
            $html .= "<table> ";
            $html .= "<tr> <th>NOMBRE</th> <th>DNI</th> <th>EDAD</th> </tr>";
            while($fila=$resultado->fetch_array(MYSQLI_ASSOC)){
                $dni_alumno = $fila["dni"];
                $nombre_completo = $fila["nombre_completo"];
                $edad_alumno=$fila["edad"];
        
                $html .= "<tr>";
                $html .= "<td>".$nombre_completo."</td>";
                $html.= "<td>".$dni_alumno."</td>";
                $html.= "<td>".$edad_alumno."</td>";
                $html .= "</tr>";
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