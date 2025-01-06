<?php
session_start();
require_once "conexion.php";

if ($_SESSION['tipo'] !== 'admin') {
    $_SESSION['mensaje'] = "No tienes permisos para esto";
    header("Location: usuarios.php");
    die();
}

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    $conexion = conectar();

    $sentencia = "DELETE FROM usuarios WHERE id = ?";
    $consulta = $conexion->prepare($sentencia);
    $consulta->bind_param('i', $id_usuario);
    $resultado = $consulta->execute();
    $consulta->close();

    if ($resultado) {
        $_SESSION['mensaje'] = "Usuario eliminado correctamente!!!!!!!";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el usuario";
    }

    header("Location: usuarios.php");
    die();
}
?>
