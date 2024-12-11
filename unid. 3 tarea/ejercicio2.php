<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            margin: 40px;
            width: 50%;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 10px;
            font-size: 16px;
        }
        th {
            background-color: black;
            color: white;
        }
        .verde-claro {
            background-color: rgb(131, 200, 131);
        }
        .verde-oscuro {
            background-color: rgb(54, 157, 54);
        }
    </style>
</head>
<body>
<?php
        $numeros = [3, 8, 7, -6];

        echo "<table>";
        echo " <tr>
            <th>Numero</th>
            <th>Cuadrado</th>
            <th>Cubo</th>
            </tr>";

        $colorVerde = "";
        foreach ($numeros as $numero) {
            $cuadrado = $numero ** 2;
            $cubo = $numero ** 3;   

            if($colorVerde == 'verde-oscuro'){
                $claseEstilos = 'verde-oscuro';
            }else{
                $claseEstilos = 'verde-claro';
            }
            echo "<tr class='$claseEstilos'>";
            echo "<td>$numero</td>";
            echo "<td>$cuadrado</td>";
            echo "<td>$cubo</td>";
            echo "</tr>";

            $colorVerde = !$colorVerde;
        }

        echo "</table>";
    ?>
</body>
</html>