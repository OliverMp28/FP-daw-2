<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <?php
        $mascotas=array(
            array("Nombre" => "Pepe", "Peso" => 4.5, "Color" => "Marrón", "Edad" => 12),
            array("Nombre" => "Sparky", "Peso" => 3, "Color" => "Blanco", "Edad" => 2),
            array("Nombre" => "Tobby", "Peso" => 7.2, "Color" => "Beige", "Edad" => 8),
            array("Nombre" => "Bigotes", "Peso" => 4, "Color" => "Negro", "Edad" => 9),
            array("Nombre" => "Ricky", "Peso" => 0.1, "Color" => "Verde", "Edad" => 2)
        );
        $caracteristicas=array_keys($mascotas[0]);
        
        usort($mascotas,function ($a,$b){
            return $a["Nombre"] <=> $b["Nombre"];
        });


        echo "<h2>Tabla de mascotas</h2>";
        echo "<table class='pets'>";
        echo "<thead>
        <th class='fila'>Fila</th>";
        foreach($caracteristicas as $item){
            echo "<th>$item</th>";
        }
        echo "</thead><tbody>";
        foreach($mascotas as $codigo => $array){
            echo "<tr  class='valor'>";
            echo "<td class='fila'>$codigo</td>";
            foreach($array as $item => $valor){
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table><hr>";


    //======================================================================
        $alumnos=array(
            "Antonio"=>array(
                "matematicas"=>5,"lengua"=>8.3,"cienciasNaturales"=>9,"geografia"=>7
            ),
            "Ana"=>array(
                "matematicas"=>8,"lengua"=>7,"cienciasNaturales"=>4.5,"geografia"=>9
            ),
            "Benito"=>array(
                "matematicas"=>9,"lengua"=>6.75,"cienciasNaturales"=>9,"geografia"=>3.1
            )
        );
        
        $caracteristicas=array_keys($alumnos["Antonio"]);
        $nombre_alumnos=array_keys($alumnos);
        
        usort($alumnos,function($a,$b){
            return $a["lengua"]<=>$b["lengua"];
        });

        echo "<h2>Tabla de alumnos</h2>";
        echo "<table class='pets'>";
        echo "<thead>
        <th class='fila'>Fila</th>";
        foreach($caracteristicas as $item){
            echo "<th>$item</th>";
        }
        echo "</thead><tbody>";
        foreach($alumnos as $asignatura => $notas){
            echo "<tr  class='valor'>";
            echo "<td class='fila'>$asignatura</td>";
            foreach($notas as $item => $valor){
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table><hr>";
?>
</body>
</html>