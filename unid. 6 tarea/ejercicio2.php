<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $tabla = isset($_POST['tabla']) ? intval($_POST['tabla']) : 1;
    $color = isset($_POST['color']) ? htmlspecialchars($_POST['color']) : "white";

    echo "<h2 style='color: $color;'>Tabla del $tabla</h2>";
    echo "<table style='background-color: $color;'>";
    echo "<thead><tr><th>Operación</th><th>Resultado</th></tr></thead>";
    echo "<tbody>";
    for ($i = 1; $i <= 10; $i++) {
        $resultado = $tabla * $i;
        echo "<tr>
                <td>$tabla x $i</td>
                <td>$resultado</td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>

    <br>
</body>
</html>