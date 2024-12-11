<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            padding: 10px;
        }
        h1 {
            text-align: center;
        }
        table {
            margin: 20px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 5px;
        }
        th {
            background-color: #333;
        }
        td {
            height: 40px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<?php
    $calendario = [
        "Enero" => 31,
        "Febrero" => 28,
        "Marzo" => 31,
        "Abril" => 30,
        "Mayo" => 31,
        "Junio" => 30,
        "Julio" => 31,
        "Agosto" => 31,
        "Septiembre" => 30,
        "Octubre" => 31,
        "Noviembre" => 30,
        "Diciembre" => 31
    ];

    $diasSemana = ["Lunes", "Martes", "Mirrcoles", "Jueves", "Viernes", "Sabado", "Domingo"];
    
    $diaInicio = 1;

    foreach ($calendario as $nombreMes => $diasMes) {
        echo "<h2>$nombreMes</h2>";
        echo "<table>";
        echo "<tr>";
        foreach ($diasSemana as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr><tr>";

        for ($i = 1; $i < $diaInicio; $i++) {
            echo "<td></td>";
        }

        for ($dia = 1; $dia <= $diasMes; $dia++) {
            echo "<td>$dia</td>";
            $diaInicio++;

            if ($diaInicio > 7) {
                $diaInicio = 1;
                echo "</tr><tr>";
            }
        }

        if ($diaInicio != 1) {
            for ($i = $diaInicio; $i <= 7; $i++) {
                echo "<td></td>";
            }
        }

        echo "</tr></table>";
    }
?>

</body>
</html>