<?php
    require 'ej4_preguntas.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://th.bing.com/th/id/R.81922583ddb9bee8d0c1838d185b4283?rik=LMxnQMpfGhKoyg&riu=http%3a%2f%2fmedia.aclj.org%2f940%2fMovie_Stuff.jpg&ehk=uXrLLSkj4%2b5SHsH7Ovey0n5koObQDpbQkTGW8yag0wI%3d&risl=&pid=ImgRaw&r=0') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .contenedor-general {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .contenedor-personajes {
            width: 20%;
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 5%; 
            transform: translateY(-50%);
            overflow: hidden;
            border-radius: 10px;
        }

        .contenedor-personajes img {
            width: 100%;
            height: 100%;
            object-fit: contain; 
            transition: opacity 0.5s ease-in-out;
        }

        .contenedor-personajes img.active {
            opacity: 1;
        }

        .contenedor-personajes img.inactive {
            opacity: 0;
        }

        .contenedor-cuestionario {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.7);
            width: 100%;
            max-width: 600px;
            height: 80vh;
            overflow-y: auto;
            z-index: 2;
            position: relative;
        }

        h1 {
            font-family: 'Impact', sans-serif;
            font-size: 3rem;
            color: #DC143C;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            text-align: center;
        }

        .contenedor_pregunta p {
            font-size: 1.3rem;
            color: #1E90FF;
            margin-bottom: 10px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        }

        input.alternativas {
            margin-right: 10px;
        }

        label {
            font-size: 1rem;
            color: #f5f5f5;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        label:hover {
            color: #1E90FF;
        }

        .enviar_respuestas {
            background-color: #DC143C;
            color: #f5f5f5;
            font-size: 1.2rem;
            font-family: 'Arial Black', sans-serif;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 20px;
        }

        .enviar_respuestas:hover {
            background-color: #c11232;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="contenedor-general">
        <div class="contenedor-personajes">
            <img src="https://th.bing.com/th/id/OIP.zx-EczsfB-Fi30f11hprHQAAAA?rs=1&pid=ImgDetMain" alt="Personaje 1" class="personaje" id="personaje-img">
        </div>

        <div class="contenedor-cuestionario">
            <h1>Cuestionario</h1>
            <form action="ej4_resultado.php" method="POST" name="preguntas">
                <?php
                foreach ($preguntas as $i => $pregunta) {
                    echo "<div class='contenedor_pregunta'>";
                    echo "<p><strong>" . ($i + 1) . ". " . $pregunta['pregunta'] . "</strong></p>";
                    foreach ($pregunta['opciones'] as $opcion_index => $opcion) {
                        echo "<input class='alternativas' type='radio' id='". $i . $opcion ."'  name='respuesta" . $i . "' value='" . $opcion_index . "' required>";
                        echo "<label for='". $i . $opcion ."'>" . $opcion . "</label>";
                        echo "<br>";
                    }
                    echo "</div><br>";
                }
                ?>
                <input type="submit" value="Enviar respuestas" class="enviar_respuestas">
            </form>
        </div>
    </div>
    
    <script>
        const personajes = [
            'https://th.bing.com/th/id/OIP.zx-EczsfB-Fi30f11hprHQAAAA?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/OIP.YsyLHNIpcqLWEscEqm1mOgAAAA?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/R.04c931713cdf0c37daf22e1bd513d75e?rik=%2bXuHPtt4Yqw6Dg&riu=http%3a%2f%2fstatic1.squarespace.com%2fstatic%2f528a31e5e4b00863f1646510%2ft%2f53fdf37de4b0eb859e9bd9a3%2f1409151870058%2fshrek&ehk=9Pky2%2bF2hqudBrWImvAMrJ7ns%2fud9zoucjsPOmGF3lc%3d&risl=&pid=ImgRaw&r=0',
            'https://eltornillodeklaus.com/wp-content/uploads/2014/12/eltornillodeklaus-interstellar-Christopher-nolan2.jpg',
            'https://th.bing.com/th/id/OIP.6VcW4t9nXEb7KQjWah4lGAAAAA?rs=1&pid=ImgDetMain'
        ];

        let personajeIndex = 0;
        const personajeImg = document.getElementById('personaje-img'); 

        function changePersonajeImage() {
            personajeImg.classList.remove('active');
            personajeImg.classList.add('inactive');
            
            setTimeout(() => {
                personajeIndex = (personajeIndex + 1) % personajes.length;
                personajeImg.src = personajes[personajeIndex];
                personajeImg.classList.remove('inactive');
                personajeImg.classList.add('active');
            }, 500); 
        }

        setInterval(changePersonajeImage, 5000);
    </script>

</body>
</html>