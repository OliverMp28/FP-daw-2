<?php
// Encabezados para permitir CORS
header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes de origen
header("Content-Type: application/json");

//configuracion y funciones
require "config.php";
require_once "funciones.php";
require_once "../config/funciones.php"; // aqui traigo la funcion conectar q ya tengo

try {
    $conn = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al conectar con la base de datos"]);
    die();
}

// Determinar el método HTTP
$metodo = $_SERVER['REQUEST_METHOD'];

if( $metodo=="POST" || $metodo=="PUT"){
    $entrada=json_decode(file_get_contents("php://input"),true);
}

switch ($metodo) {
    case 'GET':
        if(isset($_GET['id'])){
            $resultado = [];
            $resultado = obtenerProducto($conn, $_GET['id']);
            http_response_code($resultado["http"]);
            echo json_encode($resultado["respuesta"]);
        }else{
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? (int)$_GET['limit'] : 10;

            //parametros de busqueda
            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
            $precioMin = isset($_GET['precio_min']) ? (float)$_GET['precio_min'] : null;
            $precioMax = isset($_GET['precio_max']) ? (float)$_GET['precio_max'] : null;
            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null; 

            //Validaciones de parametros
            if ($page < 1 || $limit < 1) {
                http_response_code(400); // Bad Request
                echo json_encode([
                    "error" => "Parámetros de paginación inválidos, el numero de pagina y el limite no pueden ser menor que 1"
                ]);
                die();
            }
            if($precioMin !== null && $precioMax !== null && $precioMin > $precioMax){
                http_response_code(400);
                echo json_encode(["error" => "precio_min no puede ser mayor que precio_max"]);
                die();
            }

            $resultado = obtenerProductosPag(
                $conn, 
                $page, 
                $limit, 
                $nombre, 
                $precioMin, 
                $precioMax, 
                $categoria
            );
            http_response_code($resultado["http"]);
            echo json_encode($resultado["respuesta"]);

        }
        

        break;
    
    case 'POST':  
        // Cambiamos a multipart/form-data para manejar archivos
        $datosProducto = $_POST;
        $imagen = $_FILES['imagen'] ?? null;

        // Validar campos obligatorios
        if (empty($datosProducto['nombre']) || !isset($datosProducto['precio']) || !isset($datosProducto['stock'])) {
            http_response_code(400);
            echo json_encode(["error" => "Campos obligatorios faltantes: nombre, precio, stock"]);
            die();
        }

        // Validar tipos de datos
        if (!is_numeric($datosProducto['precio']) || !is_numeric($datosProducto['stock'])) {
            http_response_code(400);
            echo json_encode(["error" => "Precio y stock deben ser valores numéricos"]);
            die();
        }

        // Procesar la imagen si existe
        $rutaImagen = null;
        if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
            // Validar tipo de imagen
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
            $tipoMime = mime_content_type($imagen['tmp_name']);
            
            if (!in_array($tipoMime, $tiposPermitidos)) {
                http_response_code(415);
                echo json_encode(["error" => "Formato de imagen no permitido. Use JPEG, PNG o WEBP"]);
                die();
            }

            // Validar tamaño (ej: máximo 5MB)
            if ($imagen['size'] > 5 * 1024 * 1024) {
                http_response_code(413);
                echo json_encode(["error" => "La imagen supera el tamaño máximo de 5MB"]);
                die();
            }
        }

        // Crear el producto (manejamos la imagen en la función)
        $resultado = crearProducto(
            $conn,
            $datosProducto,
            $imagen
        );

        http_response_code($resultado["http"]);
        echo json_encode($resultado["respuesta"]);
        
        break;

    case 'PUT':
        
        break;

    case 'DELETE':
        
        break;

    default:
        http_response_code(405);
        echo json_encode(["error"=>"Método no soportado :'D"]);
        
}/*

            
            */


// Cerrar la conexión
$conn->close();


?>