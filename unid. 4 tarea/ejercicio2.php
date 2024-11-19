<?php
$listaAlumnos = array(
    "Antonio" => array(
        "Matemáticas" => 5,
        "Lengua" => 8.3,
        "Ciencias Naturales" => 9,
        "Geografía" => 7
    ),
    "Ana" => array(
        "Matemáticas" => 8,
        "Lengua" => 7,
        "Ciencias Naturales" => 4.5,
        "Geografía" => 9
    ),
    "Benito" => array(
        "Matemáticas" => 9,
        "Lengua" => 6.75,
        "Ciencias Naturales" => 9,
        "Geografía" => 3.1
    )
); 

function imprimirNotasAlumno($nombreAlumno) {
    global $listaAlumnos;

    if (array_key_exists($nombreAlumno, $listaAlumnos)) {
        echo "<h2>Notas de $nombreAlumno</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Alumno</th><th>Matemáticas</th><th>Lengua</th><th>Ciencias Naturales</th><th>Geografía</th><th>Media</th></tr>";
        
        $notas = $listaAlumnos[$nombreAlumno];
        
        $media = array_sum($notas) / count($notas);
        
        echo "<tr>";
        echo "<td>$nombreAlumno</td>"; 
        foreach ($notas as $asignatura => $nota) {
            echo "<td>$nota</td>"; // imprimo la nota de cada uno
        }
        echo "<td>" . $media . "</td>"; // imprimo la media calculada previamente
        echo "</tr>";
        
        echo "</table>";
    } else {
        echo "<p>Error, el alumno $nombreAlumno no se encuentra</p>";
    }
}

imprimirNotasAlumno("Ana");


?>
