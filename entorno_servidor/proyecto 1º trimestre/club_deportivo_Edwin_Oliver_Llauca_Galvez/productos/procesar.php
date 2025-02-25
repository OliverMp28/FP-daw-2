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
        // Recoger los datos enviados por multipart/form-data
        $postData = $_POST;
        // Si se incluye la api_key en el formulario, se puede eliminar del array,
        // ya que la API se encarga de su validación.
        if (isset($postData['api_key'])) {
            unset($postData['api_key']);
        }
        
        // Procesar el archivo, por ejemplo, si el campo del formulario se llama "imagen"
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tmpName  = $_FILES['imagen']['tmp_name'];
            $fileName = $_FILES['imagen']['name'];
            $fileType = $_FILES['imagen']['type'];
            // Crear un objeto curl_file para que cURL lo envíe correctamente
            $postData['imagen'] = curl_file_create($tmpName, $fileType, $fileName);
        }
        
        // Definir la URL de la API
        $url = $apiBaseUrl;
        
        // Incluir la API key en el header usando X-API-KEY
        $headers = [
            "X-API-KEY: " . $apiKey
        ];
        
        // Inicializar cURL para hacer la petición POST a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        // Devolver la respuesta obtenida de la API con el código HTTP correspondiente
        http_response_code($httpCode);
        echo $response;
        break;
    
    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        
        $url = $apiBaseUrl;
        
        // Preparar los encabezados, incluyendo el Content-Type y la API key en X-API-KEY
        $headers = [
            "Content-Type: application/json",
            "X-API-KEY: " . $apiKey
        ];
        
        // Inicializar cURL para realizar la petición PUT a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        //Enviando contenido en formato JSON, codificando los datos recibidos
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        http_response_code($httpCode);
        echo $response;
        break;
        
    
    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Validar que se haya enviado el id del producto
        if (!isset($input['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "No se proporcionó el ID del producto"]);
            exit;
        }
        
        $id = (int) $input['id'];
        
        // Construir la URL para la petición a la API (por GET)
        $url = $apiBaseUrl . "?id=" . $id;
        
        // Preparar los encabezados. Se incluye el header X-API-KEY como requiere la API.
        $headers = [
            "Content-Type: application/json",
            "X-API-KEY: " . $apiKey
        ];
        
        // Inicializar cURL para realizar la petición DELETE a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        //Ejecutamos
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        http_response_code($httpCode);
        echo $response;
        break;
        
    
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método HTTP no soportado"]);
        break;
}

exit;
?>