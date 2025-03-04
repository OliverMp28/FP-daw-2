<?php
    require_once "../config/init.php";


    //aca llamo a los archivos para las funciones necesarias
    require_once "../funciones/funcionesAcceder.php";

    if (isset($_SESSION['id'])) {
        header("Location: ../index.php");
        exit();
    }


    /**
    nombre (varchar)
    edad (int)
    usuario (varchar)
    password (varchar)
    telefono (varchar)
    foto (varchar)
    tipo_usuario (varchar)

     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script defer type="module" src="../assets/js/utilidades.js"></script>
    <script defer type="module" src="../assets/js/acceder.js"></script>
    <link rel="stylesheet" href="../assets/css/otros.css">
    <title>Acceder</title>

    <style>
        main {
            background: url('../assets/img/portada2.avif') no-repeat center center fixed;
            background-size: cover;
        }
        .contenedor-formulario {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <?php
        $nivel = 1;
        require_once "../requires/menu.php"
    ?>

    <main class="d-flex align-items-center" style="min-height: 80vh;">
        <section class="container py-4 seccion_acceder">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 contenedor-formulario">
                    <h2 class="text-center mb-4">Iniciar Sesión</h2>
                    <form id="form-acceder" action="procesar.php" method="post">
                        <!-- Campo de usuario -->
                        <div class="mb-3">
                            <label for="usuario" class="form-label">
                                <i class="bi bi-person-fill"></i> Usuario
                            </label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                        </div>
                        <!-- Campo de password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-key-fill"></i> Contraseña
                            </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        </div>
                        <!-- Campo de tipo de usuario -->
                        <div class="mb-3">
                            <label for="tipo_usuario" class="form-label">
                                <i class="bi bi-person-badge-fill"></i> Tipo de Usuario
                            </label>
                                <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                                <option value="">Selecciona tu tipo de usuario</option>
                                <option value="admin">Administrador</option>
                                <option value="socio">Socio/Cliente</option>
                            </select>
                        </div>
                        <!-- boton -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Acceder</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>