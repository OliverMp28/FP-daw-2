<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>lo que seleccionaste:</h1>
    <?php
    if (isset($_POST['frutas'])) {
        $frutas = $_POST['frutas'];
        echo "<p>Has seleccionado las siguientes frutas</p>";
        echo "<ul>";
        foreach ($frutas as $fruta) {
            echo "<li>" . $fruta . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No seleccionaste nada, intenta denuevo</p>";
    }
    ?>
</body>
</html>