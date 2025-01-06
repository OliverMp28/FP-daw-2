<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('https://i0.wp.com/youcinebrasil.com.br/wp-content/uploads/2022/08/netflixteaser.png?resize=768%2C432&ssl=1') no-repeat center center fixed; /* Imagen de fondo */
            background-size: cover;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        .contenedor_resultado{
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 600px;
            margin-bottom: 20px;
            color: #fff;
        }

        .contenedor_resultado, .errores{
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-family: Arial, sans-serif;
        }

        .contenedor_resultado h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contenedor_resultado p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
            line-height: 1.6;
        }

        .contenedor_resultado ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .contenedor_resultado ul li {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .contenedor_resultado strong {
            color: #28a745; 
        }

        .contenedor_resultado div {
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <?php
    require 'funciones.php'; 

        $titulo = null;
        $nombre = null;
        $fecha_visto = null;
        $puntuacion = null;
        $reseña = null;

        $errores=[];

        if (isset($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
        }
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['fecha_visto'])) {
            $fecha_visto = $_POST['fecha_visto'];
        }
        if (isset($_POST['puntuacion'])) {
            $puntuacion = $_POST['puntuacion'];
        }
        if (isset($_POST['reseña'])) {
            $reseña = $_POST['reseña'];
        }


       
        


        //---- AQUI EMPIEZO A PROCESAR Y MOSTRAR LOS DATOS OBTENIDOS -----
        // -----------------------------------------------------------

        $titulo = procesarCadena($titulo, ["ucwords", "reemplazarInapropiadas"]);

        $validacionTitulo=validarLongitud($titulo, "titulo", 3, 100);

        //reseña
        $reseña = procesarCadena($reseña, ["strtolower", "reemplazarInapropiadas"]);
        $validacionReseña = validarLongitud($reseña, "reseña", 30, 100);

        //puntuacion
        if($puntuacion < 1 || $puntuacion > 5){
            $errores[]="la puntuacion debe estar entre 1 y 5";
        }

        //fecha
        if(!validarFecha($fecha_visto)){
            $errores[]="la fecha no es valida, ha ingresado mal la fecha o tal vez es una fecha futura, y no tiene sentido haberlo visto en el futuro";
        }else{
            $diasDesdeQueLoVio=calcularDiasDesdeVista($fecha_visto);
        }

        //mostrar errores si es que hay
        if(count($errores) > 0){
            foreach($errores as $error){
                echo "<div class='errores'>";
                echo "<p class='errores'>$error<p>";
                echo "<div>";
            }
        }else{
            echo "<div class='contenedor_resultado'>";
            echo "<h2>Título: $titulo</h2>";
            echo "<p>Nombre: $nombre</p>";
            echo "<p>Fecha de vista: (".date("d-m-Y", strtotime($fecha_visto)).")</p>";
            echo "<p><strong>Dias desde que la viste: </strong> $diasDesdeQueLoVio</p>";
            echo "<p>Puntuación: $puntuacion</p>";
            echo "<p>Reseña: $reseña</p>";
            echo "<p>Días desde que lo viste: $diasDesdeQueLoVio</p>";
            echo "<p>Fecha actual: ".mostrarFechaActual()."</p><br>";

            echo "<h2>Detalles de la fecha vista👁️:</h2>";
            $detallesFecha = obtenerDetallesFecha($fecha_visto);
            echo "<ul>";
            echo "<li> Dia: ".$detallesFecha["mday"]."</li>";
            echo "<li> Mes: ".$detallesFecha["month"]."</li>";
            echo "<li> Año: ".$detallesFecha["year"]."</li>";
            echo "<div>";

        }


    ?>
</body>
</html>