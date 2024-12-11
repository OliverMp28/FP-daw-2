<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

function generarTabla($color1, $color2, $color3) {
        $tabla = "<table border='1' style=' text-align: center;'>";
        $tabla .= "<tr>";
        $tabla .= "<th>enzcabezado</th>";
        $tabla .= "</tr>";

        $tabla .= "<tr style='background-color: $color1;'>";
        $tabla .= "<td style='height: 50px;'>$color1</td>";
        $tabla .= "</tr>";

        $tabla .= "<tr style='background-color: $color2;'>";
        $tabla .= "<td style='height: 50px;'>$color2</td>";
        $tabla .= "</tr>";

        $tabla .= "<tr style='background-color: $color3;'>";
        $tabla .= "<td style='height: 50px;'>$color3</td>";
        $tabla .= "</tr>";
    $tabla .= "</table>";

    return $tabla;
}

$color1 = "red";
$color2 = "yellow";
$color3 = "green";

echo generarTabla($color1, $color2, $color3);

?>
</body>
</html>