<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $nombre = (isset($_POST['nombre']) && trim($_POST['nombre']) != "") ? $_POST['nombre'] : null;
        $edad = isset($_POST['edad']) ? $_POST['edad'] : null;

        echo $nombre ? "<p>Nombre: $nombre</p>" : "<p>No ha introducido un nombre</p>";
        echo ($edad && is_numeric($edad)) ? "<p>Edad: $edad años</p>" : "<p>No ha introducido una edad o no es valida</p>";
    ?>
</body>
</html>