<?php 

$listaMascotas = array(
    0 => array("nombre" => "Pepe", "peso" => 4.5, "color" => "Marrón", "edad" => 12),
    1 => array("nombre" => "Sparky", "peso" => 3, "color" => "Blanco", "edad" => 2),
    2 => array("nombre" => "Tobby", "peso" => 7.2, "color" => "Beige", "edad" => 8),
    3 => array("nombre" => "Bigotes", "peso" => 4, "color" => "Negro", "edad" => 9),
    4 => array("nombre" => "Ricky", "peso" => 0.1, "color" => "Verde", "edad" => 2)
);

// i)
echo "<h2>Lista de todas las mascotas</h2>";
echo "<table border='1'>";
echo "<tr> <th>Nombre</th> <th>Peso</th> <th>Color</th> <th>Edad</th> </tr>";

foreach ($listaMascotas as $mascota) {
    echo "<tr>";
    echo "<td>{$mascota['nombre']}</td>";
    echo "<td>{$mascota['peso']}</td>";
    echo "<td>{$mascota['color']}</td>";
    echo "<td>{$mascota['edad']}</td>";
    echo "</tr>";
}
echo "</table>";


// ii)
echo "<h2>Peso de mascota 3</h2>";
echo "La mascota 3 pesa: " . $listaMascotas[3]['peso'];


// iii)
echo "<h2>Color de sparky</h2>";
$colorSparky = null;
foreach ($listaMascotas as $mascota) {
    if ($mascota['nombre'] == 'Sparky'){
        $colorSparky = $mascota['color'];
    }
}
if($colorSparky){
    echo "el color de sparky es: " . $colorSparky;
}
else{
    echo "no se ha encontrado el color de sparky";
}


// iv)
echo "<h2>datos de la mascota con mas edad</h2>";
$edades = array(null);
foreach ($listaMascotas as $mascota) {
    if($mascota['edad']){
        array_push($edades, $mascota['edad']);
    }
}
echo "<table border='1'>";
echo "<tr> <th>Nombre</th> <th>Peso</th> <th>Color</th> <th>Edad</th> </tr>";
foreach ($listaMascotas as $mascota) {
    if($mascota['edad'] == max($edades)){
        echo "<tr>";
        echo "<td>{$mascota['nombre']}</td>";
        echo "<td>{$mascota['peso']}</td>";
        echo "<td>{$mascota['color']}</td>";
        echo "<td>{$mascota['edad']}</td>";
        echo "</tr>";
    }
}
echo "</table>"; 

// v)
$mascotamenosPesada = null;
foreach ($listaMascotas as $mascota) {
    if ($mascotamenosPesada == null || $mascota['peso'] < $mascotamenosPesada['peso']) {
        $mascotamenosPesada = $mascota;
    }
}

echo "<h2>Mascota que pesa menos</h2>";
echo "<p>Nombre: {$mascotamenosPesada['nombre']}</p>";



?>