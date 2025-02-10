<?php
    $pagina_actual = basename($_SERVER['PHP_SELF']);
    $privilegios = true;

    // $paginas_permitidas_anonimo = ["index.php", "testimonios.php", "servicios.php", "acceder.php"];

    // Si el usuario no ha iniciado sesion
    if (!isset($_SESSION['usuario'])) {
        //Para el nivel 0 (pagina de inicio) permitimos el acceso
        if ($nivel == 0) {
            $privilegios = true;
        } 
        // En paginas de nivel 1, solo se permitirán las secciones públicas:
        // (por ejemplo, "Testimonios", "Servicios" o la propia página de "Acceder")
        else if ($nivel == 1) {
            $allowed_sections = ['Testimonios', 'Servicios', 'Acceder', 'Inicio'];  

            if (!isset($titulo) || !in_array($titulo, $allowed_sections)) {
                echo "<div class='alert alert-danger'>Debes iniciar sesión para acceder a esta sección.</div>";
                $privilegios = false;
            }
        }
    } 
    else {
        // Para el administrador: acceso completo (excepto su propia info, que se maneja en la sección de perfil)
        if ($_SESSION['tipo_usuario'] == 'admin') {
            $privilegios = true;
        } 
        // Para el socio/cliente: se permiten solo ciertas secciones
        else {
            // Secciones permitidas para socios (además de las públicas):
            $allowed_sections_socio = ['Inicio', 'Datos personales', 'Citas', 'Testimonios', 'Noticias', 'Servicios'];
            if ($nivel == 1) {
                if (!isset($titulo) || !in_array($titulo, $allowed_sections_socio)) {
                    echo "<div class='alert alert-danger'>Acceso denegado: No tienes permisos para ver esta sección.</div>";
                    $privilegios = false;
                }
            }
        }
    }
?>


<header class="header-principal">
    <?php
        //compruebo en que nivel nos encontramos para saber si poner una ruta u otra
        // Incluye el menu según el nivel
        if ($nivel == 0) {
            require_once "requires/menu.php";
        } else if ($nivel == 1) {
            require_once "../requires/menu.php";
        }
    ?>
    <div class="texto-cabecera text-center">
        <?php
            // Controla los textos del encabezado dependiendo del nivel, si es 0 es la pagina principal ,si es 1 son otras paginas que estan en subcarpetas
            if ($nivel == 0) {
                echo '<h1 class="display-4 fw-bold">Depor</h1>';
                echo '<h2 class="h5 mt-2">Tu club deportivo.</h2>';
            } 
            else if ($nivel == 1) {
                echo "<h1 class='display-6 fw-bold'>" . $titulo . "</h1>";
            } 
            else {
                echo "<h1>Error</h1><p>'nivel' no tiene un valor valido o no esta definido</p>";
            }
        ?>
    </div>
    <div class="session-info text-center mt-2">
        <?php
        // Mostrar el enlace según el estado de la sesión:
        // Si el usuario ha iniciado sesión, se muestra un mensaje de bienvenida y un enlace para cerrar sesión.
        // De lo contrario, se muestra un enlace para acceder.
        echo "LA SESION Y USUARIO: {$_SESSION['usuario']}";
        if (isset($_SESSION['usuario'])) {
            // Ajusta las rutas según el nivel (nivel 0: raíz; nivel 1: directorio interior)
            $logout_path = ($nivel == 0) ? "acceder/cerrar_sesion.php" : "../acceder/cerrar_sesion.php";
            echo "<p>Bienvenido, " . htmlspecialchars($_SESSION['usuario']) . " | <a href='" . $logout_path . "'>Cerrar sesión de " . htmlspecialchars($_SESSION['tipo_usuario']) . "</a></p>";
        } else {
            $login_path = ($nivel == 0) ? "acceder/index.php" : "../acceder/index.php";
            echo "<p><a href='" . $login_path . "'>Acceder</a></p>";
        }
        ?>
    </div>
</header>
