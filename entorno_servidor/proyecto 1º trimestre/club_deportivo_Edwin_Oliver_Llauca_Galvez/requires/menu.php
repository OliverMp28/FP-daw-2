<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Botón para el menú en móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
            // Define el prefijo de ruta en función del nivel
            $prefijo = ($nivel === 0) ? "" : "../";
        ?>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <!-- Menú para usuario anónimo (solo secciones públicas) -->
                    <li class="nav-item"><a href="<?= $prefijo ?>index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="<?= $prefijo ?>testimonios/" class="nav-link">Testimonios</a></li>
                    <li class="nav-item"><a href="<?= $prefijo ?>servicios/" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="<?= $prefijo ?>acceder/" class="nav-link">Acceder</a></li>
                <?php else: ?>
                    <?php if ($SOCIO): ?>
                        <!-- Para socios: sustituimos "Socios" por "Datos personales" -->
                        <li class="nav-item"><a href="<?= $prefijo ?>index.php" class="nav-link">Inicio</a></li>
                        <li class="nav-item">
                            <a href="<?= $prefijo ?>socios/perfil.php?id=<?= $_SESSION['id'] ?>" class="nav-link">
                                Datos personales
                            </a>
                        </li>
                        <li class="nav-item"><a href="<?= $prefijo ?>fitness/" class="nav-link">Fitness</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>productos/" class="nav-link">Productos</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>citas/" class="nav-link">Citas</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>testimonios/" class="nav-link">Testimonios</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>noticias/" class="nav-link">Noticias</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>servicios/" class="nav-link">Servicios</a></li>
                    <?php elseif ($ADMIN): ?>
                        <!-- Para administradores se mantiene el menú completo -->
                        <li class="nav-item"><a href="<?= $prefijo ?>index.php" class="nav-link">Inicio</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>socios/" class="nav-link">Socios</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>fitness/" class="nav-link">Fitness</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>productos/" class="nav-link">Productos</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>servicios/" class="nav-link">Servicios</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>testimonios/" class="nav-link">Testimonios</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>noticias/" class="nav-link">Noticias</a></li>
                        <li class="nav-item"><a href="<?= $prefijo ?>citas/" class="nav-link">Citas</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

