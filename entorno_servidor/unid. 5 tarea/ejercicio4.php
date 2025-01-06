<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            margin: 10px ;
            text-align: left;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background-color: gray;
        }
        .nota-final {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
<?php
    $alumno = [
        'nombre' => 'Edwin',
        'apellidos' => 'Llauca gALVEZ',
        'nota1' => 8.6,
        'nota2' => 10.0,
        'nota3' => 6.8
    ];
    
    function obtenerBoletin($alumno) {
        $notaFinal = ($alumno['nota1']+$alumno['nota2']+$alumno['nota3']) / 3;

        $html = "boletin de notas del curso";
        $html .= "<table>";
        $html .= "<tr><th >concepto</th>  <th >resultado</th></tr>";
        $html .= "<tr><td>Nombre:</td><td>{$alumno['nombre']}</td></tr>";
        $html .= "<tr><td>Apellidos:</td><td>{$alumno['apellidos']}</td></tr>";
        $html .= "<tr><td>Nota 1:</td><td>{$alumno['nota1']}</td></tr>";
        $html .= "<tr><td>Nota 2:</td><td>{$alumno['nota2']}</td></tr>";
        $html .= "<tr><td>Nota 3:</td><td>{$alumno['nota3']}</td></tr>";
        $html .= "<tr><td class='nota-final'>Nota final:</td><td class='nota-final'>" . $notaFinal . "</td></tr>";
        $html .= "</table>";

        return $html;
    }



    echo obtenerBoletin($alumno);
    ?>
</body>
</html>