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
    <script defer src="../assets/js/app.js"></script>
    <title>Fitness</title>
    <style>
/* 💡 Mejoras en Estilo para la Sección de Ejercicios */
.seccion_fitness_ejercicios {
    background-color: #f8f9fa; /* Fondo suave */
    padding: 40px 0;
}

/* 🎨 Estilo de la Tarjeta de Filtros */
.filtros-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #dee2e6;
}

/* 📌 Input y Selects Mejorados */
.filtro-input {
    border-radius: 10px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

.filtro-input:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.4);
}

/* 🔎 Botón de Búsqueda */
.filtro-btn {
    background: #007bff;
    border-radius: 10px;
    padding: 12px 30px;
    font-size: 18px;
    transition: 0.3s;
}

.filtro-btn:hover {
    background: #0056b3;
}

/* 🏆 Tarjetas de Ejercicios */
.card-ejercicio {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.card-ejercicio:hover {
    transform: translateY(-5px);
}

/* 🎯 Badge de Dificultad */
.badge-dificultad {
    font-size: 0.9rem;
    padding: 6px 12px;
    border-radius: 10px;
}

/* 🟢 Colores según Dificultad */
.badge-beginner {
    background-color: #28a745;
    color: white;
}

.badge-intermediate {
    background-color: #ffc107;
    color: black;
}

.badge-expert {
    background-color: #dc3545;
    color: white;
}

.ver-mas {
    color: #0d6efd; /* Color azul de Bootstrap */
    text-decoration: none; /* Quitar subrayado */
    font-size: 0.9em;
    margin-left: 5px;
}

.ver-mas:hover {
    text-decoration: underline; /* Subrayar al pasar el mouse */
}

    </style>
   
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Fitness";
        require_once "../requires/cabecera.php"
    ?>

    <main>
    <section class="container py-4 seccion_fitness_ejercicios">
    <!-- Título de la Sección -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">💪 Encuentra tu Ejercicio Ideal</h2>
        <p class="text-muted fs-5">Filtra por tipo, músculo o dificultad y obtén los mejores ejercicios</p>
    </div>

    <!-- Tarjeta de Filtros -->
    <div class="card filtros-card p-4 mb-5 shadow-lg">
        <form id="form-filtros" class="row g-4 align-items-end">
            <!-- Búsqueda por Nombre -->
            <div class="col-md-4">
                <label for="buscar-nombre" class="form-label fw-semibold text-secondary">🔍 Buscar Ejercicio</label>
                <input type="text" id="buscar-nombre" class="form-control filtro-input" placeholder="Ejemplo: Squat">
            </div>

            <!-- Filtro por Tipo -->
            <div class="col-md-3">
                <label for="filtro-tipo" class="form-label fw-semibold text-secondary">📌 Tipo de Ejercicio</label>
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

            <!-- Filtro por Grupo Muscular -->
            <div class="col-md-3">
                <label for="filtro-musculo" class="form-label fw-semibold text-secondary">🏋️ Grupo Muscular</label>
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

            <!-- Filtro por Dificultad -->
            <div class="col-md-2">
                <label for="filtro-dificultad" class="form-label fw-semibold text-secondary">🎯 Dificultad</label>
                <select id="filtro-dificultad" class="form-select filtro-input">
                    <option value="">Todas</option>
                    <option value="beginner">Principiante</option>
                    <option value="intermediate">Intermedio</option>
                    <option value="expert">Experto</option>
                </select>
            </div>

            <!-- Botón de Búsqueda -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-lg btn-primary filtro-btn">🔎 Buscar Ejercicios</button>
            </div>
        </form>
    </div>

    <!-- Resultados -->
    <div class="row g-4" id="resultados-ejercicios">
        <!-- Aquí se mostrarán los ejercicios dinámicamente -->
        <div class="col-12 text-center text-muted">
            <p>⚡ Usa los filtros para encontrar ejercicios rápidamente.</p>
        </div>
    </div>
</section>



    </main>

    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>