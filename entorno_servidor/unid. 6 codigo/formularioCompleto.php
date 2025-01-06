<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre = !isset($_POST['nombre']) ? $_POST['nombre'] : "Anonimo";
        $apellidos = !isset($_POST['apellidos'])? $_POST['apellidos'] : "desconocido";
        $fecha_nac = !isset($_POST['fnac'])? $_POST['fnac'] : date("Y-m-d");
        $email = !isset($_POST['email'])? $_POST['email'] : "sin email";

        $seccion = $_POST['seccion'];
        $suscripcion = $_POST['suscripcion'];
        $consulta = $_POST['consulta'];

        echo "Nombre: $nombre <br>";
        echo "Apellidos: $apellidos <br>";
        echo "Fecha de nacimiento: $fecha_nac <br>";
        echo "Email: $email <br>";
        echo "Sección: $seccion <br>";
        echo "Suscripción: $suscripcion <br>";
        echo "Consulta: $consulta <br>";

    ?>
</body>
</html>
