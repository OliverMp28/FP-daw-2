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




?>