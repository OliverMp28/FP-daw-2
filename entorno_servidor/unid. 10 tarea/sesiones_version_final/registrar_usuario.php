<?php 
session_start();
require_once "conexion.php";
require_once "utilidades.php";


/**
 * ------------------------ USO ESTE MISMO CODIGO PARA REGISTRAR O MODIFICAR----------------------
 */
if (
    isset($_POST['usuario']) && isset($_POST['nombre_completo']) &&
    isset($_POST['password']) && isset($_POST['confirm_password'])
) {
    $usuario = $_POST['usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['mensaje'] = "Las contraseñas no coinciden.";
        header("Location: usuarios.php");
        die();
    }

    //ACA PROCESO EL REGISTRO DE UN NUEVO USUARIO
    if (!isset($_POST['is_modificacion'])) {
        $tipo_usuario = $_POST['tipo_usuario'] ?? 'normal';

        // Validar tipo de usuario
        if ($tipo_usuario !== 'normal' && $tipo_usuario !== 'socio') {
            $_SESSION['mensaje'] = "Tipo de usuario inválido.";
            header("Location: usuarios.php");
            die();
        }

        $resultado = registrarUsuario($conexion, $usuario, $nombre_completo, $password, $tipo_usuario);

        if ($resultado) {
            $_SESSION['mensaje'] = "Usuario registrado correctamente.";
        } else {
            $_SESSION['mensaje'] = "El usuario ya existe.";
        }

        header("Location: usuarios.php");
        die();
    } 
    //ACA PROCESO SOLO LA MODIFICACION
    else {
        $resultado = actualizarUsuario($conexion, $usuario, $nombre_completo, $password ?: null);

        if ($resultado) {
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar los datos";
        }

        header("Location: usuarios.php");
        die();
    }
}
?>
