<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       /* $color = "";
        if(isset( $_GET["color"])){
            $color = $_GET["color"];
        }elseif (isset($_POST["color"])) {
            $color = $_POST["color"];
        }else{
            die("Invalid color");
        }*/

        if(isset( $_REQUEST["color"]) && isset($_REQUEST["nombre"]) ){
            $color = $_REQUEST["color"];
            $nombre = $_REQUEST["nombre"];
        }else{
            die("Invalid color");
        }

        echo "<h1 style='color: $color;'>Este texto tiene el color elegido por el usuario.</h1>";
    ?>
</body>
</html>