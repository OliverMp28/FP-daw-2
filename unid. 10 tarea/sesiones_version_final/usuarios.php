<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
   
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <main>
        <?php
            require_once 'utilidades.php';
            require_once 'conexion.php';
            $conexion = conectar();

            if (!isset($_SESSION['tipo'])) {
                echo formulario_para_registro();
            } else {
                if ($_SESSION['tipo'] === 'admin') {
                    echo "<h1>Gestión de Usuarios</h1>";

                    $usuarios = getTodosUsuarios($conexion);
                
                    if (!empty($usuarios)) {
                        echo "<table class='tabla-usuarios'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Nombre Completo</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        foreach ($usuarios as $usuario) {
                            $id = $usuario['id'];
                            $login = $usuario['usuario'];
                            $nombre_completo = $usuario['nombre_completo'];
                            $tipo_usuario = $usuario['tipo_usuario'];
                
                            echo "<tr>
                                    <td>{$id}</td>
                                    <td>{$login}</td>
                                    <td>{$nombre_completo}</td>
                                    <td>{$tipo_usuario}</td>

                         
                                    <td>";
                                    if($tipo_usuario=="admin"){
                                        echo "no se puede borrar un admin";
                                    } else{
                                        echo "<form action='borrar_usuario.php' method='POST'>
                                                <input type='hidden' name='id_usuario' value='$id'>
                                                <button type='submit'>Eliminar</button>
                                            </form>";
                                    }
                                        
                            echo "</td>
                                </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No hay usuaris</p>";
                    }
                } else {
                    $usuario_actual = $_SESSION['usuario']; 
            
                    if ($_SESSION['usuario']) {
                        echo "<h1>Gestion de Usuario</h1>";
                        echo formulario_para_modificar($_SESSION['usuario'], $_SESSION['nombre']);
                    } else {
                        echo "<p>Error: No se pudieron cargar los datos del usuario.</p>";
                    }
                }
            }
        ?>

    </main>
    <footer>
    <?php
        require_once "footer.php";
    ?>
    
    </footer>
</body>
</html>
