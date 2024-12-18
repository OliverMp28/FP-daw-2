<?php
function formulario_para_iniciar_sesion($pagina_actual){
    return "<div class='login-container'>
                            <form class='login-form' action='iniciar_sesion.php' method='POST'>
                                <label for='username'>Usuario:</label>
                                <input type='text' id='username' name='username'  placeholder='Introduce tu usuario'>
                                <label for='password'>Contraseña:</label>
                                <input type='password' id='password' name='password'  placeholder='Introduce tu contraseña'>
                                <input type='hidden' id='origen' name='origen' value='$pagina_actual'>
                                <button type='submit'>Iniciar sesión</button>
                            </form>
                        </div>";
}

function formulario_sesion_iniciada($nombre_usuario){
    return "<div class='login-container'>
                            <form class='login-form' action='cerrar_sesion.php' method='POST'>
                                 <label for=>Usuario logueado:$nombre_usuario</label>
                                <button type='submit'>Cerrar sesión</button>
                            </form>
                          </div>";
}


function menu_navegacion(){
    return "<nav>
            <ul>
                <li><a href='index.php'>Inicio</a></li>
                <li><a href='nosotros.php'>Nosotros</a></li>
                <li><a href='servicios.php'>Servicios</a></li>
                <li><a href='contacto.php'>Contacto</a></li>
                <li><a href='usuarios.php'>Usarios</a></li>
            </ul>
        </nav>";
}
function formulario_para_registro(){
    return "<div class='register-container'>
                <form class='register-form' action='registrar_usuario.php' method='POST'>
                    <label for='usuario'>Usuario:</label>
                    <input type='text' id='usuario' name='usuario' placeholder='Introduce tu usuario' required>
                    <label for='nombre_completo'>Nombre completo:</label>
                    <input type='text' id='nombre_completo' name='nombre_completo' placeholder='Introduce tu nombre completo' required>
                    <label for='password'>Contraseña:</label>
                    <input type='password' id='password' name='password' placeholder='Introduce tu contraseña' required>
                    <label for='confirm_password'>Confirma contraseña:</label>
                    <input type='password' id='confirm_password' name='confirm_password' placeholder='Confirma tu contraseña' required>
                    <button type='submit'>Registrar</button>
                </form>
            </div>";
}


function getUsuarioPorNombre($conexion, $usuario)
{
    $sentencia = "SELECT usuario, nombre_completo, password, tipo_usuario FROM usuarios WHERE usuario = ?";
    $consulta = $conexion->prepare($sentencia);

    $consulta->bind_param('s', $usuario);

    $consulta->execute();

    $usuario = $nombre_completo = $password = $tipo_usuario = '';
    $consulta->bind_result($usuario, $nombre_completo, $password, $tipo_usuario);

    $resultado = null;
    if ($consulta->fetch()) {
        $resultado = [
            'usuario' => $usuario,
            'nombre_completo' => $nombre_completo,
            'password' => $password,
            'tipo_usuario' => $tipo_usuario,
        ];
    }

    $consulta->close();
    return $resultado;
}

function registrarUsuario($conexion, $usuario, $nombre_completo, $password, $tipo_usuario = 'normal')
{
    $sentencia = "SELECT COUNT(*) FROM usuarios WHERE usuario = ?";
    $consulta = $conexion->prepare($sentencia);
    $consulta->bind_param('s', $usuario);
    $consulta->execute();

    $existe_usuario = '';
    $consulta->bind_result($existe_usuario);
    $consulta->fetch();
    $consulta->close();

    if ($existe_usuario > 0) {
        return ['status' => false, 'mensaje' => 'El usuario ya existe.'];
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sentencia = "INSERT INTO usuarios (usuario, nombre_completo, password, tipo_usuario) VALUES (?, ?, ?, ?)";
    $consulta = $conexion->prepare($sentencia);
    $consulta->bind_param('ssss', $usuario, $nombre_completo, $password_hash, $tipo_usuario);

    if ($consulta->execute()) {
        $consulta->close();
        return ['status' => true, 'mensaje' => 'Usuario registrado correctamente.'];
    } else {
        $consulta->close();
        return ['status' => false, 'mensaje' => 'Error al registrar el usuario.'];
    }
}



?>
