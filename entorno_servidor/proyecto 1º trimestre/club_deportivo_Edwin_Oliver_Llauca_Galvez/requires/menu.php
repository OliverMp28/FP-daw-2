


<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- este solo es el boton del menu en movil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- si $nivel es 0 entonces coloca los li que correspondan-->
                <?php if ($nivel === 0) { ?>
                    <li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="./socios/" class="nav-link">Socios</a></li>
                    <li class="nav-item"><a href="./fitness/" class="nav-link">Fitness</a></li>
                    <li class="nav-item"><a href="./servicios/" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="./testimonios/" class="nav-link">Testimonios</a></li>
                    <li class="nav-item"><a href="./noticias/" class="nav-link">Noticias</a></li>
                    <li class="nav-item"><a href="./citas/" class="nav-link">Citas</a></li>
                <?php } 
                //  si $nivel es 1 entonces coloca los li del siguiente nivel de carpetas
                else if ($nivel === 1) { ?>
                    <li class="nav-item"><a href="../index.php" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="../socios/" class="nav-link">Socios</a></li>
                    <li class="nav-item"><a href="../fitness/" class="nav-link">Fitness</a></li>
                    <li class="nav-item"><a href="../servicios/" class="nav-link">Servicios</a></li>
                    <li class="nav-item"><a href="../testimonios/" class="nav-link">Testimonios</a></li>
                    <li class="nav-item"><a href="../noticias/" class="nav-link">Noticias</a></li>
                    <li class="nav-item"><a href="../citas/" class="nav-link">Citas</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
