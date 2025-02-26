<?php
    $privilegios = true;

    // Si el usuario no ha iniciado sesion
    if (!isset($_SESSION['usuario'])) {
        $secciones_permitidas = ['Testimonios', 'Servicios', 'Acceder', 'Inicio']; 

        // En paginas de nivel 1, solo se permitirán las secciones publicas:
        // (por ejemplo, "Testimonios", "Servicios" o la propia página de "Acceder")
        if (!in_array($titulo, $secciones_permitidas)) {
            echo "<div class='alert alert-danger'>Debes iniciar sesión para acceder a esta sección.</div>";
            $privilegios = false;
        }
    } 
    else {
        // Para el socio/cliente: se permiten solo ciertas secciones
        if ($SOCIO) {
            // Secciones permitidas para socios (además de las públicas):
            $secciones_permitidas_socio = ['Inicio', 'Datos personales', 'Citas', 'Testimonios', 'Noticias', 'Servicios'];
            if ($nivel == 1) {
                if (!isset($titulo) || !in_array($titulo, $secciones_permitidas_socio)) {
                    echo "<div class='alert alert-danger'>Acceso denegado: No tienes permisos para ver esta sección.</div>";
                    $privilegios = false;
                }
            }
        } 

    }
?>


<header class="header-principal pb-0">
    <?php
        //compruebo en que nivel nos encontramos para saber si poner una ruta u otra
        // Incluye el menu según el nivel
        if ($nivel == 0) {
            require_once "requires/menu.php";
        } else if ($nivel == 1) {
            require_once "../requires/menu.php";
        }
    ?>
    
    <div class="container-fluid py-3">
        <div class="row align-items-center g-3">
            <!-- Título a la izquierda -->
            <div class="col-md-4">
                <div class="texto-cabecera text-start bg-dark bg-opacity-50 p-2 rounded">
                    <?php
                        if ($nivel == 0) {
                            echo '<h1 class="m-0 fw-bold text-white">Depor</h1>'; 
                            echo '<h2 class="h6 m-0 text-white">Tu club deportivo.</h2>';
                        } 
                        else if ($nivel == 1) {
                            echo "<h1 class='h4 m-0 fw-bold text-white'>" . $titulo . "</h1>";
                        } 
                    ?>
                </div>
            </div>
            
            <!-- Información de sesión a la derecha -->
            <div class="col-md-8">
                <div class="session-info d-flex justify-content-end align-items-center gap-3">
                    <?php
                    if (isset($_SESSION['usuario'])) {
                        $salir_path = ($nivel == 0) ? "acceder/cerrar_sesion.php" : "../acceder/cerrar_sesion.php";
                        echo '
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-white">Bienvenido <strong>'.htmlspecialchars($_SESSION['usuario']).'</strong></span>
                            <div class="vr text-white opacity-50"></div>
                            <a href="'.$salir_path.'" class="btn btn-outline-light" title="Cerrar sesión">
                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión de '.htmlspecialchars($_SESSION['tipo_usuario']).'
                            </a>
                        </div>';
                    } else {
                        $acceder_path = ($nivel == 0) ? "acceder/" : "../acceder/";
                        echo '
                        <a href="'.$acceder_path.'" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-in-right"></i> Acceder
                        </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
