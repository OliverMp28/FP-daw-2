<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    function crearTabla($nombreCompleto, $calificaciones) {
        $tabla = "<h2>datos del alumno: " .  $nombreCompleto . "</h2>";
    
        $tabla .= "<table border='1'>";
        $tabla .= "<tr> <th>Alumno</th> <th>$nombreCompleto</th> </tr>";
    
        foreach ($calificaciones as $asignatura => $calificacion) {
            $tabla .= "<tr>";
            $tabla .= "<td>$asignatura</td>";
            $tabla .= "<td>$calificacion</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    
        return $tabla;
    }
    
    $nombreAlumno = "Juan Ramirez";
    $notas = [
        "Matemticas" => "Sobresaliente",
        "Lengua" => "Notable",
        "Historia" => "Notable",
        "Dibujo" => "Insuficiente"
    ];
    
    $resultadoTabla=  crearTabla($nombreAlumno, $notas);
    echo $resultadoTabla;
    ?>
</body>
</html>