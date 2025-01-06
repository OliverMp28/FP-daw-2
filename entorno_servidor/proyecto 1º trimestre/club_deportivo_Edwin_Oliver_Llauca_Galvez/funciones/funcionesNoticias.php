<?php
    

    /*esta funcion es para tener las 3 ultimas noticias que mostraria en la pagina principal
    * devuelve las 3 ultimas noticias en un array
    */
    
    function obtenerUltimasNoticias($conexion) {
        $sentencia = "SELECT * FROM noticia
                      WHERE fecha_publicacion <= ?
                      ORDER BY fecha_publicacion DESC
                      LIMIT ?";
    
        $consulta = $conexion->prepare($sentencia);
    
        $fechaActual = date('Y-m-d');
        $xUltimos = 3;
    
        $consulta->bind_param('si', $fechaActual, $xUltimos);
    
        if ($consulta->execute() === false) { 
            die("Error en la ejecución de la consulta");
        }
    
        $id = $titulo = $contenido = $imagen = $fecha_publicacion = null;
        $consulta->bind_result($id, $titulo, $contenido, $imagen, $fecha_publicacion);
    
        $noticias = array();
        while ($consulta->fetch()) {
            $noticias[] = array(
                'id' => $id,
                'titulo' => $titulo,
                'contenido' => $contenido,
                'imagen' => $imagen,
                'fecha_publicacion' => $fecha_publicacion
            );
        }
    
        return $noticias;
    }

    /**
     * Esta funcion devuelve  un array de noticias paginadas, 
     * paso por parametro la conexion, en que pagina actual estamos y el numero de noticias por pagina que devolvera
     */
    function obtenerNoticiasPaginadas($conexion, $paginaActual, $noticiasPorPagina) {
        $offset = ($paginaActual - 1) * $noticiasPorPagina;
        $fechaActual = date('Y-m-d');
    
        $sentencia = "SELECT * FROM noticia
                      WHERE fecha_publicacion <= ?
                      ORDER BY fecha_publicacion DESC
                      LIMIT ? OFFSET ?";
        
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('sii', $fechaActual, $noticiasPorPagina, $offset);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $titulo = $contenido = $imagen = $fecha_publicacion = null;
        $consulta->bind_result($id, $titulo, $contenido, $imagen, $fecha_publicacion);
    
        $noticias = array();
        while ($consulta->fetch()) {
            $noticias[] = array(
                'id' => $id,
                'titulo' => $titulo,
                'contenido' => $contenido,
                'imagen' => $imagen,
                'fecha_publicacion' => $fecha_publicacion
            );
        }
    
        return $noticias;
    } 
    
    /**
     * Esta funcion devuelve el numero total de las noticias
     */
    function totalNoticias($conexion) {
        $fechaActual = date('Y-m-d');
        
        $sentencia = "SELECT count(*) FROM noticia WHERE fecha_publicacion <= ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('s', $fechaActual);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }

        $totalNoticias=0;
    
        $consulta->bind_result($totalNoticias);
        $consulta->fetch();
    
        return $totalNoticias;
    }
    

    /**
     * Esta funcion devuelve la noticia de la consulta mendiante su id
     */
    function obtenerNoticiaPorId($conexion, $id) {
        $sentencia = "SELECT * FROM noticia WHERE id = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $id = $titulo = $contenido = $imagen = $fecha_publicacion = null;
        $consulta->bind_result($id, $titulo, $contenido, $imagen, $fecha_publicacion);

        $noticia = null;
        while ($consulta->fetch()) {
            $noticia = array(
                'id' => $id,
                'titulo' => $titulo,
                'contenido' => $contenido,
                'imagen' => $imagen,
                'fecha_publicacion' => $fecha_publicacion
            );
        }
    
        return $noticia;
    }


    /**
     * Esta funcion es para crear una nueva noticia en la base de datpos
     */
    function crearNoticia($conexion, $titulo, $contenido, $rutaImagen, $fechaPublicacion) {
        $sentencia = "INSERT INTO noticia (titulo, contenido, imagen, fecha_publicacion) VALUES (?, ?, ?, ?)";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('ssss', $titulo, $contenido, $rutaImagen, $fechaPublicacion);
    
        if ($consulta->execute()) {
            return "La noticia se ha creado correctamente.";
        } else {
            return "Error: No se pudo insertar la noticia en la base de datos. " . $consulta->error;
        }
    }
?>