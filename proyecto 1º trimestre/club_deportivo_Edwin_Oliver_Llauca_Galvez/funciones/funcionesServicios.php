<?php

    /**
    * Esta funcion devuelve todos los servicios de la base de datos
    * @param $conexion: la conexion a la base de datos
    */
    function getServicios($conexion) {
        $sentencia = "SELECT * FROM servicio";

        $consulta = $conexion->prepare($sentencia);

        if ($consulta->execute() === false) {
            die("Error en la ejecucion de la consulta");
        }

        $id = $descripcion = $duracion = $precio = null;
        $consulta->bind_result($id, $descripcion, $duracion, $precio);

        $servicios = array();
        while ($consulta->fetch()) {
            $servicios[] = array(
                'id' => $id,
                'descripcion' => $descripcion,
                'duracion' => $duracion,
                'precio' => $precio
            );
        }

        return $servicios;
    }


    /**
     * Esta funcion devuelve a todos los servicios dependiendo de la busqueda por parametro
     * busca por nombre
     * @param $conexion: la conexion a la base de datos
     * @param $terminoBusqueda: texto por el cual se busca a los servicios, 
     * por defecto lo dejo en null, por si no se pasa ninguna busqueda solo devuelve los servicios sin buscar
     */
    function getServiciosConBusqueda($conexion, $terminoBusqueda = null) {
        if ($terminoBusqueda) {
            $sentencia = "SELECT * 
                          FROM servicio 
                          WHERE descripcion LIKE ?";
            $consulta = $conexion->prepare($sentencia);
            $likeTermino = "%{$terminoBusqueda}%";
            $consulta->bind_param('s', $likeTermino);
        } else {
            $sentencia = "SELECT * FROM servicio";
            $consulta = $conexion->prepare($sentencia);
        }
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $descripcion = $duracion = $precio = null;
        $consulta->bind_result($id, $descripcion, $duracion, $precio);
    
        $socios = [];
        while ($consulta->fetch()) {
            $socios[] = array(
                'id' => $id,
                'descripcion' => $descripcion,
                'duracion' => $duracion,
                'precio' => $precio
            );
        }
    
        return $socios;
    }


    /**
     * Esta funcion devuelve un servicio por su id
     * @param $conexion: la conexion a la base de datos
     * @param $id ide sel servicio a buscar
     */
    function getServicioPorId($conexion, $id) {
        $sentencia = "SELECT id, descripcion, duracion, precio 
                      FROM servicio 
                      WHERE id = ?";
    
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $descripcion = $duracion = $precio = null;
        $consulta->bind_result($id, $descripcion, $duracion, $precio);
    
        $servicio = null;
        if ($consulta->fetch()) {
            $servicio = array(
                'id' => $id,
                'descripcion' => $descripcion,
                'duracion' => $duracion,
                'precio' => $precio
            );
        }
    
        return $servicio;
    }


    /**
     * Esta funcion crea un nuevo servici
     * @param $conexion: la conexion a la base de datos
     * @param $... Los demas datos a insertar
     */
    function crearServicio($conexion, $descripcion, $duracion, $precio) {
        $sentencia = "INSERT INTO servicio (descripcion, duracion, precio) VALUES (?, ?, ?)";
    
        $consulta = $conexion->prepare($sentencia);
    
        if (!$consulta) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
    
        $consulta->bind_param('sid', $descripcion, $duracion, $precio);
    
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Esta funcion modifica un  servicio por su id
     * @param $conexion: la conexion a la base de datos
     * @param $id id del servicio a modificar
     * @param $... datos para insertar en el servicio a modiciar
     */
    function modificarServicioPorId($conexion, $id, $descripcion, $duracion, $precio) {
        $sentencia = "UPDATE servicio 
                      SET descripcion = ?, duracion = ?, precio = ? 
                      WHERE id = ?";
    
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('sidi', $descripcion, $duracion, $precio, $id);
    
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    /**
     * Esta funcion devuelve solo la id y la descripcion del servicio, necesarios para los desplegables select q se usaran despues
     * @param $conexion: la conexión a la base de datos
     */
    function getServiciosDesplegable($conexion) {
        $sentencia = "SELECT id, descripcion FROM servicio ORDER BY descripcion ASC";
        $consulta = $conexion->prepare($sentencia);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta");
        }
    
        $id = null;
        $descripcion = null;
        $consulta->bind_result($id, $descripcion);
    
        $servicios = array();
        while ($consulta->fetch()) {
            $servicios[] = array(
                'id' => $id,
                'descripcion' => $descripcion
            );
        }
    
        return $servicios;
    }

?>