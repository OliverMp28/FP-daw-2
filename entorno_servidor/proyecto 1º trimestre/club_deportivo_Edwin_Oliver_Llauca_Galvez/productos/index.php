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

    <!-- Se usa el js dependiendo del tipo de usuario debido a las acciones que tiene cada uno -->
    <?php if ($ADMIN) { ?>
        <script defer type="module" src="../assets/js/productosAdmin.js"></script>
    <?php } ?>
    <?php if ($SOCIO) { ?>
        <script defer type="module" src="../assets/js/productos.js"></script>
    <?php } ?>

    <script defer type="module" src="../assets/js/productosValidaciones.js"></script>
    <title>Productos</title>
   
</head>
<body>
    <?php
        $nivel = 1;
        $titulo = "Productos";
        require_once "../requires/cabecera.php"
    ?>

    <main class="py-4">
        <!-- Contenedor de Filtros -->
        <div class="container filtro-container bg-light p-4 rounded-3 shadow-sm mb-4">
            <form id="filtroForm" class="row g-3 align-items-center">
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <input type="text" id="filterNombre" class="form-control" placeholder="Nombre del producto">
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <input type="number" id="filterPrecioMin" class="form-control" placeholder="Mínimo" step="0.1">
                </div>
                
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <input type="number" id="filterPrecioMax" class="form-control" placeholder="Máximo" step="0.1">
                </div>
                
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <select id="filterCategoria" class="form-select">
                        <option value="">Todas</option>
                        <option value="Ropa">Ropa</option>
                        <option value="Suplementos">Suplementos</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>
                </div>
                
                <!-- Botón ajustado -->
                <div class="col-lg-2 col-md-5 col-sm-12">
                    <button type="submit" class="btn btn-primary w-100 text-nowrap">
                        <i class="bi bi-funnel me-2"></i>Filtrar
                    </button>
                </div>
            </form>
        </div>

        <?php if ($SOCIO) { ?>
            <!-- products -->
            <section class="py-4 seccion_productos">
                <div class="cart-overlay">
                    <aside class="cart">
                        <button class="cart-close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                        <header>
                            <h3 class="text-slanted">Añadido hasta ahora</h3>
                        </header>

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

                <div class="container  products">
                    <div class="filters d-flex justify-content-between align-items-center p-2">
                        <div class="toggle-container d-flex align-items-center gap-2">
                            <button class="toggle-cart btn btn-primary d-flex align-items-center">
                                <i class="bi bi-cart-fill me-1"></i> Ver Carrito
                            </button>
                            <span class="cart-item-count badge bg-danger rounded-pill px-2">0</span>
                        </div>
                    </div>

                    <div class="products-container"></div>
                </div>

            </section>
        <?php } ?>
        
        

        <?php if ($ADMIN) { ?>
            <!-- products admin -->
            <section class="py-4 seccion_productos-admin">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <h2 class="mb-0 text-primary fw-bold">
                            <i class="bi bi-box-seam me-2"></i>Gestión de Productos
                        </h2>
                        <button id="crear_producto" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i>Nuevo Producto
                        </button>
                    </div>

                    <div class="table-responsive rounded-3 shadow">
                        <table class="tabla-productos table table-hover align-middle mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col" class="text-center">Stock</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col" class="d-none d-xl-table-cell">Creación</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="tabla-cuerpo">
                                <!-- Filas -->
                                    <td class="text-center fw-semibold text-muted">#15</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="https://via.placeholder.com/50" 
                                                    alt="Producto" 
                                                    class="img-fluid rounded-2" 
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <span class="fw-semibold">Camiseta Deportiva</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-lg-table-cell text-truncate" style="max-width: 250px;">
                                        Camiseta técnica para entrenamiento
                                    </td>
                                    <td class="text-success fw-semibold">34.99€</td>
                                    <td class="text-center">
                                        <span class="badge bg-danger bg-opacity-25 text-danger">3</span>
                                    </td>
                                    <td>
                                        <span class="">Ropa</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-muted small">2025-02-15</td>
                                    <td class="text-center">
                                        <div class="botones-acciones-producto d-flex gap-2 justify-content-center">
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        <?php } ?>
        

        <div class="paginacion-contenedor d-flex justify-content-center align-items-center gap-3 p-3 bg-light rounded shadow-sm">
            <button id="prevPage" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium" >
                <i class="bi bi-chevron-left me-2"></i>Anterior
            </button>
            <span id="pageInfo" class="text-muted fw-medium px-3">Página 1</span>
            <button id="nextPage" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium">
                Siguiente<i class="bi bi-chevron-right ms-2"></i>
            </button>
        </div>

        <!-- mensages de alerta -->
        <div class="alerta"></div>

        <!-- modal producto -->
        <!-- <div class="modal-producto">
            <button class="close-btn">
                <i class="bi bi-x-lg"></i> 
            </button>
            <div class="modal-content">
                <img src="" class="main-img" alt="" />
                <h2 class="image-title">title</h2>
                <h3 class="image-alt">pr</h3>
            </div>
        </div> -->

        <!-- Modal Reutilizable -->
        <div class="modal fade" id="generalModal" tabindex="-1" aria-labelledby="generalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generalModalLabel">Título del Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body" id="generalModalBody">
                        <!--el contenido dinámico se insertará aquí -->
                    </div>
                    <div class="modal-footer" id="generalModalFooter">
                        <!--los Botones dinámicos se insertarán aquí -->
                    </div>
                </div>
            </div>
        </div>

    </main>


    <?php
        include('../requires/footer.php');
    ?>
</body>
</html>