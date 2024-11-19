<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conexion = new mysqli("localhost", "root", "", "centro");
        $conexion->set_charset("utf8"); 

        $id = $_GET['id'];

        $sql = "DELETE FROM matriculas WHERE id_matricula = '$id'";
        $resultado = $conexion->query($sql);

        if($resultado){
            echo "Registro eliminado correctamente <br>";
            header("refresh:3;url=ejercicio8.php");
        } else {
            echo "Error al eliminar el registro <br>";
            header("refresh:3;url=ejercicio8.php");
        }

        $conexion->close();
    ?>
</body>
</html>