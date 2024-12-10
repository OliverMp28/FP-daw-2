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
        $kilometros = 500;
        $combustible = 25;

        $consumoMedio = $combustible / $kilometros;

        echo "<div class='resultado'>";
        echo "<p><strong>Kilometros recorridos:</strong> {$kilometros} km</p>";
        echo "<p><strong>Combustible consumido:</strong> {$combustible} litros combustible</p>";
        echo "<p><strong>Consumo medio:</strong> " . $consumoMedio . " litros por cada kilmetro</p>";
        echo "</div>";
    ?>
</body>
</html>
