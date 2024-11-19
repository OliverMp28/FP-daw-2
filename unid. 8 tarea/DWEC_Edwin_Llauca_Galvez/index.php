<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('https://i0.wp.com/youcinebrasil.com.br/wp-content/uploads/2022/08/netflixteaser.png?resize=768%2C432&ssl=1') no-repeat center center fixed; /* Imagen de fondo */
            background-size: cover;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        form {
            animation: fadeIn 1s ease-out;
        }
        h2{
            color: #fff;

        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>
    <header>
        <h1>Reseña de películas y series</h1>
    </header>
    
    <main>
        <h2>Películas y series favoritas</h2>

        <form action="datos_procesados.php" method="POST" name="preguntas_reseña">
            <label for="titulo">Inserte el titulo <span style="color:red;">*</span></label><br>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="nombre">¿Cual es tu nombre? <span style="color:red;">*</span></label><br>
            <input type="text" name="nombre" id="nombre" required><br>

            <label for="fecha_visto">Fecha en la que viste esta serie o película</label><br>
            <input type="date" name="fecha_visto" id="fecha_visto"><br>

            <label for="puntuacion">Puntuación del 1 al 5 <i>(nota: no mayor de 5)</i> <span style="color:red;">*</span></label><br>
            <input type="number" name="puntuacion" id="puntuacion" min="1" max="5" required><br>
            
            <label for="reseña">Cuentanos una reseña, que te parecio?<span style="color:red;">*</span></label><br>
            <textarea name="reseña" id="reseña" cols="50" rows="10" required></textarea><br>

            <input type="submit" value="Enviar reseña" class="enviar_reseña">
        </form>
    </main>
    
 
</body>
</html>