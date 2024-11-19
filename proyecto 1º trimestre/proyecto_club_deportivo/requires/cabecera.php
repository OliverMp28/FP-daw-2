<header>
        <?php
            //echo getcwd();
            //compruebo en que nivel nos encontramos para saber si poner una ruta u otra,
            //tambien para saber que html mostrar en la cabecera, tambien inserto el titulo dependiendo de la pagina
            if($nivel == 0){
                require_once "requires/menu.php";
            }
            else if($nivel == 1){
                require_once "../requires/menu.php";
            }
        ?>
        <div class="texto_cabecera">
            <?php
                if($nivel == 0){
                    echo "<h1>Depor</h1>";
                    echo "<h2>Tu club deportivo.</h2>";
                }
                else if($nivel == 1){
                    echo "<h1>" . $titulo . "</h1>";
                }
                else{
                    echo "Error, 'nivel' no tiene un valor valido o no esta definido";
                }
            ?>
         
        </div>
        
</header>