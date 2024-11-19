<?php
 function validarLongitud($cadena, $min = 5, $max = 1000) {
    $longitud = strlen($cadena);
    if ($longitud < $min) {
        return "Error, El texto es demasiado corto. minimo $min caracteres.";
    } elseif ($longitud > $max) {
        return "El texto es demasiado largo. maximo $max caracteres.";
    }
    return true;
}

function contienePalabraClave($cadena, $palabrasClave = ["excelente", "terrible", "aburrida"]) {
    foreach ($palabrasClave as $palabra) {
        if (str_contains($cadena, $palabra)) {
            return "La reseña contiene la palabra clave: '$palabra'.";
        }
    }
    return "No se encontraron palabras clave importantes en la reseña.";
}

//esta funcion la uso por si alguien pone paalabras fuertes o sensurables tal vez
function reemplazarPalabrasInapropiadas($cadena) {
    $palabrasInapropiadas = ["horrible", "horrenda", "basura", "asquerosa", "mierda"];
    $sustituciones = ["no muy buena", "poco recomendable", "terrible", "mala", "mala"];
    
    return str_replace($palabrasInapropiadas, $sustituciones, $cadena);
}

function limpiarCadena($cadena) {
    return trim($cadena);
}

function formatearTitulo($titulo) {
    return ucwords(limpiarCadena($titulo)); 
}






function procesarReseña($reseña) {
    $palabras = explode(" ", limpiarCadena($reseña));
    $palabrasProcesadas = array_map('strtolower', $palabras); 
    return implode(" ", $palabrasProcesadas); 
}

function procesarCadena($cadena, $operaciones = []) {
    $cadena = limpiarCadena($cadena); 
    
    //Aplicar operaciones solicitadas
    foreach ($operaciones as $operacion) {
        switch ($operacion) {
            case "ucwords":
                $cadena = ucwords($cadena);
                break;
            case "strtolower":
                $cadena = strtolower($cadena);
                break;
            case "reemplazarInapropiadas":
                $cadena = reemplazarPalabrasInapropiadas($cadena);
                break;
        }
    }
    
    return $cadena;
}






function validarFecha($fecha) {
    $partes = explode("-", $fecha); 

    if (count($partes) == 3) {
        $year = (int)$partes[0];
        $month = (int)$partes[1];
        $day = (int)$partes[2];

        if (checkdate($month, $day, $year)) {
            $fechaActual = date("Y-m-d");

            if ($fecha <= $fechaActual) {
                return true; 
            }
        }
    }
    return false; 
}


function obtenerDetallesFecha($fecha) {
    $timestamp = strtotime($fecha); 
    return getdate($timestamp); 
}

function calcularDiasDesdeVista($fecha_visto) {
    $tiempo_visto = strtotime($fecha_visto); 
    $actualidad = mktime(0, 0, 0, date("m"), date("d"), date("Y")); 
    $diferencia = $actualidad - $tiempo_visto; 
    return ($diferencia / (60 * 60 * 24)); 
}

function mostrarFechaActual() {
    
    return date("Y-m-d"); 
}
?>