<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
         if(date("N")<6){
            echo "Laborable<br>";
         }else{
            echo "No laborable<br>";
         }   

         switch(date("D")){
            case "Mon":
                echo "lunes";
                break;
            case "Tue":
                echo "martes";
                break;
            case "Wed":
                echo "miercoles";
                break;
            case "Thu":
                echo "Jueves";
                break;
            case "Fri":
                echo "viernes";
                break;
            case "Sat":
                echo "sábado";
                break;
            case "Sun":
                echo "domingo";    
         }









        // $nota=7.8;

        // if($nota<5){
        //     echo "Suspenso";
        // }elseif($nota>=5 && $nota<7){
        //     echo "Aprobado";
        // }elseif($nota>=7 && $nota<8.5){
        //     echo "Notable";
        // }elseif($nota>=8.5 && $nota<10){
        //     echo "Sobresaliente";
        // }else{
        //     echo "Matricula de Honor";
        // }

    ?>
</body>
</html>