<?php

    require_once "patata.php";

    function filtrar($lista,$minimo){
        $resultado="";
        foreach($lista as $clave=>$valor){
            if($valor>$minimo){
                $resultado.="<p>$clave</p>";
            }
        }
        return $resultado;
    }

    function doble($numero){
        return $numero*2;
    }

    function cuenta_atras($longitud){
        $resultado="";
        for($i=$longitud;$i>0;$i--){
            $resultado.="$i<br>";
        }
        $resultado.="<h1>Boom¡¡¡</h1>";

        return $resultado;
    }
?>