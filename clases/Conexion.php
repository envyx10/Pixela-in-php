<?php

class Conexion {

    ## constantes definidas 
    ## para la conexión a la base de datos
    private const SERVERNAME = "db";
    private const USERNAME   = "root";
    private const PASSWORD   = "";
    private const DBNAME     = "pixeladb";
    private const CHARSET    = "utf8mb4";

    public function __construct() {}


    /**
     *  ## Método para obtener la conexión con la base de datos
     *  ## Usamos las constantes definidas anteriormente para una mayor 
     *  ## facilidad a la hora de poder modificar datos
     * @return 
     */
    public function getConexion() {
        
        try {

            ## Datos de mi base de datos
            $dsn = "mysql:host=" . self::SERVERNAME . ";dbname=" . self::DBNAME . ";charset=" . self::CHARSET;

            ## Crear la conexión con PDO
            $conn = new PDO($dsn, self::USERNAME, self::PASSWORD);

            ## Configurar modo de errores para que sea más fácil detectar problemas
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage()); 
        }
    }
}

?>
