<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $kilometros=1000;
        $combustible=60;

        $consumo_medio=$combustible/$kilometros;

        echo "Para {$kilometros} kilometros
              Hemos necesitado $combustible litros de gasolina  
              Eso da $consumo_medio litros por kilometro";


    ?>
</body>
</html>