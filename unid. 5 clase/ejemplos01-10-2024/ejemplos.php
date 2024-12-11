<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // $GLOBALS["frase"]="Estoy doblado";
        $frase="Estoy doblado";
        $GLOBALS["frase"]="Estoy doblado";

        function doble($numero){
            global $frase;
            echo $frase."<br>";
            // echo $GLOBALS["frase"]."<br>";
            return $numero*2;
        }

        echo doble(6)."<br>";




        
 // $alumnos=array(array("nombre"=>"Jaime","apellidos"=>"Molina Granados"
        //                      "nota1"=>9.5,"nota2"=>7,"nota3"=>10),
        //                array("nombre"=>"Carmelo","apellidos"=>"Molina Granados"
        //                      "nota1"=>5,"nota2"=>6,"nota3"=>7));

        // $notas=array("nota1","nota2","nota3");

        // foreach($alumnos as $alumno){
        //     foreach($notas as $nota){
        //         $suma+=$alumno[$nota];
        //     } 
            
        // }                     


        // require_once "funciones.php"; 

        // $frutas=array("Manzana"=>30,"Peras"=>40,"Platano"=>14);
        // echo filtrar($frutas,30);
        // echo doble(6)."<br>";
        // echo cuenta_atras(5);
        // cuenta_atras(8);
        // cuenta_atras(9);
        // cuenta_atras(1);



    ?>

</body>
</html>