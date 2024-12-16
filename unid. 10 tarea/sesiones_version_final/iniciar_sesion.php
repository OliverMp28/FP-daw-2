<?php
    session_start();

    if($_POST["username"]=="admin" && $_POST["password"]=="admin"){
        $_SESSION["nombre"]=$_POST["username"];
        $_SESSION["tipo"]="admin";
    }else{
        $_SESSION["nombre"]=$_POST["username"];
        $_SESSION["tipo"]="normal";
    }
    

    header("Location:$_POST[origen]");
?> 

<?php
session_start();
require_once "conexion.php";

if (isset($_POST["username"], $_POST["password"])) {
    $conexion = conectar();

    // Consulta preparada para buscar el usuario
    $sentencia = "SELECT id, login, password, tipo FROM usuarios WHERE login = ?";
    $consulta = $conexion->prepare($sentencia);

    $consulta->bind_param("s", $_POST["username"]);
    $consulta->execute();
    $consulta->bind_result($id, $login, $password, $tipo);

    if ($consulta->fetch()) {
        if (password_verify($_POST["password"], $password)) {
            $_SESSION["nombre"] = $login;
            $_SESSION["tipo"] = $tipo;
            $_SESSION["id"] = $id;
        } else {
            echo "<p>Contraseña incorrecta.</p>";
            die();
        }
    } else {
        echo "<p>Usuario no encontrado.</p>";
        die();
    }

    $consulta->close();
    $conexion->close();

    // Redirigir a la página de origen
    header("Location: $_POST[origen]");
} else {
    echo "<p>Error: No se enviaron datos del formulario.</p>";
}
?>
