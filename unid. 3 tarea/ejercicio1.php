<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            margin: 20px;
            width: 200px;
        }
        td {
            border: 2px solid #d16d6d;
            text-align: center;
            padding: 10px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <?php
        for ($tabla = 1; $tabla <= 12; $tabla++) {
            echo "<table>";
            for ($j = 1; $j <= 10; $j++) {
                $color = ($j % 2 == 0) ? "#f4a4b4" : "#fccccc";
                echo "<tr style='background-color: $color;'>";
                echo "<td>{$tabla}x{$j}</td>";
                echo "<td>" . ($tabla * $j) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>
</body>
</html>
