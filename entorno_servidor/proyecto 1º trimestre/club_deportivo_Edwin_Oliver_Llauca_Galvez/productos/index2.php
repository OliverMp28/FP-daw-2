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
                    <button class="btn-vaciar-carro btn btn-danger w-100 mb-2">
                        <i class="bi bi-trash"></i> Vaciar carro
                    </button>
                    <button class="btn-tramitar-pedido btn btn-success w-100">
                        <i class="bi bi-bag-check"></i> Tramitar pedido
                    </button>
                </footer>  
            </aside>
        </div>

        <!-- Contenedor de Filtros -->
        <div class="filtro-container bg-light p-4 rounded-3 shadow-sm mb-4">
            <form id="filtroForm" class="row g-3">
                <div class="col-md-3 col-sm-6">
                    <input type="text" id="filterNombre" class="form-control " placeholder="Nombre del producto">
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <input type="number" id="filterPrecioMin" class="form-control" placeholder="Precio mínimo" step="0.01">
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <input type="number" id="filterPrecioMax" class="form-control" placeholder="Precio máximo" step="0.01">
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <select id="filterCategoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        <option value="Ropa">Ropa</option>
                        <option value="Suplementos">Suplementos</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>
                </div>
                
                <div class="col-md-1 col-sm-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel me-2"></i>Filtrar
                    </button>
                </div>
            </form>
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

        <div class="paginacion-contenedor d-flex justify-content-center align-items-center gap-3 p-3 bg-light rounded shadow-sm">
            <button id="prevPage" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium" >
                <i class="bi bi-chevron-left me-2"></i>Anterior
            </button>
            <span id="pageInfo" class="text-muted fw-medium px-3">Página 1</span>
            <button id="nextPage" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium">
                Siguiente<i class="bi bi-chevron-right ms-2"></i>
            </button>
        </div>

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