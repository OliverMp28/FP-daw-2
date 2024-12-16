<?php


    function conectar() {
        $nombre_host = 'localhost';
        $nombre_usuario = 'root';
        $password_db = '';
        $nombre_db = "gestion_usuarios";
        
        $conexion = new mysqli($nombre_host, $nombre_usuario, $password_db, $nombre_db);
        $conexion->set_charset('utf8');
        return $conexion;
    }
?>