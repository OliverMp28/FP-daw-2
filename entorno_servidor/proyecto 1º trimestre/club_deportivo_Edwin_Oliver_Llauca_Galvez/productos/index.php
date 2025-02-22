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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
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
            <button class="cart-close">
                <i class="fas fa-times"></i>
            </button>
            <header>
                <button class="cart-checkout btn">vaciar carro</button>
                <h3 class="text-slanted">Añadido hasta ahora</h3>
            </header>
            <!-- cart items -->
            <div class="cart-items"></div>
            <footer>
                <button class="cart-checkout btn">Tramitar pedido</button>
                
            </footer>  
            </aside>
        </div>
        <!-- products -->
        <section class="products">
            <!-- filters -->
            <div class="filters">
                <div class="toggle-container">
                    <button class="toggle-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <span class="cart-item-count"></span>
                
                </div>
            </div>
            <!-- products -->
            <div class="products-container">
            
            </div>
            <!--alert-->
        <div class="alerta">
            
        </div>
        
        </section>
        <!-- modal -->
        <div class="modal">
            <button class="close-btn">
            <i class="fas fa-times"></i>
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