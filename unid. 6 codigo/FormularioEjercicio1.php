<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Respuesta a formulario 1</h1>
    <?php 
        $numero1 = $_POST["primero"];
        $numero2 = $_POST["segundo"];

        $suma = $numero1 + $numero2;
        echo "la suma de $numero1 y $numero2 es: $suma";
    ?>
</body>
</html>