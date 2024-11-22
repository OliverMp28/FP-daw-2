<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $titulo = null;
        $nombre = null;
        $date = null;
        $puntuacion = null;
        $reseña = null;

        if (isset($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
        }
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['fecha_visto'])) {
            $date = $_POST['fecha_visto'];
        }
        if (isset($_POST['puntuacion'])) {
            $puntuacion = $_POST['puntuacion'];
        }
        if (isset($_POST['reseña'])) {
            $reseña = $_POST['reseña'];
        }

        echo "$titulo .. $nombre .. $date .. $puntuacion ..$reseña";


        //Validar el título y la reseña:

        function validarLongitud($cadena, $min = 5, $max = 1000) {
            // Usa strlen para validar que el título y la reseña tengan una longitud mínima o máxima
            $longitud = strlen($cadena);
            if ($longitud < $min) {
                return "El texto es demasiado corto. Mínimo $min caracteres.";
            } elseif ($longitud > $max) {
                return "El texto es demasiado largo. Máximo $max caracteres.";
            }
            return true;
        }
        
        function contienePalabraClave($cadena, $palabrasClave = ["excelente", "terrible", "aburrida"]) {
            // Usa str_contains para verificar si la reseña contiene palabras clave como "bueno", "malo", etc.
            foreach ($palabrasClave as $palabra) {
                if (str_contains($cadena, $palabra)) {
                    return "La reseña contiene la palabra clave: '$palabra'.";
                }
            }
            return "No se encontraron palabras clave importantes en la reseña.";
        }

        function reemplazarPalabrasInapropiadas($cadena) {
          // Usa str_replace para reemplazar palabras inapropiadas o ajustar términos comunes
            $palabrasInapropiadas = ["mala", "horrible"];
            $sustituciones = ["no muy buena", "poco recomendable"];
            
            return str_replace($palabrasInapropiadas, $sustituciones, $cadena);
        }

        function limpiarCadena($cadena) {
            // Usa trim para limpiar espacios en blanco antes y después de las cadenas
            return trim($cadena);
        }
        
        function formatearTitulo($titulo) {
            // Usa ucwords para convertir la primera letra de cada palabra a mayúscula
            return ucwords(limpiarCadena($titulo)); // Primero limpiamos los espacios, luego formateamos
        }

        function procesarReseña($reseña) {
            // Usa explode para separar la reseña en palabras y luego implode para reconstruirla
            $palabras = explode(" ", limpiarCadena($reseña)); // Separamos por espacios
            // Aquí puedes hacer algún procesamiento en las palabras, por ejemplo:
            $palabrasProcesadas = array_map('strtolower', $palabras); // Convertir todas las palabras a minúscula
            return implode(" ", $palabrasProcesadas); // Unimos las palabras procesadas de nuevo
        }







        function validarFecha($fecha) {
            // Usa checkdate para validar si la fecha ingresada es válida
            $partes = explode("-", $fecha); // Separar la fecha en año, mes y día
            if (count($partes) == 3) {
                $year = (int)$partes[0];
                $month = (int)$partes[1];
                $day = (int)$partes[2];
                return checkdate($month, $day, $year); // Verifica si la fecha es válida
            }
            return false;
        }
        
        function obtenerDetallesFecha($fecha) {
             // Usa getdate para obtener detalles como día, mes, año de la fecha proporcionada
            $timestamp = strtotime($fecha); // Convertimos la cadena a timestamp
            return getdate($timestamp); // Obtenemos detalles como día, mes, año, etc.
        }

        function calcularDiasDesdeVista($fecha_visto) {
            // Usa mktime y strtotime para calcular cuántos días han pasado desde que se vio la película
            $timestamp_visto = strtotime($fecha_visto); // Convertir la fecha a timestamp
            $timestamp_actual = mktime(0, 0, 0, date("m"), date("d"), date("Y")); // Crear un timestamp para hoy
            $diferencia = $timestamp_actual - $timestamp_visto; // Calcular la diferencia en segundos
            return floor($diferencia / (60 * 60 * 24)); // Convertir segundos a días
        }

        function mostrarFechaActual() {
            // Usa date para mostrar la fecha actual
            return date("Y-m-d"); // Formato estándar de fecha (Año-Mes-Día)
        }
        

    ?>
</body>
</html>