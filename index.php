<?php

## Iniciar la sesión
session_start();

## Redirigir al usuario a 'home.php' si ya ha iniciado sesión
if (!empty($_SESSION)) {
    die(header("Location: home.php"));
}

require_once './clases/Conexion.php';
require_once './clases/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo_electronico = trim($_POST["email"]);
    $clave = trim($_POST["clave"]);

    try {

        ## Instanciar la conexión
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        ## Obtener el usuario
        $usuario = Usuario::obtenerPorCorreo($correo_electronico, $pdo);

        if ($usuario !== null) {

            ## Verificar la contraseña
            if (password_verify($clave, $usuario->getContrasena())) {
                ## Guardar los datos del usuario en la sesión
                $_SESSION["_tiempo"]  = time() + 30;
                $_SESSION["_usuario"] = serialize($usuario);

                ## Redirigir a la página principal
                die(header("Location: index.php"));
            } 
        } else {
            echo "No se ha encontrado el usuario<br/>";
        }
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}
?>

<!-- LOGIN -->
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixela.io - Inicio de Usuario</title>
    <link rel="stylesheet" href="./assets/style/index.css">

</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <h1>Bienvenido a Pixela | Inicio de Usuario</h1>
            <form method="POST">

                <!-- EMAIL -->
                <div class="input-group">
                    <label for="email">
                        <span class="icon_user"></span>
                        <input type="text" id="email" name="email" placeholder="Correo electrónico" required>
                    </label>
                </div>

                <!-- PASSWORD -->
                <div class="input-group">
                    <label for="clave">
                        <span class="icon_password"></span>
                        <input type="password" id="clave" name="clave" placeholder="Contraseña" required>
                    </label>
                </div>

                <button type="submit" class="submit">Iniciar</button>
            </form>
        </div>

        <div class="logo">
            <img src="./assets/img/logo_pixela.png" alt="Pixela.io Logo">
        </div>
        <p class="register-message">
            Registrate si aun no lo has hecho - <a href="registro.php">Registrar</a>
        </p>


    </div>




</body>

</html>