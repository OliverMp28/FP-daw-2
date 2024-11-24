<?php

    /**
    * Esta funcion devuelve a todos los socios de la base de datos
    * No incluyo la contraseña en los datos q devuelve por seguridad
    * @param $conexion: la conexion a la base de datos
    */
    function getSocios($conexion) {
        $sentencia = "SELECT id, nombre, edad, usuario, telefono, foto FROM socio";
    
        $consulta = $conexion->prepare($sentencia);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $nombre = $edad = $usuario = $telefono = $foto = null;
        $consulta->bind_result($id, $nombre, $edad, $usuario, $telefono, $foto);
    
        $socios = array();
        while ($consulta->fetch()) {
            $socios[] = array(
                'id' => $id,
                'nombre' => $nombre,
                'edad' => $edad,
                'usuario' => $usuario,
                'telefono' => $telefono,
                'foto' => $foto
            );
        }
    
        return $socios;
    }


    /**
     * Esta funcion devuelve a todos los socios dependiendo de la busqueda por parametro
     * busca por nombre o por telefono
     * No incluyo la contraseña en los datos q devuelve por seguridad
     * @param $conexion: la conexion a la base de datos
     * @param $terminoBusqueda: texto por el cual se busca a los socios, por defecto lo dejo en null
     */
    function getSociosConBusqueda($conexion, $terminoBusqueda = null) {
        if ($terminoBusqueda) {
            $sentencia = "SELECT id, nombre, edad, usuario, telefono, foto 
                          FROM socio 
                          WHERE nombre LIKE ? OR telefono LIKE ?";
            $consulta = $conexion->prepare($sentencia);
            $likeTerm = "%{$terminoBusqueda}%";
            $consulta->bind_param('ss', $likeTerm, $likeTerm);
        } else {
            $sentencia = "SELECT id, nombre, edad, usuario, telefono, foto FROM socio";
            $consulta = $conexion->prepare($sentencia);
        }
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $nombre = $edad = $usuario = $telefono = $foto = null;
        $consulta->bind_result($id, $nombre, $edad, $usuario, $telefono, $foto);
    
        $socios = [];
        while ($consulta->fetch()) {
            $socios[] = array(
                'id' => $id,
                'nombre' => $nombre,
                'edad' => $edad,
                'usuario' => $usuario,
                'telefono' => $telefono,
                'foto' => $foto
            );
        }
    
        return $socios;
    }
    

    /**
    * Esta funcion devuelve a un socio dependiendo de su id
    * No incluyo la contraseña en los datos q devuelve por seguridad
    * @param $conexion: la conexion a la base de datos
    * @param $id: id del socio a buscar
    */
    function getSocioPorId($conexion, $id) {
        $sentencia = "SELECT id, nombre, edad, usuario, telefono, foto 
                        FROM socio 
                        WHERE id = ?";
    
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecucion de la consulta: " . $consulta->error);
        }
    
        //inicializo las variables
        $id = $nombre = $edad = $usuario = $telefono = $foto = null;
        $consulta->bind_result($id, $nombre, $edad, $usuario, $telefono, $foto);
    
        $socio = null;
        if ($consulta->fetch()) {
            $socio = array(
                'id' => $id,
                'nombre' => $nombre,
                'edad' => $edad,
                'usuario' => $usuario,
                'telefono' => $telefono,
                'foto' => $foto
            );
        }
    
        return $socio;
    }


    /**
    * Esta funcion devuelve la contraseña del socio por su id
    * @param $conexion: la conexion a la base de datos
    * @param $id: id del socio a obtener contraseña
    */
    function getContrasenaPorId($conexion, $id) {
        $sentencia = "SELECT password FROM socio WHERE id = ?";
        $consulta = $conexion->prepare($sentencia);
    
        $consulta->bind_param('i', $id);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecucion de la consulta: " . $consulta->error);
        }
    
        $contraseña = null;
        $consulta->bind_result($contraseña);
    
        if ($consulta->fetch()) {
            return $contraseña;
        } else {
            return null;
        }
    }
    

    /**
    * Esta funcion crea un nuevo socio con los parametros enviados
    * @param $conexion: la conexion a la base de datos
    * @param $id: id del socio a obtener contraseña
    */
    function crearSocio($conexion, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto) {
        $sentencia = "INSERT INTO socio (nombre, edad, usuario, password, telefono, foto) VALUES (?, ?, ?, ?, ?, ?)";
        $consulta = $conexion->prepare($sentencia);
    
        if ($consulta === false) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
    
        $consulta->bind_param('sissss', $nombre, $edad, $usuario, $password, $telefono, $rutaFoto);
    
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    /**
    * Esta funcion modifica al socio, si $rutaFoto es null, es por que no se va a actualizar la foto del socio
    * @param $conexion: la conexion a la base de datos
    * @param $...: todos los demas datos
    */
    function modificarSocioPorId($conexion, $id, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto) {
        // Si no se subió una nueva foto, omitir la columna `foto`
        if ($rutaFoto) {
            $sentencia = "UPDATE socio 
                            SET nombre = ?, edad = ?, usuario = ?, password = ?, telefono = ?, foto = ? 
                            WHERE id = ?";
            $consulta = $conexion->prepare($sentencia);
    
            $consulta->bind_param('sissssi', $nombre, $edad, $usuario, $password, $telefono, $rutaFoto, $id);
        } 
        else {
            $sentencia = "UPDATE socio 
                            SET nombre = ?, edad = ?, usuario = ?, password = ?, telefono = ? 
                            WHERE id = ?";
            $consulta = $conexion->prepare($sentencia);
    
            $consulta->bind_param('sisssi', $nombre, $edad, $usuario, $password, $telefono, $id);
        }
    
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    

?>