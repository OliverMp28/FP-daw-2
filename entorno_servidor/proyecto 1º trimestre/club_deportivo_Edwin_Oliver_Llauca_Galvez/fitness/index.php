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
    require_once "../funciones/funcionesSocios.php";
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
    <script defer type="module" src="../assets/js/app.js"></script>
    <title>Fitness</title>
    <style>
    .sticky-calorias{
        top: 80px; 
        z-index: 100; 
        max-height: 90vh; 
        overflow-y: auto;
    }

    </style>
   
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Fitness";
        require_once "../requires/cabecera.php"
    ?>

    <main class="container py-4 seccion_fitness">
        <div class="row">
            <section class="col-lg-8 col-12 py-4 seccion_fitness_ejercicios">
                <!-- titulo -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Busca los ejercicios que necesites</h2>
                    <p class="text-muted fs-5">Filtra por tipo, musculo o dificultad y obten los mejores ejercicios en nuestro club deportivo</p>
                </div>

                <!-- Tarjeta de Filtros -->
                <div class="card filtros-card p-4 mb-5 shadow-lg">
                    <form id="form-filtros" class="row g-4 align-items-end">
                        <div class="col-md-4">
                            <label for="buscar-nombre" class="form-label fw-semibold text-secondary">Buscar Ejercicio</label>
                            <input type="text" id="buscar-nombre" class="form-control filtro-input" placeholder="Ejemplo: Squat">
                        </div>

                        <div class="col-md-3">
                            <label for="filtro-tipo" class="form-label fw-semibold text-secondary">Tipo de Ejercicio</label>
                            <select id="filtro-tipo" class="form-select filtro-input">
                                <option value="">Todos</option>
                                <option value="cardio">Cardio</option>
                                <option value="olympic_weightlifting">Levantamiento Olímpico</option>
                                <option value="plyometrics">Pliométricos</option>
                                <option value="powerlifting">Powerlifting</option>
                                <option value="strength">Fuerza</option>
                                <option value="stretching">Estiramiento</option>
                                <option value="strongman">Strongman</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filtro-musculo" class="form-label fw-semibold text-secondary">Grupo Muscular</label>
                            <select id="filtro-musculo" class="form-select filtro-input">
                                <option value="">Todos</option>
                                <option value="abdominals">Abdominales</option>
                                <option value="abductors">Abductores</option>
                                <option value="adductors">Aductores</option>
                                <option value="biceps">Bíceps</option>
                                <option value="calves">Pantorrillas</option>
                                <option value="chest">Pecho</option>
                                <option value="forearms">Antebrazos</option>
                                <option value="glutes">Glúteos</option>
                                <option value="hamstrings">Isquiotibiales</option>
                                <option value="lats">Dorsales</option>
                                <option value="lower_back">Zona Lumbar</option>
                                <option value="middle_back">Espalda Media</option>
                                <option value="neck">Cuello</option>
                                <option value="quadriceps">Cuádriceps</option>
                                <option value="traps">Trapecios</option>
                                <option value="triceps">Tríceps</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="filtro-dificultad" class="form-label fw-semibold text-secondary">Dificultad</label>
                            <select id="filtro-dificultad" class="form-select filtro-input">
                                <option value="">Todas</option>
                                <option value="beginner">Principiante</option>
                                <option value="intermediate">Intermedio</option>
                                <option value="expert">Experto</option>
                            </select>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-lg btn-primary filtro-btn">Buscar Ejercicios</button>
                        </div>
                    </form>
                </div>

                <!-- Resultados -->
                <div class="row g-4" id="resultados-ejercicios">
                    <div class="col-12 text-center text-muted">
                        <p>Usa los filtros para encontrar ejercicios rápidamente.</p>
                    </div>
                </div>
            </section>

            <!--Barra lateral para la Calculadora de Calorias -->
            <aside class="col-lg-4 col-12 seccion_fitness_calorias mt-lg-4">
                <div class="card shadow-sm p-3 sticky-top sticky-calorias">
                    <h3 class="text-center mb-3">🔥 Calculadora de Calorías</h3>

                    <div class="mb-3">
                        <label for="inputActividad" class="form-label">Actividad(obligatorio):</label>
                        <input type="text" id="inputActividad" class="form-control" placeholder="Ejemplo: correr, natación..." autocomplete="off">
                        <ul class="list-group mt-1 d-none" id="sugerenciasLista"></ul>
                    </div>

                    <div class="mb-3">
                        <label for="inputPeso" class="form-label">Tu peso (lbs):</label>
                        <input type="number" id="inputPeso" class="form-control" min="50" max="500" placeholder="Ejemplo: 160">
                    </div>

                    <div class="mb-3">
                        <label for="inputDuracion" class="form-label">Duración (min):</label>
                        <input type="number" id="inputDuracion" class="form-control" min="1" placeholder="Ejemplo: 60">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary" id="btnCalcular">Calcular</button>
                    </div>

                    <div class="mt-4" id="resultadoCalorias">
                        <h5 class="text-center">Resultados</h5>
                        <ul class="list-group" id="listaResultados"></ul>
                    </div>
                </div>
            </aside>
        </div>

    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>