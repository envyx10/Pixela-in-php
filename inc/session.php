<?php

if ((empty($_SESSION)) ||
    (time() >= $_SESSION["_tiempo"])
):
    $_SESSION = [];
    die(header("location: http://localhost:8080/proyecto_pixela/home.php")); 
    # mejor redirigir al logout
    
endif;
