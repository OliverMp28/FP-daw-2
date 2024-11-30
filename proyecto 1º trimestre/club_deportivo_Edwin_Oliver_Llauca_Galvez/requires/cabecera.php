

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
            // Controla los textos del encabezado
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
</header>
