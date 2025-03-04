
<?php
require_once "../config/init.php";
require_once "../funciones/funcionesSocios.php";

header("Content-Type: application/json");

// Verificar si es una actualizacion(modificacion) o una creacion de un socio comprobando si llego una id
if (isset($_POST['idSocio'])) {
    $idSocio = intval($_POST['idSocio']);
    $nombre = trim($_POST['nombreSocio']);
    $edad = intval($_POST['edadSocio']);
    $usuario = trim($_POST['usuarioSocio']);
    $telefono = trim($_POST['telefonoSocio']);
    $password = trim($_POST['passwordSocio']); // Puede venir vacio

    // Si se ingresa una nueva contraseña, se hashea.
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Si está vacío, se mantiene la contraseña actual.
        // Puedes obtenerla consultando la BD o tenerla disponible de otra forma.
        // Por ejemplo, llamando a una función que la recupere:
        $password = getContrasenaPorId($conexion, $idSocio);
    }

    // Procesar la foto, igual que lo tienes:
    if (isset($_FILES['fotoSocio']) && strlen($_FILES['fotoSocio']['name']) > 0) {
        $foto = $_FILES['fotoSocio'];
        $directorioDestino = 'assets/img/';
        $nombreFoto = basename($foto['name']);
        $rutaFoto = $directorioDestino . time() . "_" . $nombreFoto;
    
        if (!move_uploaded_file($foto['tmp_name'], "../" . $rutaFoto)) {
            $response["message"] = "error: No se pudo mover la foto a la carpeta especificada";
            $response["type"] = "error";
            echo json_encode($response);
            die();
        }
    } else {
        // Si no se subió una nueva foto, mantener la existente, enviaremos null
        $rutaFoto = null;
    }

    $resultado = modificarSocioPorId($conexion, $idSocio, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto);

    if ($resultado) {
        $response["message"] = "Datos del socio actualizados exitosamente.";
        $response["type"] = "success";
    } else {
        $response["message"] = "Error: No se pudieron actualizar los datos del socio. Verifica los datos ingresados.";
        $response["type"] = "error";
    }
}


elseif (isset($_POST['nombreSocio'], $_POST['edadSocio'], $_POST['usuarioSocio'], $_POST['passwordSocio'], $_POST['telefonoSocio'], $_FILES['fotoSocio'])) {
    // Crear nuevo socio
    $nombre = trim($_POST['nombreSocio']);
    $edad = intval($_POST['edadSocio']);
    $usuario = trim($_POST['usuarioSocio']);
    $password = trim($_POST['passwordSocio']);
    $telefono = trim($_POST['telefonoSocio']);

    //codifico la contraseña usando password_hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    $foto = $_FILES['fotoSocio'];
    $directorioDestino = 'assets/img/';
    $nombreFoto = basename($foto['name']);
    $rutaFoto = $directorioDestino . time() . "_" . $nombreFoto;

    if (!move_uploaded_file($foto['tmp_name'], "../" . $rutaFoto)) {
        $response["message"] = "Error: No se pudo mover la foto a la carpeta especificada.";
        $response["type"] = "error";
        echo json_encode($response);
        die();
    }

    $resultado = crearSocio($conexion, $nombre, $edad, $usuario, $password, $telefono, $rutaFoto);

    if ($resultado) {
        $response["message"] = "Socio registrado exitosamente.";
        $response["type"] = "success";
    } else {
        $response["message"] = "Error: No se pudo registrar el socio. Verifica los datos ingresados.";
        $response["type"] = "error";
    }
} else {
    $response["message"] = "Error: Faltan datos necesarios.";
    $response["type"] = "error";
}

echo json_encode($response);
?>