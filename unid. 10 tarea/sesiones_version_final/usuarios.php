<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
            .register-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .register-form {
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                box-sizing: border-box;
            }

            .register-form label {
                display: block;
                margin-bottom: 8px;
                font-weight: bold;
                color: #333;
            }

            .register-form input, select {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                box-sizing: border-box; /
            }

            .register-form button {
                width: 100%;
                padding: 10px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }

            .register-form button:hover {
                background-color: #45a049;
            }


    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <main>
            <div class='register-container'>
                <form class='register-form' action='registrar_usuario.php' method='POST'>
                    <label for='usuario'>Usuario:</label>
                    <input type='text' id='usuario' name='usuario' placeholder='Introduce tu usuario' required>

                    <label for='nombre_completo'>Nombre completo:</label>
                    <input type='text' id='nombre_completo' name='nombre_completo' placeholder='Introduce tu nombre completo' required>

                    <label for='nombre_completo'>Nombre completo:</label>
                    <select name="nombre_completo" id="nombre_completo">
                        <option value="">Seleccione tipo de usuario</option>
                        <option value="socio">Socio</option>
                        <option value="normal">Normal</option>
                    </select>

                    <label for='password'>Contraseña:</label>
                    <input type='password' id='password' name='password' placeholder='Introduce tu contraseña' required>

                    <label for='confirm_password'>Confirma contraseña:</label>
                    <input type='password' id='confirm_password' name='confirm_password' placeholder='Confirma tu contraseña' required>

                    <button type='submit'>Registrar</button>
                </form>
            </div>
    </main>
    <footer>
    <?php
        require_once "footer.php";
    ?>
    
    </footer>
</body>
</html>
