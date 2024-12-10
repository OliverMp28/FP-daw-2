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
        $mascota = [
            "Nombre" => "Dobby",
            "Familia" => "Canino",
            "Raza" => "Mastin español",
            "Color" => "mostasa casi blanco",
            "Peso" => "27 kg",
            "Altura" => "50 cm",
            "Edad" => "4 años"
        ];
    ?>

    <table>
        <tr>
            <th>Concepto</th>
            <th>Valor</th>
        </tr>
        <?php
            foreach ($mascota as $clave => $valor) {
                echo "<tr>";
                echo "<td>$clave</td>";
                echo "<td>$valor</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
