<?php
    /**
     * Verifica las credenciales del usuario.
     *
     * Recibe la conexion, el usuario, el tipo de usuario y la contraseña (en texto plano)
     * Realiza una consulta preparada a la tabla "socio" para obtener los datos del usuario
     * Utiliza password_verify() para comparar la contraseña ingresada con el hash almacenado
     *
     * @param mysqli $conexion   Conexion a la base de datos
     * @param string $tipo_usuario Tipo de usuario ingresado.
     */
    function verificarCredenciales($conexion, $usuario, $tipo_usuario, $password) {
        $sentencia = "SELECT id, usuario, password FROM socio WHERE usuario = ? AND tipo_usuario = ?";
        
        $consulta = $conexion->prepare($sentencia);
        if (!$consulta) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
        
        $consulta->bind_param("ss", $usuario, $tipo_usuario);
        
        if (!$consulta->execute()) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
        
        // Obtenemos el resultado de la consulta
        $resultado = $consulta->get_result();
        
        if ($resultado->num_rows > 0) {
            $socio = $resultado->fetch_assoc();
            if (password_verify($password, $socio['password'])) {
                //retorno los datos del socio si todo a ido bien
                return $socio;
            }
        }
        
        return null;
    }


    /**
    * Esta funcion devuelve todos los socios
    * @param $conexion: la conexion a la base de datos
    */
    function getSocios($conexion) {
        
    }

?>