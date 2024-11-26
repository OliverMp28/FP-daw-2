<?php
    require_once "../config/config.php";
    require_once "../config/funciones.php";

    $conexion = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
    if (!$conexion) { 
        echo "Error en la conexión"; 
        die();
    } 
 
    // $consulta->close();
    // $conexion->close();

    //aca llamo a los archivos para las funciones necesarias
    require_once "../funciones/funcionesServicios.php";
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
    /* Celdas con citas destacadas */
    .has-citas {
        background-color: #6c757d; /* Color secundario de Bootstrap */
        color: #fff;
        cursor: pointer;
    }

    .has-citas:hover {
        background-color: #5a6268;
    }

    /* Títulos del calendario */
    #monthYear {
        font-weight: bold;
    }

    /* Tarjetas de citas */
    .card {
        border: 1px solid #ddd;
    }

    .card .card-body {
        line-height: 1.5;
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
                
        <div class="contenedor_calendario py-4">
            <!-- Navegación de meses -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="index.php?mes=10&anio=2024" class="btn btn-primary">← Mes Anterior</a>
                <h2 class="text-center mb-0" id="monthYear">Noviembre 2024</h2>
                <a href="index.php?mes=12&anio=2024" class="btn btn-primary">Mes Siguiente →</a>
            </div>

            <!-- Calendario -->
            <table class="table table-bordered text-center shadow-sm" id="calendar">
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
                    <!-- Fila de ejemplo (días generados dinámicamente en PHP) -->
                    <tr>
                        <td class="bg-secondary text-white has-citas">
                            <a href="index.php?mes=11&anio=2024&dia=1" class="text-white text-decoration-none">
                                1
                                <div class="small text-white">2 citas</div>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=2" class="text-dark text-decoration-none">2</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=3" class="text-dark text-decoration-none">3</a>
                        </td>
                        <td class="bg-secondary text-white has-citas">
                            <a href="index.php?mes=11&anio=2024&dia=4" class="text-white text-decoration-none">
                                4
                                <div class="small text-white">1 cita</div>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=5" class="text-dark text-decoration-none">5</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=6" class="text-dark text-decoration-none">6</a>
                        </td>
                        <td class="bg-light text-muted">7</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=8" class="text-dark text-decoration-none">8</a>
                        </td>
                        <td class="bg-secondary text-white has-citas">
                            <a href="index.php?mes=11&anio=2024&dia=9" class="text-white text-decoration-none">
                                9
                                <div class="small text-white">3 citas</div>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=10" class="text-dark text-decoration-none">10</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=11" class="text-dark text-decoration-none">11</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=12" class="text-dark text-decoration-none">12</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=13" class="text-dark text-decoration-none">13</a>
                        </td>
                        <td>
                            <a href="index.php?mes=11&anio=2024&dia=14" class="text-dark text-decoration-none">14</a>
                        </td>
                    </tr>
                    <!-- Más filas dinámicas -->
                </tbody>
            </table>
        </div>

        <div class="contenedor_lista_citas py-4">
            <h3 class="text-center mb-4">Todas las citas</h3>
            <div class="row row-cols-1 g-3">
                <!-- Tarjeta de cita 1 -->
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
                <!-- Tarjeta de cita 2 -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Servicio: Masaje Terapéutico</h5>
                            <p class="mb-2"><strong>Fecha:</strong> 4 de Noviembre de 2024</p>
                            <p class="mb-2"><strong>Hora:</strong> 3:00 PM</p>
                            <p class="mb-2"><strong>Socio:</strong> María López</p>
                            <p class="mb-2"><strong>Teléfono:</strong> 555-987-6543</p>
                        </div>
                    </div>
                </div>
                <!-- Más tarjetas -->
            </div>
        </div>

    </section>


    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>