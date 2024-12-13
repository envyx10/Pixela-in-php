<?php

if ((empty($_SESSION)) || (time() >= $_SESSION["_tiempo"])):
    
    $_SESSION = [];
    die(header("location: http://localhost:8080/proyecto_pixela/home.php")); 

else: $_SESSION["_tiempo"]  = time() + 300; ## Añadimos minutos extra cada vez que nos movamos por la página

endif;
