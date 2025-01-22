<?php
// Encabezados para permitir CORS
header("Access-Control-Allow-Origin: *"); // Permite todas las solicitudes de origen
header("Content-Type: application/json"); // Establecer tipo de contenido en JSON

// Configuración de la base de datos
require "config.php";
require "funciones.php";

try{
    $conn = conectar($nombre_host, $nombre_usuario, $password_db, $nombre_db);
}catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al conectar con la base de datos!!!!!!!!!!!!!"]);
    die();
}

$metodo = $_SERVER["REQUEST_METHOD"];

if($metodo == "GET"){
    $precio_limite = $_GET["price"] ?? null;
    $busqueda_nombre = $_GET["title"] ?? null;
    $marca = $_GET["company"] ?? null;

    $condicion_filtro = "";
    $tipos = "";
    $parametros = [];

    if(isset($busqueda_nombre)){
        $condicion_filtro .= $condicion_filtro ? " title LIKE ? " : " AND title LIKE ? ";
        $tipos .= "s";
        $parametros[] = "%$busqueda_nombre%";
    }

    if(isset($marca)){
        $condicion_filtro.= $condicion_filtro==""? " company LIKE ? " : "AND 'company' LIKE ? ";
        $tipos .= "s";
        $parametros[] = "%$marca%";
    }



    if(isset($precio_limite)){
        if(is_numeric($precio_limite)){
            $condicion_filtro .= $condicion_filtro == ""?   " price <= ?" : 
                                                            " AND 'price' <= ?";
            $tipos .= "d";
            $parametros[] = (float)$precio_limite;
        }else{
            http_response_code(400); //bad request
            echo json_encode(["error" => "El precio tiene que ser un numero float"]);
            die();
        }
    }

    
    $consulta = $condicion_filtro != ""? "SELECT * FROM $tabla_muebles WHERE $condicion_filtro" :
                                           "SELECT * FROM $tabla_muebles"; 

    // $consulta = "SELECT * FROM $tabla_muebles 
    //                WHERE     $condicion_filtro";
                //  WHERE price<? AND title LIKE ? AND company LIKE ?";
    $sentencia = $conn->prepare($consulta);

    if($tipos!=""){
        $sentencia -> bind_param($tipos, ...$parametros);
    }
    
    
    $sentencia->execute();
    $resultado = $sentencia->get_result();

    if($resultado -> num_rows > 0){
        $muebles=[];
        while($fila = $resultado->fetch_assoc()){
                $muebles[$fila["id"]]=  [
                    "id" => $fila["id"],
                    "title" => $fila["title"],
                    "company" => $fila["company"],
                    "image" => $fila["image"],
                    "price" => (float)$fila["price"]
                ];
            }

         
        http_response_code(200);
        echo json_encode(["size" => count($muebles), 
                                "data"=>$muebles,
                                "time" => date("Y-m-d H:i:s"),
                                "page" => 1,
                                "total_pages" => 1,
                                "size_page" => 10]);
    }else{
        http_response_code(404);
        // echo var_export($parametros);
        echo json_encode(["error" => "No hay resultados"]);
        die();
    }

}else{
    http_response_code(405);
    echo json_encode(["error" => "Metodo no permitido"]);
    die();
}

$conn->close();

?>