<div class="header-content">
        <?php
                session_start();
                require_once "utilidades.php";
                echo "<h1>Bienvenido a Mi Página Web</h1>";
                $pagina_actual=basename($_SERVER['PHP_SELF']);

                // if(!isset($_SESSION['nombre']) && $pagina_actual!="index.php"){
                //         echo "<h2>No tiene derecho a estar aqui</h2>";
                //         header("Refresh:3;URL=index.php");
                //         die();
                // }

                if(isset($_SESSION['nombre'])){
                        echo formulario_sesion_iniciada($_SESSION['nombre']);
                }else{
                        echo formulario_para_iniciar_sesion($pagina_actual);
                }
        ?>
</div>        

       