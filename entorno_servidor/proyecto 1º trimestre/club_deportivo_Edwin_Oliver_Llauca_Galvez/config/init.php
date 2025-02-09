<?php 
// Inicia la sesión (solo si aún no se ha iniciado)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "config.php";
require_once "funciones.php";

$conexion = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
if (!$conexion) { 
    die("Error en la conexión a la base de datos.");
}

    
// $consulta->close();
// $conexion->close();
?>