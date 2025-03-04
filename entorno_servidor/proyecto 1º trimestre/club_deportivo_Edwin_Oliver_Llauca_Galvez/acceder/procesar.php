
<?php
    require_once "../config/init.php";
    require_once "../funciones/funcionesAcceder.php";


    header("Content-Type: application/json");
    $response = [
        "message" => "",
        "type" => "",
        "redirect" => null
    ];
    
    if (isset($_POST['usuario'], $_POST['password'], $_POST['tipo_usuario'])) {
    
        $usuario      = trim($_POST['usuario']);
        $password     = $_POST['password'];
        $tipo_usuario = trim($_POST['tipo_usuario']);
    
        // Usamos la función para verificar las credenciales
        $socio = verificarCredenciales($conexion, $usuario, $tipo_usuario, $password);
    
        if ($socio !== null) {
            $_SESSION['id'] = $socio['id'];
            $_SESSION['usuario'] = $socio['usuario'];
            $_SESSION['tipo_usuario'] = $tipo_usuario;
            $_SESSION['nombre'] = $socio['nombre'];
    
            $response["message"] = "Acceso correcto.";
            $response["type"] = "success";
            $response["redirect"] = "./index.php";
        } else {
            $response["message"] = "Error: Usuario no encontrado o contraseña incorrecta";
            $response["type"] = "danger";
        }
    } else {
        $response["message"] = "Error: No se han enviado todos los campos requeridos";
        $response["type"] = "danger";
    }
    
    echo json_encode($response);
?>
    