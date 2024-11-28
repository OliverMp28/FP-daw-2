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
    * Esta funcion devuelve todas las citas con los datos especificos de socios y servicios
    * @param $conexion: la conexion a la base de datos
    */
    function getCitasConDetalles($conexion) {
        $sentencia = "SELECT 
                        c.fecha, 
                        c.hora, 
                        s.nombre AS socio_nombre, 
                        s.telefono AS socio_telefono, 
                        ser.descripcion AS servicio_descripcion 
                      FROM citas AS c
                      INNER JOIN socio AS s ON c.socio = s.id
                      INNER JOIN servicio AS ser ON c.servicio = ser.id
                      ORDER BY c.fecha, c.hora ASC";
    
        $consulta = $conexion->prepare($sentencia);
    
        if ($consulta->execute() === false) {
            die("Error en la ejecución de la consulta: " . $consulta->error);
        }
    
        // Variables de resultado
        $fecha = $hora = $socioNombre = $socioTelefono = $servicioDescripcion = null;
        $consulta->bind_result($fecha, $hora, $socioNombre, $socioTelefono, $servicioDescripcion);
    
        $citasDetalles = array();
        while ($consulta->fetch()) {
            $citasDetalles[] = array(
                'fecha' => $fecha,
                'hora' => $hora,
                'socio_nombre' => $socioNombre,
                'socio_telefono' => $socioTelefono,
                'servicio_descripcion' => $servicioDescripcion
            );
        }
    
        return $citasDetalles;
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
        $sentencia = "SELECT c.fecha, c.hora, s.nombre, s.telefono, serv.descripcion
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
        $fecha = $hora = $nombre = $telefono = $descripcion = null;
        $consulta->bind_result($fecha, $hora, $nombre, $telefono, $descripcion);
    
        while ($consulta->fetch()) {
            $citas[] = [
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
        $sentencia = "SELECT c.fecha, c.hora, s.nombre, s.telefono, serv.descripcion
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
        $fecha = $hora = $nombre = $telefono = $descripcion = null;
        $consulta->bind_result($fecha, $hora, $nombre, $telefono, $descripcion);
    
        while ($consulta->fetch()) {
            $citas[] = [
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

// Ejemplo de uso
// $mes = 2; // Febrero
// $anio = 2024; // Año bisiesto
// $dias = obtenerDiasDelMes($mes, $anio);
// echo "El mes $mes del año $anio tiene $dias días.";

    
    

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
    
        return $cantidad === 0; // Retorna true si no hay conflictos
    }


    /**
     * Esta funcion crea una nueva cita en la base de datos con estado "pendiente" (0)
     * @param $conexion: la conexión a la base de datos
     * @param $...: datos necesarios pasados por parametro
     */
    function crearCita($conexion, $socio, $servicio, $fecha, $hora) {
        // Validar que la fecha no sea pasada
        $fechaActual = date('Y-m-d');
        if ($fecha < $fechaActual) {
            return "No se pueden crear citas en fechas pasadas.";
        }
    
        // Validar disponibilidad
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
    

    

    
    
    
    
?>