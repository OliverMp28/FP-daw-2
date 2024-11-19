<?php
    $numero = isset($_POST['numero']) ? $_POST['numero'] : 0;
    function crearTablaMultiplicar($numero){
        $html = "<table border='1'>";
        for($i = 1; $i <= $numero; $i++){
            $html.= "<tr>";
            $html.= "<td>". $numero. " x ". $i . "</td>";
            $html.= "<td>". $numero * $i. "</td>";
            $html.= "</tr>";
        }
        $html.= "</table>";
        return $html;
    }

    echo crearTablaMultiplicar($numero);
 
?>