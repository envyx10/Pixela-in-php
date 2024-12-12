<?php

require_once 'Conexion.php';

class Review {

    private $conexion;

    public function __construct() {
        $conexionObj = new Conexion();
        $this->conexion = $conexionObj->getConexion();
    }

    
    /**
     * Undocumented function
     *
     * @param [type] $id_usuario
     * @param [type] $serie_id
     * @param [type] $titulo
     * @param [type] $resena
     * @param [type] $puntuacion
     * @return void
     */
    public function addReview($id_usuario, $serie_id, $titulo, $resena, $puntuacion) {
        try {
            $sql = "INSERT INTO resenias 
                                (id_usuario, 
                                serie_id, 
                                titulo, 
                                resenia, 
                                puntuacion) 
                    VALUES (:id_usuario, :serie_id, :titulo, :resenia, :puntuacion)";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':serie_id', $serie_id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':resenia', $resena, PDO::PARAM_STR);
            $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $serie_id
     * @return array
     */
    public function getReviewsBySerieId($serie_id){
        try {
            $sql = "SELECT r.*, u.nombre_usuario 
                        FROM resenias r
                        JOIN usuarios u ON r.id_usuario = u.id_usuario
                    WHERE r.serie_id = :serie_id
                    ORDER BY r.fecha_resenia DESC";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':serie_id', $serie_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }


    /**
     * método para obtener una reseña por su ID
     *
     * @param [type] $id_resenia
     * @return void
     */
    public function getReviewById($id_resenia) {
        try {
            $sql = "SELECT r.*, u.nombre_usuario 
                        FROM resenias r
                        JOIN usuarios u ON r.id_usuario = u.id_usuario
                    WHERE r.id_resenia = :id_resenia
                    LIMIT 1";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_resenia', $id_resenia, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }


    /**
     * Método para actualizar una reseña
     *
     * @param [type] $id_resenia
     * @param [type] $id_usuario
     * @param [type] $titulo
     * @param [type] $resena
     * @param [type] $puntuacion
     * @return void
     */
    public function updateReview($id_resenia, $id_usuario, $titulo, $resena, $puntuacion) {
        try {
            $sql = "UPDATE resenias 
                    SET titulo = :titulo, 
                    resenia = :resenia, 
                    puntuacion = :puntuacion
                    WHERE id_resenia = :id_resenia AND id_usuario = :id_usuario";

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
            $stmt->bindParam(':resenia', $resena, PDO::PARAM_STR);
            $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);
            $stmt->bindParam(':id_resenia', $id_resenia, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

            return $stmt->execute();
    
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Método para eliminar una reseña
     *
     * @param [type] $id_resenia
     * @return void
     */
    public function deleteReview($id_resenia) {
        try {
            $sql = "DELETE 
                    FROM resenias 
                    WHERE id_resenia = :id_resenia";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_resenia', $id_resenia, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
