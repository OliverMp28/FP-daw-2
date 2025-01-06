<?php
    /**
    * Esta funcion devuelve todas las citas de la base de datos
    * @param $conexion: la conexion a la base de datos
    */
    function getCitas($conexion) {
        $sentencia = "SELECT socio, servicio, fecha, hora FROM citas ORDER BY fecha, hora ASC";
        
        $consulta = $conexion->prepare($sentencia);
        
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
        
        // Variables de resultado
        $socio = $servicio = $fecha = $hora = null;
        $consulta->bind_result($socio, $servicio, $fecha, $hora);
        
        $citas = array();
        while ($consulta->fetch()) {
            $citas[] = array(
                'socio' => $socio,
                'servicio' => $servicio,
                'fecha' => $fecha,
                'hora' => $hora
            );
        }
        
        return $citas;
    }



    /**
    * Esta funcion devuelve las fechas y la cantidad de citas por dia.
    * @param $conexion: la conexion a la base de datos
    */
    function getCitasPorMes($conexion, $mes, $anio) {
        $fechaInicio = "$anio-$mes-01";
        $fechaFin = date("Y-m-t", strtotime($fechaInicio)); // Último día del mes
        
        $sentencia = "SELECT DATE(fecha) AS dia, COUNT(*) AS total
                      FROM citas
                      WHERE fecha BETWEEN ? AND ?
                      GROUP BY DATE(fecha)";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('ss', $fechaInicio, $fechaFin);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $resultados = [];
        $dia = null;
        $total = 0;
        $consulta->bind_result($dia, $total);
        
        // Almacenamos los resultados en un arreglo más descriptivo
        while ($consulta->fetch()) {
            $resultados[] = [
                'dia' => $dia,
                'total' => $total,
            ];
        }
        /* esto es un ejemplo de como serviria
        [
           ['dia' => '2024-11-01', 'total' => 3],
           ['dia' => '2024-11-04', 'total' => 2],
        ]
        */
    
        return $resultados;
    }
    
    
    /**
    * Esta funcion es para obtener todas las citas del mes con detalles
    * @param $conexion: la conexion a la base de datos
    */
    function getCitasPorMesConDetalles($conexion, $fechaInicio, $fechaFin) {
        $sentencia = "SELECT c.id, c.fecha, c.hora, s.nombre, s.telefono, serv.descripcion
                      FROM citas c
                      JOIN socio s ON c.socio = s.id
                      JOIN servicio serv ON c.servicio = serv.id
                      WHERE c.fecha BETWEEN ? AND ?
                      ORDER BY c.fecha, c.hora";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('ss', $fechaInicio, $fechaFin);
        
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $citas = [];
        $id = $fecha = $hora = $nombre = $telefono = $descripcion = null;
        $consulta->bind_result($id, $fecha, $hora, $nombre, $telefono, $descripcion);
    
        while ($consulta->fetch()) {
            $citas[] = [
                'id' => $id,
                'fecha' => $fecha,
                'hora' => $hora,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'descripcion' => $descripcion,
            ];
        }
    
        return $citas;
    }

    /**
    * Esta funcion Consulta las citas de un dia y devuelve los detalles de las citas.
    * @param $conexion: la conexion a la base de datos
    */
    function getCitasPorDiaConDetalles($conexion, $fecha) {
        $sentencia = "SELECT c. id, c.fecha, c.hora, s.nombre, s.telefono, serv.descripcion
                      FROM citas c
                      JOIN socio s ON c.socio = s.id
                      JOIN servicio serv ON c.servicio = serv.id
                      WHERE DATE(c.fecha) = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('s', $fecha);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $citas = [];
        $id = $fecha = $hora = $nombre = $telefono = $descripcion = null;
        $consulta->bind_result($id, $fecha, $hora, $nombre, $telefono, $descripcion);
    
        while ($consulta->fetch()) {
            $citas[] = [
                'id' => $id,
                'fecha' => $fecha,
                'hora' => $hora,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'descripcion' => $descripcion,
            ];
        }
    
        return $citas;
    }


    /**
    * Esta funcion Calcula el mes anterior y el siguiente, manejando los cambios de año
    * @param $...
    */
    function calcularMesAnteriorSiguiente($mes, $anio) {
        //aqui sumo o resto una unidad para saber el mes anterior y siguiente
        //en el año solo sumo o resto despues de comprobar que los meses llegaron a su limite y se cambio de año
        $mesAnterior = $mes - 1;
        $anioAnterior = $anio;
        $mesSiguiente = $mes + 1;
        $anioSiguiente = $anio;
    
        if ($mesAnterior < 1) {
            $mesAnterior = 12;
            $anioAnterior--;
        }
    
        if ($mesSiguiente > 12) {
            $mesSiguiente = 1;
            $anioSiguiente++;
        }
    
        return [
            'mesAnterior' => $mesAnterior,
            'anioAnterior' => $anioAnterior,
            'mesSiguiente' => $mesSiguiente,
            'anioSiguiente' => $anioSiguiente,
        ];
    }
    

    /**
    * Esta funcion obtiene los dias de un mes especifico y comprueba si es año biciesto
    * @param $mes, $anio, le paso el mes y año para calcular los dias del mes
    */
    function obtenerDiasDelMes($mes, $anio) {
        //aqui compruebo si el año es bisiesto
        if ($mes == 2) {
            if (($anio % 4 == 0 && $anio % 100 != 0) || ($anio % 400 == 0)) {
                return 29; // bisiesto
            } else {
                return 28; //no bisiesto
            }
        }

        if ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11) {
            return 30;
        }

        // Todos los demas meses tienen 31 días
        return 31;
    }


    /**
     * Esta funcion busca citas basandose en un termino proporcionado.
     * Se puede buscar por nombre del socio, fecha de la cita o servicio contratado.
     * @param $conexion: la conexión a la base de datos
     * @param $filtro: el termino o filtro de busqueda por el cual se buscará
     */
    function buscarCitasConDetalles($conexion, $filtro) {
        $filtro = "%" . $filtro . "%"; //le añado los % para usarlo en el LIKE

        $sentencia = "SELECT c.id, c.fecha, c.hora, s.nombre, s.telefono, serv.descripcion
                    FROM citas c
                    JOIN socio s ON c.socio = s.id
                    JOIN servicio serv ON c.servicio = serv.id
                    WHERE s.nombre LIKE ? OR DATE(c.fecha) LIKE ? OR serv.descripcion LIKE ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('sss', $filtro, $filtro, $filtro);

        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }

        $citas = [];
        $id = $fecha = $hora = $nombre = $telefono = $descripcion = null;
        $consulta->bind_result($id, $fecha, $hora, $nombre, $telefono, $descripcion);

        while ($consulta->fetch()) {
            $citas[] = [
                'id' => $id,
                'fecha' => $fecha,
                'hora' => $hora,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'descripcion' => $descripcion,
            ];
        }

        return $citas;
    }



    /**
     * ------------ AQUI EMPIEZO CON FUNCIONES NECESARIAS PARA CREACION, CANCELACION Y BORRADO DE CITAS----------------
     */


    /**
     * Actualiza el estado de las citas  si es que ya pasaron, 
     * Las citas con fecha anterior a hoy se marcan como "pasada" (estado = 1),
     * no considero a las canceladas (estado = 2)
     * @param $conexion: conexión a la base de datos
     */
    function actualizarEstadoCitas($conexion) {
        $sentencia = "UPDATE citas 
                    SET estado = 1 
                    WHERE fecha <= CURDATE() AND estado = 0";

        $consulta = $conexion->prepare($sentencia);
        if ($consulta->execute() === false) {
            return false;
        }

        return true;
    }


    /**
     * Esta funcion verifica si un socio ya tiene una cita en la misma fecha y hora, para evitar conflictos
     * @param $conexion: la conexión a la base de datos
     * @param $...: parametros para validar si hay alguna cita con esas caracteristicas
     */
    function validarDisponibilidadCita($conexion, $socio, $fecha, $hora) {
        $sentencia = "SELECT COUNT(*) 
                      FROM citas 
                      WHERE socio = ? AND fecha = ? AND hora = ? AND estado = 0"; // 0 = Pendiente
    
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('iss', $socio, $fecha, $hora);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        $cantidad = 0;
        $consulta->bind_result($cantidad);
        $consulta->fetch();

        if($cantidad === 0){
            return true;
        }else{
            return false; //retorna false si hay conflictos con otra cita, esto para evitar crear una cita en crearCita();
        }
    }


    /**
     * Esta funcion crea una nueva cita en la base de datos con estado "pendiente" (0)
     * @param $conexion: la conexión a la base de datos
     * @param $...: datos necesarios pasados por parametro
     */
    function crearCita($conexion, $socio, $servicio, $fecha, $hora) {
        // Validar que la fecha no sea pasada
        $fechaActual = date('Y-m-d');
        if ($fecha <= $fechaActual) {
            return "No se pueden crear citas en fechas pasadas o en la misma fecha de hoy";
        }
    
        if (!validarDisponibilidadCita($conexion, $socio, $fecha, $hora)) {
            return "El socio ya tiene una cita en esa fecha y hora.";
        }
    
        $sentencia = "INSERT INTO citas (socio, servicio, fecha, hora, estado) 
                      VALUES (?, ?, ?, ?, 0)"; //0 = Pendiente, por defecto ya que se esta creando por primera vez
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('iiss', $socio, $servicio, $fecha, $hora);
    
        if ($consulta->execute() === false) {
            return "Error al crear la cita: " . $consulta->error;
        }
    
        return "Cita creada exitosamente.";
    }
    


    /**
     * Cancela una cita cambiando su estado a "cancelada"(2)
     * @param $conexion: conexión a la base de datos
     * @param $id:id de la cita a cancelar
     */
    function cancelarCita($conexion, $id) {
        $sentencia = "UPDATE citas SET estado = 2 WHERE id = ? AND estado = 0";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);

        if ($consulta->execute() === false) {
            return "Error al cancelar la cita: " . $consulta->error;
        }

        if ($consulta->affected_rows > 0) {
            // return "Cita cancelada exitosamente.";
            return true;
        } else {
            // return "No se pudo cancelar la cita. Verifica que esté pendiente.";
            return false;
        }
    }

    /**
     * Verifica el estado actual de una cita
     * @param $conexion: conexión a la base de datos
     * @param $id: id de la cita a comprobar
     */
    function comprobarEstadoDeCita($conexion, $id) {
        $sentencia = "SELECT estado FROM citas WHERE id = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);

        if ($consulta->execute() === false) {
            die("Error al comprobar el estado de la cita: " . $consulta->error);
        }

        $estado = null;
        $consulta->bind_result($estado);
        $consulta->fetch();

        return $estado;
    }

    /**
     * Elimina una cita si cumple con las condiciones (cancelada y en fecha futura).
     *  // estado = 2 es Cancelada
     * @param $conexion: conexión a la base de datos
     * @param $id: ID de la cita a borrar
     */
    function borrarCita($conexion, $id) {
        // Comprobar estado de la cita
        $estado = comprobarEstadoDeCita($conexion, $id);
        if ($estado === null) {
            return "Error: La cita a querer borrar ya no existe";
        }
        if ($estado !== 2) {
            return "Error: Solo se pueden borrar citas que estén canceladas";
        }
    
        //consulto la fecha para validar para que sea solo fechas futura
        $sql = "SELECT fecha FROM citas WHERE id = ?";
        $consultaFecha = $conexion->prepare($sql);
        $consultaFecha->bind_param('i', $id);
    
        if ($consultaFecha->execute() === false) {
            return "Error al verificar la fecha de la cita: " . $consultaFecha->error;
        }
    
        $fecha = null;
        $consultaFecha->bind_result($fecha);
        $consultaFecha->fetch();
    
        $consultaFecha->close();
    
        $fechaActual = date('Y-m-d');
        if ($fecha <= $fechaActual) {
            return "Solo se pueden borrar citas con fecha futura, a partir de mañana.";
        }
    

        //el borrado
        $sentencia = "DELETE FROM citas WHERE id = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('i', $id);
    
        if ($consulta->execute() === false) {
            return "Error al borrar la cita: " . $consulta->error;
        }
    
        if ($consulta->affected_rows > 0) {
            return "Cita eliminada exitosamente.";
        } else {
            return "No se pudo borrar la cita.";
        }
    }
    


    
    
    
    
?>