<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <?php
        $fahrenheit = 75;

        $celsius = 5 * ($fahrenheit - 32) / 9;

        echo "<div class='resultado'>";
        echo "<p>{$fahrenheit} grados ºF corresponden a " . $celsius . " ºC.</p>";
        echo "</div>";
    ?>
</body>
</html>
