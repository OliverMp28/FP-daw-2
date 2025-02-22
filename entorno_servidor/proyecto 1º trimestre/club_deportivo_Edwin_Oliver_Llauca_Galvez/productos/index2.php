<?php
    require_once "../config/init.php";

    //aca llamo a los archivos para las funciones necesarias
    // require_once "../funciones/funcionesSocios.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/carrito.css">

    <link rel="stylesheet" href="../assets/css/otros.css">
    <script defer type="module" src="../assets/js/productos.js"></script>
    <title>Productos</title>
   
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Productos";
        require_once "../requires/cabecera.php"
    ?>

    <main class="container py-4 seccion_productos">
        <!-- cart -->
        <div class="cart-overlay">
            <aside class="cart">
                <!-- Botón para cerrar el carrito -->
                <button class="cart-close">
                    <i class="bi bi-x-lg"></i>
                </button>
                <header>
                    <h3 class="text-slanted">Añadido hasta ahora</h3>
                </header>
                <!-- Cart items -->
                <div class="cart-items"></div>

                <footer>
                    <button class="cart-checkout btn btn-danger w-100 mb-2">
                        <i class="bi bi-trash"></i> Vaciar carro
                    </button>
                    <button class="cart-checkout btn btn-success w-100">
                        <i class="bi bi-bag-check"></i> Tramitar pedido
                    </button>
                </footer>  
            </aside>
        </div>

        
        <!-- products -->
        <section class="products">
            <!-- filters -->
            <div class="filters d-flex justify-content-between align-items-center p-2">
                <div class="toggle-container d-flex align-items-center gap-2">
                    <button class="toggle-cart btn btn-primary d-flex align-items-center">
                        <i class="bi bi-cart-fill me-1"></i> Ver Carrito
                    </button>
                    <span class="cart-item-count badge bg-danger rounded-pill px-2">0</span>
                </div>
            </div>

            <!-- products -->
            <div class="products-container"></div>
            <!-- alert -->
            <div class="alerta"></div>
        </section>

        <!-- modal -->
        <div class="modal">
            <button class="close-btn">
                <i class="bi bi-x-lg"></i> <!-- Ícono de cerrar -->
            </button>
            <div class="modal-content">
                <!-- content -->
                <img src="" class="main-img" alt="" />
                <h2 class="image-title">title</h2>
                <h3 class="image-alt">pr</h3>
            </div>
        </div>
    </main>


    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>