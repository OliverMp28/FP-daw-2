<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        function doble(){
            return 2*$numero;
        }

        function cuenta_atras($longitud){
            $resultado = "";
            for($i=$longitud; $i>0; $i--){
                echo "$i<br>";
            }
            $resultado = "<h1>Boom</h1>";
            return $resultado;
        }

        function crear_fila_datos($array){

        }

        echo cuenta_atras(10) . "";

    ?>
</body>
</html>