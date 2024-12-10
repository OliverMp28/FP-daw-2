<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table td:nth-child(1), th {
            color: white;
            background-color: purple;
            padding: 10px;
        }
        table td:nth-child(2) {
            background-color: rgb(132, 93, 132);
            padding: 10px;
        }
        td, th{
            border: solid 1px black;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
        $X = 5;
        $Y = 10;
        $Z = 15;

        $operaciones=[$X, $Y, $Z, $X+$Y, $Y*$Z, $X/$Z, $X+$Y+$Z, ($Y+$Z)/$X];
    ?>

    <table>
        <tr>
            <th><strong>Posición</strong></th>
            <th><strong>Valor</strong></th>
        </tr>
        <?php
            foreach ($operaciones as $posicion => $valor) {
                echo "<tr>";
                echo "<td>Posicion $posicion</td>";
                echo "<td>" . $valor . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
