<?php

session_start();
require_once './clases/Conexion.php';
require_once './clases/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); # Encriptar la contraseña

    try {
        # Instanciar la conexión
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        # Registrar el usuario
        if (Usuario::registrarUsuario($nombre, $email, $password, $pdo)) {
            # Redirigir si la inserción fue exitosa
            header("Location: index.php");
            exit;
        } else {
            echo "Error al registrar el usuario.<br/>";
        }
    } catch (PDOException $e) {
        ## Manejo de errores
        echo "Error al registrar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./assets/style/index.css">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="./assets/svg/users/Logo.svg" alt="Logo Pixela">
            <p>¡Regístrate y comienza a disfrutar de nuestras series y películas!</p>
        </div>
        <div class="login-box">
            <h1>Registro</h1>
            <form method="POST">
                <div class="input-group">
                    <label for="nombre">
                        <span class="icon icon_user"></span>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="email">
                        <span class="icon icon_user"></span>
                        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="password">
                        <span class="icon icon_password"></span>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </label>
                </div>
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>
