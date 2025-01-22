<?php
// Inicializar cURL
$ch = curl_init();

// URL de la API
$url = 'http://www.rtve.es/api/noticias.json';

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //para obtener la respuesta
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type' => 'application/json',
    'Authorization' => 'Bearer YOUR_API_KEY',
    'Accept' => 'application/json'
));

// Ejecutar la solicitud
$respuesta = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpCode != 200) {
    echo "ERROR:".$httpCode;
} else {
// Convertir la respuesta JSON a un array de PHP
    $datos = json_decode($respuesta, true);
}
    // Mostrar los datos (o procesarlos como sea necesario)
print_r($datos);

// Cerrar la sesión de cURL
curl_close($ch);