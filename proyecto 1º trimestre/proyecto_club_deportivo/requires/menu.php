<nav class="navbar navbar-expand-lg">
    
    <ul class="navbar-nav ml-auto">
        <!-- si $nivel es 0 entonces coloca los li que correspondan-->
         <?php if ($nivel === 0) {?>
            <li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
            <li class="nav-item"><a href="./servicios/" class="nav-link">Servicios</a></li>
            <li class="nav-item"><a href="./testimonios/" class="nav-link">Testimonios</a></li>
            <li class="nav-item"><a href="./noticias/" class="nav-link">Noticias</a></li>
            <li class="nav-item"><a href="./citas/" class="nav-link">Citas</a></li>
        <?php }

        //  si $nivel es 1 entonces coloca los li del siguiente nivel de carpetas
         if ($nivel === 1) {?>
            <li class="nav-item"><a href="../index.php" class="nav-link">Inicio</a></li>
            <li class="nav-item"><a href="../servicios/" class="nav-link">Servicios</a></li>
            <li class="nav-item"><a href="../testimonios/" class="nav-link">Testimonios</a></li>
            <li class="nav-item"><a href="../noticias/" class="nav-link">Noticias</a></li>
            <li class="nav-item"><a href="../citas/" class="nav-link">Citas</a></li>
        <?php }?>
    </ul>
</nav>