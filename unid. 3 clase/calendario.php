<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $semana=["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];
        $año=2024;

        $meses["Enero"]=31;
        if("año es bisiesto"){
            $meses["Febrero"]=29;
        }else{
            $meses["Febrero"]=28;
        }
        $meses["Marzo"]=31;
        $meses["Abril"]=30;
        
        foreach($meses as $nombre=>$dias_mes){
            echo "<h1>$nombre</h1>";
            echo "<table border=1>";
            echo "<tr>";
            foreach($semana as $dia){
                echo "<th>$dia</th>";
            }
            echo "</tr>";

            echo "</table>";
        }
    ?>
</body>
</html>