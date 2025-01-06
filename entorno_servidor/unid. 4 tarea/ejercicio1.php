<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    $ciudades = array(
        "Granada" => 150000,
        "Madrid" => 3000000,
        "Barcelona" => 2879200,
        "Málaga" => 240000,
        "Sevilla" => 500000,
        "Valencia" => 1584600,
        "Tarragona" => 485210
    );

    //tabla original
    echo "<h2>Tabla original</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Ciudad</th><th>Población</th></tr>";
    foreach ($ciudades as $ciudad => $poblacion) {
        echo "<tr><td>$ciudad</td><td>$poblacion</td></tr>";
    }
    echo "</table>";

    //ordenado por ciudad
    ksort($ciudades);//con esto estoy ordenando y a la vez modificando el mismo objeto
    echo "<h2>Tabla ordenada por ciudad</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Ciudad</th><th>Población</th></tr>";
    foreach ($ciudades as $ciudad => $poblacion) {
        echo "<tr><td>$ciudad</td><td>$poblacion</td></tr>";
    }
    echo "</table>";


    //ordenado de menor a mayor por poblacion
    asort($ciudades);
    echo "<h2>tabla ordenada por poblacion</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Ciudad</th><th>Población</th></tr>";
    foreach ($ciudades as $ciudad => $poblacion) {
        echo "<tr><td>$ciudad</td><td>$poblacion</td></tr>";
    }
    echo "</table>";

    //ciudad con mayor y menor población
    //como ya esta ordenado por numero de poblacion estoy obteniendo el primero y ultimo
    $ciudad_menor_poblacion = array_keys($ciudades)[0];
    $ciudad_mayor_poblacion = array_keys($ciudades)[count($ciudades)-1];

    echo "<h2>Ciudad con menos poblacion</h2>";
    echo "<p>$ciudad_menor_poblacion con " . min($ciudades) ."</p>";


    echo "<h2>Ciudad con mayor poblacion</h2>";
    echo "<p>$ciudad_mayor_poblacion con " . max($ciudades) ."</p>";
    ?>
    

</body>
</html>