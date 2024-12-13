<?php

include_once "./clases/Usuario.php";

if (isset($_SESSION['_usuario'])) {
    $usuario = unserialize($_SESSION["_usuario"]);
}

?>

<header>

    <div class="logo">
        <h1>Pixela.io</h1>
    </div>

    <nav>
        <ul class="menu">
            <li><a href="#shogun">Inicio</a></li>
            <li><a href="#tendencias">Series</a></li>
        </ul>
    </nav>

    <div class="session">
        
        <a href="<?= isset($_SESSION['_usuario']) ? '#' : 'index.php'; ?>">
            <?= isset($_SESSION['_usuario']) ? $usuario  . " <a href=\"./inc/logout.php\">cerrar session</a>" : 'Iniciar sesión'; ?>
        </a>

    </div>
 
</header>
