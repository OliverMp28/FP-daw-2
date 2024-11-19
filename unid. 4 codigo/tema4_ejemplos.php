<?php
$ciudades=array("Madrid","Zaragoza","Bilbao","Valencia","Lérida","Alicante");
sort($ciudades);
//asort($ciudades);
//rsort($ciudades);
// foreach($ciudades as $indice=>$ciudad){
//     echo "$indice:$ciudad<br>";
// }

$frutas=array("platanos"=>12,"peras"=>48,"lechugas"=>22,"tomates"=>34);
//asort($frutas);
// arsort($frutas);
// foreach($frutas as $fruta=>$stock){
//     echo "$fruta:$stock<br>";
// }

$lista_frutas=array_keys($frutas);
$lista_cantidades=array_values($frutas);

// foreach($lista_frutas as $fruta){
//     echo "$fruta<br>";
// }
// echo "<tr>";    
// foreach($lista_cantidades as $cantidades){
//     echo "<td>$cantidades</td>";
// }
// echo "<tr>";

// echo "<table border=1>";
// echo "<tr>";    
// foreach($lista_frutas as $fruta){
//     echo "<th>$fruta</th>";
// }
// echo "</tr>";
// echo "<tr>";    
// foreach($lista_cantidades as $cantidades){
//     echo "<td>$cantidades</td>";
// }
// echo "</tr>";
// echo "</table>";


$clientes=array(array("nombre"=>"Juan","apellidos"=>"López Aro","saldo"=>4500),
				array("nombre"=>"Maria","apellidos"=>"Álvarez Moreno","saldo"=>15000),
				array("nombre"=>"Rodrigo","apellidos"=>"Moreno Garcia","saldo"=>5600));
// echo $clientes[2]["apellidos"]."<br>";
// echo $clientes[1]["saldo"]."<br>";

$campos=array_keys($clientes[0]);
	// echo "<table border=1>";
	// echo "<tr>";
	// foreach ($campos as $campo){
	// 	echo "<th>$campo</th>";
	// }
	// echo "</tr>";
	// foreach($clientes as $cliente){
	// 	echo "<tr>";
	// 		foreach($cliente as $valor){
	// 			echo "<td>$valor</td>";
	// 		}
	// 	echo "</tr>";
	// }
				
	// echo "</table>";
                   




$vehiculos = array(
    "1234ABC" => array(
                        "marca" => "Toyota",
                        "modelo" => "Corolla",
                        "precio" => 18000
                        ),
    "5678DEF" => array(
                    "marca" => "Honda",
                    "modelo" => "Civic",
                    "precio" => 20000
                ),
    "9012GHI" => array(
                        "marca" => "Ford",
                        "modelo" => "Focus",
                        "precio" => 17000
                    ),
    "3456JKL" => array(
                    "marca" => "Chevrolet",
                    "modelo" => "Malibu",
                    "precio" => 22000
                )
);

echo $vehiculos["1234ABC"]["modelo"]."<br>";
echo $vehiculos["9012GHI"]["precio"]."<br>";

  
?>