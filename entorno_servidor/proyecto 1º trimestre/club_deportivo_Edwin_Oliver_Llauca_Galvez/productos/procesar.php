<?php
// Encabezados para permitir CORS y establecer el tipo de contenido
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Encabezados adicionales para solicitudes preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0);
}



// Configuración de la API externa
$apiBaseUrl = "http://localhost/FP%20daw%202/entorno_servidor/proyecto%201%c2%ba%20trimestre/club_deportivo_Edwin_Oliver_Llauca_Galvez/api/api.php"; // URL base de la API
$apiKey = "gR0WVlcNgkLLcveUs45txlxxbfiPKSwun2VIGmE9gXNiEaqAtgAhdOuo2ehy1xyR"; // Tu API key para métodos POST, PUT y DELETE

/**
 * Función para realizar llamadas a la API externa usando cURL.
 * 
 * @param string $endpoint   Endpoint relativo de la API.
 * @param string $method     Método HTTP: GET, POST, PUT, DELETE.
 * @param array  $headers    Encabezados HTTP adicionales.
 * @param mixed  $data       Datos a enviar (array para GET/POST, JSON para PUT/DELETE).
 * @return array             Arreglo con 'response' (contenido) y 'code' (código HTTP).
 */
function callApi($endpoint, $method = 'GET', $headers = [], $data = null) {
    global $apiBaseUrl;
    $url = rtrim($apiBaseUrl, '/') . '/' . ltrim($endpoint, '/');
    $ch = curl_init();

    // Si el método es GET y hay datos, se agregan como query string
    if ($method === 'GET' && !empty($data)) {
        $url .= '?' . http_build_query($data);
    }
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Configurar opciones según el método
    switch ($method) {
        case 'GET':
            // No es necesario configurar nada adicional
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_POST, true);
            // En POST usamos multipart/form-data (ideal para enviar archivos)
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;
        case 'PUT':
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if (!empty($data)) {
                $jsonData = json_encode($data);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                // Asegurarse de enviar el header de JSON
                $headers[] = "Content-Type: application/json";
            }
            break;
        default:
            // Si se usa un método no soportado
            break;
    }
    
    // Agregar encabezados si existen
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        http_response_code(500);
        echo json_encode(["error" => "cURL error: $error_msg"]);
        exit;
    }
    
    curl_close($ch);
    return ["response" => $response, "code" => $httpCode];
}


// Obtener el método HTTP de la solicitud
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        // Obtener los parámetros de la URL
        $params = $_GET;

        $queryString = http_build_query($params);

        $url = $apiBaseUrl;
        if (!empty($queryString)) {
            $url .= "?" . $queryString;
        }
        

        // Inicializar cURL para hacer la petición a la API externa
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);



        // Devolver la respuesta obtenida de la API con el código HTTP correspondiente
        http_response_code($httpCode);
        echo $response;


        // Definir el endpoint de la API a consumir, por ejemplo "productos"
        // $endpoint = "productos";
        
        // // Realizar la llamada a la API
        // $apiResult = callApi($endpoint, 'GET', [], $params);
        
        // http_response_code($apiResult['code']);
        // echo $apiResult['response'];
        break;
    
    case 'POST':
        // Validar la API key (se puede enviar vía POST o en encabezado, según tu diseño)
        if (!isset($_POST['api_key']) || $_POST['api_key'] !== $apiKey) {
            http_response_code(403);
            echo json_encode(["error" => "API key inválida"]);
            exit;
        }
        
        // Obtener datos enviados por multipart/form-data (incluyendo archivos si es necesario)
        $postData = $_POST;
        // Aquí podrías procesar $_FILES y adjuntarlo a $postData usando curl_file_create()
        
        $endpoint = "productos";
        // Incluir la API key en los encabezados si se requiere en la llamada a la API
        $headers = ["Authorization: Bearer " . $apiKey];
        
        $apiResult = callApi($endpoint, 'POST', $headers, $postData);
        
        http_response_code($apiResult['code']);
        echo $apiResult['response'];
        break;
    
    case 'PUT':
        // Para PUT se espera recibir JSON en el cuerpo de la solicitud
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['api_key']) || $input['api_key'] !== $apiKey) {
            http_response_code(403);
            echo json_encode(["error" => "API key inválida"]);
            exit;
        }
        
        $endpoint = "productos"; // O "productos/{id}" según el caso
        $headers = ["Authorization: Bearer " . $apiKey];
        
        $apiResult = callApi($endpoint, 'PUT', $headers, $input);
        
        http_response_code($apiResult['code']);
        echo $apiResult['response'];
        break;
    
    case 'DELETE':
        // Para DELETE se espera JSON en el cuerpo
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['api_key']) || $input['api_key'] !== $apiKey) {
            http_response_code(403);
            echo json_encode(["error" => "API key inválida"]);
            exit;
        }
        
        // Definir el endpoint adecuado. Por ejemplo, si se requiere eliminar un producto por id, podrías usar "productos/{id}"
        $endpoint = "productos";
        $headers = ["Authorization: Bearer " . $apiKey];
        
        $apiResult = callApi($endpoint, 'DELETE', $headers, $input);
        
        http_response_code($apiResult['code']);
        echo $apiResult['response'];
        break;
    
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método HTTP no soportado"]);
        break;
}

exit;
?>