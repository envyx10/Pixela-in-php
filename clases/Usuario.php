<?php

class Usuario {
    private int $id_usuario;
    private string $nombre_usuario;
    private string $contrasena;
    private string $correo_electronico;

    public function __construct() {}

    /**
     * Método estático para obtener un usuario por 
     * su correo electrónico desde la base de datos.
     *
     * @param string $correo_electronico
     * @param PDO $pdo
     * @return Usuario|null
     */
    public static function obtenerPorCorreo(string $correo_electronico, PDO $pdo): ?Usuario {
        $sql = "SELECT 
                    id_usuario, 
                    nombre_usuario, 
                    contrasena, 
                    correo_electronico 
                FROM usuarios 
                WHERE correo_electronico = :correo_electronico";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":correo_electronico", $correo_electronico, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Usuario");
            return $stmt->fetch();
        }

        return null;
    }

    /**
     * Método estático para registrar 
     * un nuevo usuario en la base de datos.
     *
     * @param string $nombre
     * @param string $correo_electronico
     * @param string $contrasena
     * @param PDO $pdo
     * @return bool
     */
    public static function registrarUsuario(string $nombre, string $correo_electronico, string $contrasena, PDO $pdo): bool
    {
        $sql = "INSERT INTO usuarios 
                            (nombre_usuario, 
                            correo_electronico, 
                            contrasena, 
                            fecha_registro) 
                VALUES (:nombre, :correo_electronico, :contrasena, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":correo_electronico", $correo_electronico, PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Getter y Setter para la propiedad id_usuario.
     *
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * Getter y Setter para la propiedad nombre_usuario.
     *
     * @return string
     */
    public function getNombreUsuario(): string
    {
        return $this->nombre_usuario;
    }

    public function setNombreUsuario(string $nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
        return $this;
    }

    /**
     * Getter y Setter para la propiedad contrasena.
     *
     * @return string
     */
    public function getContrasena(): string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena)
    {
        $this->contrasena = $contrasena;
        return $this;
    }

    /**
     * Getter y Setter para la propiedad correo_electronico.
     *
     * @return string
     */
    public function getCorreoElectronico(): string
    {
        return $this->correo_electronico;
    }

    public function setCorreoElectronico(string $correo_electronico)
    {
        $this->correo_electronico = $correo_electronico;
        return $this;
    }

    /* Para que funcione el usuario en caso de estar logueado */
    public function __toString()
    {
        return $this->getNombreUsuario();
    }
}