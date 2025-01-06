<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Reseña de películas y series</h1>
    </header>
    
    <main>
        <h2>Películas y series favoritas</h2>

        <form action="datos_procesados.php" method="POST" name="preguntas_reseña">
            <label for="titulo">Inserte el título <span style="color:red;">*</span></label><br>
            <input type="text" name="titulo" id="titulo" required><br>

            <label for="nombre">¿Cuál es tu nombre? <span style="color:red;">*</span></label><br>
            <input type="text" name="nombre" id="nombre" required><br>

            <label for="fecha_visto">Fecha en la que viste esta serie o película</label><br>
            <input type="date" name="fecha_visto" id="fecha_visto"><br>

            <label for="puntuacion">Puntuación del 1 al 5 <i>(nota: no mayor de 5)</i> <span style="color:red;">*</span></label><br>
            <input type="number" name="puntuacion" id="puntuacion" min="1" max="5" required><br>
            
            <label for="reseña">Cuéntanos una reseña <span style="color:red;">*</span></label><br>
            <textarea name="reseña" id="reseña" cols="50" rows="10" required></textarea><br>

            <input type="submit" value="Enviar reseña" class="enviar_reseña">
        </form>
    </main>
    
 
</body>
</html>