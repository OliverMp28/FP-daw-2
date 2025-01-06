<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // $cadena = "Saludos";

        // echo "Tamaño de la cadena: " . strlen($cadena) . "<br>";
        // echo "En la posicion 3 hay:" . $cadena[3]."<br>";

        // $frase = "Esto es una frase lenta";
        // //imprime toda la cadena apartir de "a"
        // echo "Busqueda: " . strstr($frase, "a") . "<br>";
        // echo "Busqueda: " . strstr($frase, "na") . "<br>";

        // //para encontrar la ubicacion de la primera letra buscada
        // echo "Busqueda: " . strpos($frase, "na") . "<br>";

        // //compara dos cadenas y devuelve un valor negativo si la primera cadena es antes en orden alfabético
        // $cadena1="Saludos";
        // $cadena2="saludos";
        // echo "Comparacion: ". strcmp($cadena1, $cadena2) . "<br>";
        // echo "Comparacion: ". strcmp($cadena2, $cadena1) . "<br>";

        // $fecha1 = "2024-10-10";
        // $fecha2 = "2024-10-09";
        // echo "Comparacion: ". strcmp($fecha1, $fecha2) . "<br>";

        // //reemplaza todas las a por o en la cadena
        // $palabra = "Casablanca";
        // $nueva_cadena = str_replace("a", "o", $palabra);
        // echo "Sustitucion $palabra -> $nueva_cadena <br>";

        // //convierte una cadena a mayúsculas y otras a minúsculas
        // $frase = "Mañana hay huelga y no viene nadie";
        // echo "Modificar el case<b> " . strtolower($frase). "</b><br>";
        // echo "Modificar el case<b> " . strtoupper($frase). "</b><br>";
        // echo "Modificar el case<b> " . ucwords($frase). "</b><br>";

        $fecha1 = "2024-10-10";
        echo "$fecha1 <br>"; //"2024-10-10"
        $año=strtok($fecha1, "-");
        $mes=strtok( "-");
        $dia=strtok( "-");
        echo "Fecha: dia $dia mes $mes año $año<br>";

        $trozos = explode("-", $fecha1);
        echo "Año: $trozos[0], mes: $trozos[1], dia: $trozos[2] <br>";

        $fecha_otra = implode("/", $trozos);
        echo "Fecha con formato otro: $fecha_otra <br>";

    ?>
</body>
</html>