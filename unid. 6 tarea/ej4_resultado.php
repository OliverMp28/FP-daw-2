<?php
    require 'ej4_preguntas.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del cuestionario :D</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('https://th.bing.com/th/id/R.81922583ddb9bee8d0c1838d185b4283?rik=LMxnQMpfGhKoyg&riu=http%3a%2f%2fmedia.aclj.org%2f940%2fMovie_Stuff.jpg&ehk=uXrLLSkj4%2b5SHsH7Ovey0n5koObQDpbQkTGW8yag0wI%3d&risl=&pid=ImgRaw&r=0');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #contenedor_resultados {
            background-color: rgba(0, 0, 0, 0.7); 
            color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 50%;
            max-width: 600px;
        }

        #contenedor_resultados h1 {
            color: #e50914; 
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        #contenedor_resultados p {
            font-size: 1.2em;
            margin-bottom: 15px;
        }

        #contenedor_resultados a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0056b3; 
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 1em;
        }

        ul{
            list-style: none;
        }
    </style>
</head>
<body>
    <?php
        $respuestas_cliente = [];
        $correctas = 0;
        $total_preguntas = count($preguntas);
        $mal_respondidos = [];
        $bien_respondidos = [];

        foreach ($preguntas as $index => $pregunta) {
            $respuesta_cliente = isset($_POST['respuesta' . $index]) ? intval($_POST['respuesta' . $index]) : null;
            $respuestas_cliente[] = $respuesta_cliente;

            if ($respuesta_cliente == $pregunta['correcta']) {
                $bien_respondidos[] = [
                    "pregunta" => $pregunta['pregunta'],
                    "respuesta_correcta" => $pregunta['opciones'][$pregunta['correcta']],
                    "respuesta_cliente" => $pregunta['opciones'][$respuesta_cliente]
                ];
                $correctas++;
            } else {
                $mal_respondidos[] = [
                    "pregunta" => $pregunta['pregunta'],
                    "respuesta_correcta" => $pregunta['opciones'][$pregunta['correcta']],
                    "respuesta_cliente" => $pregunta['opciones'][$respuesta_cliente]
                ];
            }
        }
        $nota = ($correctas / $total_preguntas) * $total_preguntas;
    ?>

    <div id="contenedor_resultados">
        <h1>Resultados de la prueba cinefilo</h1>
        <?php
            //EN ESTA PARTE EMPIEZO A IMPRIMIR LO QUE RESULTA DEL CUESTIONARIO
            echo "<p>Has acertado <strong>" . $correctas . "</strong> de <strong>" . $total_preguntas . "</strong> preguntas.</p>";
            echo "<p>Tienes una nota de: <strong>" . $nota . "puntos</strong>";

            $html="";
            if (!empty($mal_respondidos)) {
                $html .= "<h2>Respuestas incorrectas</h2>";
                $html .= "<ul>";
                foreach ($mal_respondidos as $mal_respondido) {
                    $html .= "<li>";
                    $html .= "<strong>Pregunta:</strong> " . $mal_respondido['pregunta'] . "<br>";
                    $html .= "<strong>Tu respuesta:</strong> " . $mal_respondido['respuesta_cliente'] . "<br>";
                    $html .= "<strong>Respuesta correcta:</strong> " . $mal_respondido['respuesta_correcta'];
                    $html .= "</li>";
                }
                $html .= "</ul>";

                $html .= "<br>";
                $html .= "<h2>Respuestas correctas :D</h2>";
                $html .= "<ul>";
                foreach ($bien_respondidos as $bien_respondido) {
                    $html .= "<li>";
                    $html .= "<strong>Pregunta:</strong> " . $bien_respondido['pregunta'] . "<br>";
                    $html .= "<strong>Tu respuesta:</strong> " . $bien_respondido['respuesta_cliente'] . "<br>";
                    $html .= "<strong>Respuesta correcta:</strong> " . $bien_respondido["respuesta_correcta"];
                    $html .= "</li>";
                }
                $html .= "</ul>";
            } else {
                $html .= "<p>EXCELENTE, haz respondido correctamente a todas las preguntas!</p>";
            }

            echo $html;
        ?>
    
        <a href="ej4_index.php">Volver al test</a>
    </div>

</body>
</html>