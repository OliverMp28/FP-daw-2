<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $datos=array("Nombre"=>"Juan","Altura"=>1.85
                    ,"Edad"=>25,"Pelo"=>"Moreno",
                    "Ciudad"=>"Granada");

        $claves=array_keys($datos);
        foreach($claves as $clave){
            echo "$clave ";
        }

    ?>
</body>
</html>