<?php 
// Inicia la sesión solo si aún no se ha iniciado)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$ADMIN = false;
$SOCIO = false;
$ANONIMO = false;

if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] == 'admin') {
        $ADMIN = true;
    } else if ($_SESSION['tipo_usuario'] == 'socio') {
        $SOCIO = true;
    }
} else {
    $ANONIMO = true;
}


//configuración y funciones y CONEXION
require_once "config.php";
require_once "funciones.php";

$conexion = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
if (!$conexion) { 
    die("Error en la conexión a la base de datos.");
}

    
// $consulta->close();
// $conexion->close();
?>