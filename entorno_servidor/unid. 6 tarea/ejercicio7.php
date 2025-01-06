<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //aqui se se ha enviado un mensaje por GET, entonces lo muestra
    if (isset($_GET['mensaje'])) {
        echo "<p style='color: green; font-weight: bold;'>{$_GET['mensaje']}</p>";
    }
    ?>

    <h1>Subir Archivos al Servidor</h1>
    <form action="ejercicio7procesar.php" method="post" enctype="multipart/form-data">
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br><br>

        <label for="archivo">Selecciona archivos:</label>
        <input type="file" id="archivo" name="archivos[]" multiple required>
        <br><br>

        <input type="submit">Subir Archivo</input>
    </form>
</body>
</html>