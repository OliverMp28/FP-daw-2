<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $lista=["Perro","Gato","Leopardo","Caballo","Dragón","Unicornio"];
        for ($i=0; $i < count($lista); $i++) { 
            echo "$lista[$i]<br>";
        }

        foreach ($lista as $animal) {
            echo "$animal<br>";
        }

        $libros=["Harry Potter"=>29.99,"El Quijote"=>15.99,"El Hobbit"=>8.95];
        foreach ($libros as $titulo=>$precio) {
            echo "$titulo $precio<br>";
        }






        // $i=1;
        // while($i<=10){
        //     echo "$i ";
        //     $i++;
        // }

        // $contador=1;
        // $i=1;
        // echo "<table border=1>";
        // while($i<=10){
        //     echo "<tr>";
        //     $j=1;
        //     while($j<=10){
        //         echo "<td>$contador</td>";
        //         $contador++;
        //         $j++;
        //     }
        //     echo "</tr>";
        //     $i++;
        // }
        // echo "</table>";

        // echo "<h1>Con bucle for</h1>";
        // for($i=1;$i<=10;$i++){
        //     echo $i." ";
        // }

    ?>
</body>
</html>