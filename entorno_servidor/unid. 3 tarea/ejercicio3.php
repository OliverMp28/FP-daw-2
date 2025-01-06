<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            margin: 20px;
            width: 50%;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }
        th {
            background-color: black;
            color: white;
        }
        td {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<?php
    // Array asociativo con nombres y notas
    $alumnos = [
        "Daniel" => 3,
        "Jaime" => 5,
        "Edwin" => 7,
        "David" => 8,
        "Marta" => 10,
        "Laura" => 4,
        "Victor" => 9
    ];

    // Función para determinar la calificación según la nota
    function obtenerCalificacion($nota) {
        switch ($nota) {
            case 0:
            case 1:
            case 2:
            case 3:
            case 4:
                return "Suspenso";
            case 5:
                return "Aprobado";
            case 6:
                return "Bien";
            case 7:
            case 8:
                return "Notable";
            case 9:
                return "Sobresaliente";
            case 10:
                return "Matricula de honor";
            default:
                return "Nota no valida";
        }
    }

    echo "<table>";
    echo "<tr>
            <th>Alumno</th>
            <th>Nota</th>
            <th>Calificación</th>
          </tr>";

    foreach ($alumnos as $nombre => $nota) {
        $calificacion = obtenerCalificacion($nota);
        echo "<tr>";
        echo "<td>$nombre</td>";
        echo "<td>$nota</td>";
        echo "<td>$calificacion</td>";
        echo "</tr>";
    }

    echo "</table>";
?>

</body>
</html>