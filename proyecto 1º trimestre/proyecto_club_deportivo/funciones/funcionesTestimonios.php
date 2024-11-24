<?php
    
    /**
    * esta funcion me devuelve 1 testimonio aleatorio o mas dependiendo de lo que pase por parametro

    * @param $conexion: la conexion a la base de datos
    * @param $nTestimonios: numero de testimonios que quiero obtener, si le paso 0 me da todos los testimonios en orden aleatorio
    */
    
    function getTestimoniosAleatorios($conexion, $nTestimonios) {

        if ($nTestimonios > 0) {
            $sentencia = "SELECT t.id, t.contenido, t.fecha, s.nombre as autor 
                        FROM testimonio t
                        JOIN socio s ON t.autor = s.id
                        ORDER BY RAND() 
                        LIMIT ?";
            $consulta = $conexion->prepare($sentencia);
            $consulta->bind_param('i', $nTestimonios);
        } else {
            $sentencia = "SELECT t.id, t.contenido, t.fecha, s.nombre AS autor 
                        FROM testimonio t
                        JOIN socio s ON t.autor = s.id
                        ORDER BY RAND()";
            $consulta = $conexion->prepare($sentencia);
        }

        if ($consulta->execute() === false) {
            die("Error al ejecutar la consulta: " . $consulta->error);
        }

        //obtengo y guardo los resultados en un array $testimonios
        $id = $contenido = $fecha = $autor = null;
        $consulta->bind_result($id, $contenido, $fecha, $autor);

        $testimonios = [];
        while ($consulta->fetch()) {
            $testimonios[] = array(
                'id' => $id,
                'contenido' => $contenido,
                'fecha' => $fecha,
                'autor' => $autor
            );
        }

        return $testimonios;
    }


    /**
    * Esta funcion me devuelve los testimonios ordenados por fecha en orden descendiente
    * @param $conexion: la conexion a la base de datos
    * @param $orden: forma en la que quiero ordenar los testimonios, puede ser 'fecha'
    * si $orden es 0 = Orden ascendente (de mas antiguo a mas reciente).
    *              1 = Orden descendente (de mas reciente a mas antiguo).
    */
    function getTestimoniosOrdenados($conexion, $orden) {
    
        if ($orden === 0) {
            $ordenSql = "ASC";
        } elseif ($orden === 1) {
            $ordenSql = "DESC";
        } else {
            die("Error al obtener los testimonios: El parametro 'orden' debe ser 0 o 1.");
        }
    
        //En este caso no uso bind_param para determinar si es ascendente o descendente, esto ya que DESC y ASC son partes del propio sql 
        //y no como un parametro, el DESC y ASC las controlo yo
        $sentencia = "SELECT t.id, t.contenido, t.fecha, s.nombre AS autor 
                      FROM testimonio t
                      JOIN socio s ON t.autor = s.id
                      ORDER BY t.fecha $ordenSql";
    
        $consulta = $conexion->prepare($sentencia);
    
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $contenido = $fecha = $autor = null;
        $consulta->bind_result($id, $contenido, $fecha, $autor);
    
        $testimonios = [];
        while ($consulta->fetch()) {
            $testimonios[] = array(
                'id' => $id,
                'contenido' => $contenido,
                'fecha' => $fecha,
                'autor' => $autor
            );
        }
    
        return $testimonios;
    }

?>