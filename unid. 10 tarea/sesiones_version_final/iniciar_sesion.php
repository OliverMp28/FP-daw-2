<?php
    // session_start();

    // if($_POST["username"]=="admin" && $_POST["password"]=="admin"){
    //     $_SESSION["nombre"]=$_POST["username"];
    //     $_SESSION["tipo"]="admin";
    // }else{
    //     $_SESSION["nombre"]=$_POST["username"];
    //     $_SESSION["tipo"]="normal";
    // }
    

    // header("Location:$_POST[origen]");
?> 

<?php
    session_start();
    require_once "conexion.php";

    if (isset($_POST["username"], $_POST["password"])) {
        $conexion = conectar();

        $usuario = $_POST['username'];
        $password = $_POST['password'];
        $pagina_origen = $_POST['origen'];
        $mensaje = "";

        $datos = getUsuarioPorNombre($conexion, $usuario);

        if ($datos) {
            if (password_verify($password, $datos['password'])) {
                $_SESSION['nombre'] = $datos['nombre_completo'];
                $_SESSION['tipo'] = $datos['tipo_usuario'];
            } else {
                $mensaje = "Contraseña incorrecta";
            }
        } else {
            $mensaje = "Usuario no encontrado";
            
        } 
        $_SESSION['mensaje'] = $mensaje;
    } 

    header("Location: index.php");
    die();
?>