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

?>