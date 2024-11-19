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
        $html = "<h2>Alumno: " .  $nombreCompleto . "</h2>";
    
        $html .= "<table border='1'>";
        $html .= "<tr> <th>Alumno</th> <th>$nombreCompleto</th> </tr>";
    
        foreach ($calificaciones as $asignatura => $calificacion) {
            $html .= "<tr>";
            $html .= "<td>$asignatura</td>";
            $html .= "<td>$calificacion</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    
        return $html;
    }
    
    // Datos del alumno
    $nombreAlumno = "Juan Ramírez";
    $notas = [
        "Matemáticas" => "Sobresaliente",
        "Lengua" => "Notable",
        "Historia" => "Notable",
        "Dibujo" => "Insuficiente"
    ];
    
    echo crearTabla($nombreAlumno, $notas);
    
    ?>
</body>
</html>