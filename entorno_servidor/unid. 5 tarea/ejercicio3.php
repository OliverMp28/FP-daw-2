<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .estilo-rojo {
            background-color: red;
            color: white;
        }

        .estilo-verde {
            background-color: green;
            color: black;
        }

        .estilo-azul {
            background-color: blue;
            color: white;
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }
    </style>
</head>
<body>
<?php
    function generarTabla($clase1, $clase2, $clase3) {
        $html = "<table>";

        $html .= "<tr>";
        $html .= "<th> colores de tabla echas por nombres de estilos ya definidas</th>";
        $html .= "</tr>";
        $html .= "<tr class='$clase1'>";
        $html .= "<td>$clase1 ...</td>";
        $html .= "</tr>";

        $html .= "<tr class='$clase2'>";
        $html .= "<td>$clase2 ..</td>";
        $html .= "</tr>";

        $html .= "<tr class='$clase3'>";
        $html .= "<td>$clase3 ...</td>";
        $html .= "</tr>";

        $html .= "</table>";

        return $html;
    }

    $clase1 = "estilo-rojo";
    $clase2 = "estilo-verde";
    $clase3 = "estilo-azul";

    echo generarTabla($clase1, $clase2, $clase3);
    ?>
</body>
</html>