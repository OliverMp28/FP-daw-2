<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid black;
        }
        td, th{
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 4</h1>
    <h2>Inserte datos para crear una nueva asignatura</h2>
    <form action="./ejercicio4_result.php" method="POST" name="preguntas_reseña">
        <label for="nombre">Inserte el nombre de la asignatura<span style="color:red;">*</span></label><br>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="creditos">Inserte los creditos de esta asignatura <span style="color:red;">*</span></label><br>
        <input type="number" name="creditos" id="creditos" ><br>

        <input type="submit" value="Crear nueva asignatura">
    </form>
    <?php
    ?>
</body>
</html>