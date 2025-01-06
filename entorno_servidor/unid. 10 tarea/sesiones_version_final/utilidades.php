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
function formulario_para_registro()
{
    $mensaje = isset($_SESSION['mensaje']) ? "<p class='error'>{$_SESSION['mensaje']}</p>" : '';
    if (isset($_SESSION['mensaje'])) {
        $_SESSION['mensaje'] = '';
    }
    return "<div class='contenedor-registro'>
                <form class='formulario' action='registrar_usuario.php' method='POST'>
                    $mensaje
                    <label for='usuario'>Usuario:</label>
                    <input type='text' id='usuario' name='usuario' placeholder='Introduce tu usuario' required>
                    <label for='nombre_completo'>Nombre completo:</label>
                    <input type='text' id='nombre_completo' name='nombre_completo' placeholder='Introduce tu nombre completo' required>
                    <label for='password'>Contraseña:</label>
                    <input type='password' id='password' name='password' placeholder='Introduce tu contraseña' required>
                    <label for='confirm_password'>Confirma contraseña:</label>
                    <input type='password' id='confirm_password' name='confirm_password' placeholder='Confirma tu contraseña' required>
                    <label for='tipo_usuario'>Tipo de usuario:</label>
                    <select id='tipo_usuario' name='tipo_usuario' required>
                        <option value='0' disabled selected>Selecciona un tipo de usuario</option>
                        <option value='normal'>Normal</option>
                        <option value='socio'>Socio</option>
                    </select>
                    <button type='submit'>Registrar</button>
                </form>
            </div>";
}

function formulario_para_modificar($usuario, $nombre_completo)
{
    $mensaje = isset($_SESSION['mensaje']) ? "<p class='error'>{$_SESSION['mensaje']}</p>" : '';
    if (isset($_SESSION['mensaje'])) {
        $_SESSION['mensaje'] = '';
    }
    return "<div class='contenedor-modificar'>
                <form action='registrar_usuario.php' method='POST'>
                    $mensaje
                    <h2>Modificar tus datos</h2>
                    <input type='hidden' name='is_modificacion' value='1'>
                    <label for='usuario'>Usuario:</label>
                    <input type='text' id='usuario' name='usuario' value='$usuario' required readonly>
                    <label for='nombre_completo'>Nombre completo:</label>
                    <input type='text' id='nombre_completo' name='nombre_completo' value='$nombre_completo' required>
                    <label for='password'>Nueva contraseña :</label>
                    <input type='password' id='password' name='password'>
                    <label for='confirm_password'>Confirma nueva contraseña:</label>
                    <input type='password' id='confirm_password' name='confirm_password'>
                    <button type='submit'>Actualizar</button>
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

    $existe_usuario = 0;
    $consulta->bind_result($existe_usuario);

    $consulta->fetch();
    $consulta->close();

    if ($existe_usuario > 0) {
        return false; 
        //aca si existe ususarios entonces no registrar y retornar false
    }

    $password_hasheado = password_hash($password, PASSWORD_DEFAULT);
    $sentencia = "INSERT INTO usuarios (usuario, nombre_completo, password, tipo_usuario) VALUES (?, ?, ?, ?)";
    $consulta = $conexion->prepare($sentencia);
    $consulta->bind_param('ssss', $usuario, $nombre_completo, $password_hasheado, $tipo_usuario);

   // die("llego aquiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii");
    $resultado = $consulta->execute();
    $consulta->close();

    return $resultado;
}

function actualizarUsuario($conexion, $usuario, $nombre_completo, $password = null)
{
    if ($password) {
        $password_hasheado = password_hash($password, PASSWORD_DEFAULT);
        $sentencia = "UPDATE usuarios SET nombre_completo = ?, password = ? WHERE usuario = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('sss', $nombre_completo, $password_hasheado, $usuario);
    } else {
        $sentencia = "UPDATE usuarios SET nombre_completo = ? WHERE usuario = ?";
        $consulta = $conexion->prepare($sentencia);
        $consulta->bind_param('ss', $nombre_completo, $usuario);
    }

    $resultado = $consulta->execute();
    $consulta->close();

    return $resultado;
}

function getTodosUsuarios($conexion)
{
    $sentencia = "SELECT id, usuario, nombre_completo, tipo_usuario FROM usuarios";
    $consulta = $conexion->prepare($sentencia);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $usuarios = [];
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }

    $consulta->close();
    return $usuarios;
}




?>
