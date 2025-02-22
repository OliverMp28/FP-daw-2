<?php
    require_once "../config/init.php";

    //aca llamo a los archivos para las funciones necesarias
    require_once "../funciones/funcionesCitas.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Citas</title>
    <style>
    .has-citas {
        background-color: #6c757d; 
        color: #fff;
        cursor: pointer;
    }

    .has-citas:hover {
        background-color: #5a6268;
    }

    #monthYear {
        font-weight: bold;
    }

    .card {
        border: 1px solid #ddd;
    }

    .card .card-body {
        line-height: 1.5;
    }

    td.has-citas {
        position: relative;
    }

    td a.stretched-link {
        display: block;
        height: 100%;
        width: 100%;
        text-align: center;
    }

    /* Soluciona cualquier interferencia adicional */
    td a.stretched-link:hover {
        text-decoration: none;
    }


</style>

</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Citas";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_servicios">
        <a href="agregar.php" class="btn btn-primary mb-4">Crear una nueva Cita</a>

        <!-- Este miniformulario sera usado para la busqueda de citas por nombre del socio, por la fecha o por el servicio contratado. -->
        <form method="GET" action="" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-8">
                    <label for="buscar" class="form-label">Buscar el nombre del socio, por la fecha(ejem: 2024-12-05) o por el servicio contratado</label>
                    <input 
                        type="text" 
                        name="buscar" 
                        id="buscar" 
                        class="form-control" 
                        placeholder="Buscar..." 
                        value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : '' ?>"
                    />
                </div>
                <div class="col-12 col-md-4 mt-auto">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <?php
            $dia = isset($_GET['dia']) ? (int)$_GET['dia'] : null;
            $mes = isset($_GET['mes']) ? (int)$_GET['mes'] : (int)date('n');
            $anio = isset($_GET['anio']) ? (int)$_GET['anio'] : (int)date('Y');
            $filtro = isset($_GET['buscar']) ? $_GET['buscar'] : null;
            $idCancelar = isset($_GET['cancelar']) ? $_GET['cancelar'] : null;
            $idBorrar = isset($_GET['borrar']) ? $_GET['borrar'] : null;


            //---------- actualizo el estado de las citas por si hay algunas que ya pasaron su fecha---------
            $actualizarEstados = actualizarEstadoCitas($conexion);
            if(!$actualizarEstados){
                echo '
                <div class="text-center mt-5"> 
                    <div class="alert alert-danger" role="alert"> 
                        <strong>Error:</strong> No se han podido actualizar las citas. Recargue la pagina o verifique los estados de sus citas. Esto podría ocasionar incongruencias en las comprobaciones de estado de citas. 
                    </div> 
                </div>';
            }


            //--------EMPIEZO A LLAMAR A LAS FUNCIONES NECESARIAS PARA LA CREACION DEL CALENDARIO Y SUS FUNCIONES ----------

            //obtengo citas del mes actual(digo mes actual al mes que se ve por pantalla o al mes que se seleccione en calendario, no al mes actual en la realidad)
            $citasPorMes = getCitasPorMes($conexion, $mes, $anio);

            //calcula mes anterior y siguiente
            $navegacion = calcularMesAnteriorSiguiente($mes, $anio);

            //obtengo días del mes
            $totalDias = obtenerDiasDelMes($mes, $anio);

            // dia de la semana en el que comienza el mes
            //esto es para saber en el calendario por que dia de la semana empieza el primero de ese mes
            // por ejemplo el 1 de nov de 2024 empieza el dia viernes
            $primerDiaSemana = date('N', strtotime("$anio-$mes-01"));


            //-------- AQUI EMPIEZO CON PARTE DE LA LOGICA PARA LA CANCELACION Y BORRADO DE CITAS----------
            $msgCancelacion = "";

            if($idCancelar){
                $citaCancelada = cancelarCita($conexion, $idCancelar);
                if($citaCancelada){
                    $msgCancelacion = '
                                        <div class="alert alert-success d-flex align-items-center shadow-sm p-1 rounded" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill"></i> 
                                            <span>Cita con ID: <strong>'.$idCancelar.'</strong> cancelada correctamente</span>
                                        </div>';

                }else{
                    $msgCancelacion = '
                                        <div class="alert alert-warning d-flex align-items-center shadow-sm p-1 rounded" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill"></i> 
                                            <span>intentó cancelar cita con id:<strong>'.$idCancelar.'</strong> pero no se pudo. 
                                            Recuerde que para cancelar una cita no debe ser una cita pasada ni para hoy debe estar en estado pendiente</span>
                                        </div>';
                }
            }

            if($idBorrar){
                //en el caso de borrar, borrarCita() no devuelve un true o false, directamente devuelve una respuesta
                //esto debido a que dentro tiene varias validaciones y en este caso me gustaria saber el mensaje exacto del error dentro del borrado
                $respuestaBorrar = borrarCita($conexion, $idBorrar);
                $msgCancelacion = '
                                <div class="alert alert-warning d-flex align-items-center shadow-sm p-1 rounded" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i> 
                                    <span>'.$respuestaBorrar.'</span>
                                </div>';

            }

            //doy prioridad si se usa el buscador
            if ($filtro){
                $citas = buscarCitasConDetalles($conexion, $filtro);
                $titulo = "<p class='text-muted'>Resultados para: <strong>" . $filtro ."</strong></p>";
            }
            elseif ($dia) {
                // Este if es para el contenedor_lista_citas, compruebo si se mandó un dia por GET para saber si listo las citas por dia, sino los listo por ese mes
                // Si hay un dia, construir la fecha completa y obtener las citas de ese día
                $fechaSeleccionada = "$anio-$mes-" . ($dia < 10 ? "0$dia" : $dia);
                $citas = getCitasPorDiaConDetalles($conexion, $fechaSeleccionada);
                $titulo = "Citas del dia: " . date('j \d\e F \d\e Y', strtotime($fechaSeleccionada));
            } else {
                // Si no hay día, obtener citas del mes actual
                $fechaInicio = "$anio-$mes-01";
                $fechaFin = date("Y-m-t", strtotime($fechaInicio)); //ultimo día del mes
                $citas = getCitasPorMesConDetalles($conexion, $fechaInicio, $fechaFin);
                $titulo = "Citas del mes: " . date('F \d\e Y', strtotime($fechaInicio));
            }



            //Ajustar navegación
            $mesAnteriorUrl = "index.php?mes={$navegacion['mesAnterior']}&anio={$navegacion['anioAnterior']}";
            $mesSiguienteUrl = "index.php?mes={$navegacion['mesSiguiente']}&anio={$navegacion['anioSiguiente']}";
            
            //Obtener nombre del mes y año
            $nombreMes = date('F', strtotime("$anio-$mes-01"));
        ?>


        <!-- //ESTE ES EL CALENDARIO DINAMICO (se muestra cuando no se este buscando nada por el filtro)-->
        <?php if ($filtro == null):  ?>  

            <div class="contenedor_calendario py-4">
                <!-- Navegación de meses -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="<?= $mesAnteriorUrl ?>" class="btn btn-success">← Mes Anterior</a>
                    <h2 class="text-center mb-0" id="monthYear"><?= $nombreMes . " $anio" ?></h2>
                    <a href="<?= $mesSiguienteUrl ?>" class="btn btn-success">Mes Siguiente →</a>
                </div>

                <!-- Calendario -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center shadow-sm calendar-table">
                        <thead class="bg-light">
                            <tr>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                                <th>Domingo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ajustar día inicial para que el Lunes sea el primer día
                            $primerDiaSemana = ($primerDiaSemana === 0) ? 6 : $primerDiaSemana - 1; // Ajustar Domingo a 6, resto de días Lunes = 0

                            //esta resta es para obtener el dia por el cual iniciara el mes, esta echo asi por que permite obtener dias negativos
                            //esto messirve por que por ejemplo si el mes por el viernes $primerDiaSemana=5-1, el $dia sera un negativo = 1 - 4
                            // osea $dia seria -3, porlotanto del -3 al 0 son 4 dias los cuales no se pintarian en el calendario
                            // entonces del lunes al jueves son dias en blanco, y el mes empezaria a partir del viernes con $dia = 1
                            $dia = 1 - $primerDiaSemana;

                            // Crear un array asociativo de citas por fecha para facilitar acceso
                            //de este modo podre acceder a la candidad de citas dependiendo del dia mas facilmente
                            $citasPorFecha = [];
                            foreach ($citasPorMes as $cita) {
                                $citasPorFecha[$cita['dia']] = $cita['total'];
                            }

                            //este while se ejecuta siempre que el dia que se analice sea menor al total de dias de ese mes
                            while ($dia <= $totalDias) {
                                echo '<tr>';
                                for ($columna = 0; $columna < 7; $columna++) {
                                    if ($dia > 0 && $dia <= $totalDias) {
                                        // Construir la fecha en formato YYYY-MM-DD
                                        //este campo $diaFormateado simplemente es para tener los dias como: "01" en lugar de "1"
                                        $diaFormateado = $dia < 10 ? "0$dia" : $dia;
                                        $fechaActual = "$anio-$mes-$diaFormateado";

                                        $cantidadCitas = isset($citasPorFecha[$fechaActual]) ? $citasPorFecha[$fechaActual] : 0;

                                        // Clases y contenido dinamico
                                        $claseDia = $cantidadCitas > 0 ? 'bg-secondary text-white has-citas position-relative' : 'position-relative';
                                        $colorTexto = $cantidadCitas > 0 ? 'text-white' : 'text-dark';
                                        $urlDia = "index.php?mes=$mes&anio=$anio&dia=$dia";
                                        $citasTexto = $cantidadCitas > 1 ? "$cantidadCitas citas" : ($cantidadCitas === 1 ? "1 cita" : "");

                                        echo "<td class='$claseDia'>";
                                        echo "<a href='$urlDia' class='stretched-link $colorTexto text-decoration-none'>";
                                            echo $dia;
                                            if ($cantidadCitas > 0) {
                                                echo "<div class='small $colorTexto'>$citasTexto</div>";
                                            }
                                        echo "</a>";
                                        echo '</td>';
                                    } else {
                                        echo '<td></td>';
                                    }
                                    $dia++;
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>   

        <?php endif; ?>

        <!-- este es el dinamico -->
        <div class="contenedor_lista_citas py-4">
            <h3 class="text-center mb-4"><?php echo $titulo ?></h3>
            <?php echo $msgCancelacion ?>
            <?php 
                if ($filtro){
                    //esto solo se mostrará si alguien a filtrado con el buscador
                    echo ("<a href='?mes=$mes&anio=$anio' class='btn btn-secondary mb-4'>Volver a cargar la pagina</a>");
                }
            ?>
            <div class="row row-cols-1 g-3">
                <?php 
                if (count($citas) > 0): //verifico si hay citas
                    foreach ($citas as $cita): ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Servicio: <?= $cita['descripcion'] ?></h5>
                                    <p class="mb-2"><strong>Fecha:</strong> <?php echo isset($cita['fecha']) ? date('j \d\e F \d\e Y', strtotime($cita['fecha'])) : 'Fecha no disponible'; ?></p>
                                    <p class="mb-2"><strong>Hora:</strong> <?php echo isset($cita['hora']) ? date('g:i A', strtotime($cita['hora'])) : 'fallo en la hora'; ?></p>
                                    <p class="mb-2"><strong>Socio:</strong> <?php echo $cita['nombre'] ?></p>
                                    <p class="mb-2"><strong>Teléfono:</strong> <?php echo $cita['telefono'] ?></p>


                                    <div class="text-end mt-3">
                                        <?php
                                        $estadoCita = comprobarEstadoDeCita($conexion, $cita['id']);
                                        if($estadoCita == 0){
                                            echo "<a href='index.php?mes=$mes&anio=$anio&cancelar={$cita['id']}' class='btn btn-warning btn-sm'>Cancelar Cita</a>";
                                        }elseif($estadoCita == 1){
                                            echo "<p class='text-muted'>La cita es hoy o ya paso, no se puede cancelar ni borrar</p>";
                                        }else{//aqui es que estaria en estado = 2, que significa cita cancelada, se habilita el boton eliminar
                                            echo "<a href='index.php?mes=$mes&anio=$anio&borrar={$cita['id']}' class='btn btn-danger btn-sm'>Eliminar Cita</a>";
                                        }
                                        ?>
                                    </div>
                            
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php //verifico si se ha pasado un filtro por GET, si se paso un filtro 'buscar' y no encontro nada manda el siguiente mensaje
                    elseif($filtro): ?>
                        <div class="col">
                            <p class='text-danger'>No se encontraron resultados.</p>
                        </div>
                <?php else: ?>
                    <div class="col">
                        <p class="text-center">No hay citas disponibles para el período seleccionado.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>



        <!-- Contenedor de la Lista de Citas -->
        <!-- <div class="contenedor_lista_citas py-4">
            <h3 class="text-center mb-4">Todas las citas</h3>
            <div class="row row-cols-1 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Servicio: Entrenamiento Personal</h5>
                            <p class="mb-2"><strong>Fecha:</strong> 1 de Noviembre de 2024</p>
                            <p class="mb-2"><strong>Hora:</strong> 10:00 AM</p>
                            <p class="mb-2"><strong>Socio:</strong> Juan Pérez</p>
                            <p class="mb-2"><strong>Teléfono:</strong> 555-123-4567</p>
                        </div>
                    </div>
                </div>
           
            </div>
        </div> --> 


    </section>


    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>