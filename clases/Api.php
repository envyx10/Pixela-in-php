<?php

include_once "./clases/Conexion.php";

class Api {

    private $api_key;
    private $base_url = 'https://api.themoviedb.org/3/';

    private const DEFAULT_LANGUAGE = 'es-ES';
    private const DEFAULT_TIME = 'week';

    public function __construct(){
        $this->api_key = '### la mantengo privada ###';
    }

    /**
     * Realiza una solicitud a un endpoint específico de la API.
     *
     * @param string $endpoint El endpoint al que se realizará la solicitud.
     * @param array $params Parámetros opcionales que se agregarán a la URL como query string.
     * @return array La respuesta de la API decodificada como un array asociativo.
     *
     *
     * 
     */
    public function request($endpoint, $params = []){
        $url = $this->base_url . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->api_key,
            'Accept: application/json',
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            die('Error en la solicitud: ' . curl_error($ch));
        }

        curl_close($ch);

        $decodedResult = json_decode($result, true);

        if ($decodedResult === null) {
            die('Error al decodificar la respuesta de la API: ' . $result);
        }

        return $decodedResult;
    }

    /**
     * Funcion para coger las series trending de la semana de la Api, estas cogen el 
     * valor de mis constantes en este caso en idioma Español y una actualizacion por semana
     * 
     *     private const DEFAULT_LANGUAGE = 'es-ES';
     *     private const DEFAULT_TIME = 'week';
     *
     * @param [type] $language
     * @param [type] $timeWindow
     * @return void
     */
    public function getTrendingSeries($language = self::DEFAULT_LANGUAGE, $timeWindow = self::DEFAULT_TIME)
    {
        return $this->request('trending/tv/' . $timeWindow, [
            'language' => $language,
        ]);
    }

     /**
     * Sincroniza las series de la API con la base de datos.
     *
     * Este método maneja la inserción y actualización de datos
     * obtenidos de la API en la tabla `series` de la base de datos.
     * @return void
     */
    public function sincronizarSeries() {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        $data = $this->getTrendingSeries();
        if (!isset($data['results']) || empty($data['results'])) {
            throw new Exception("No se encontraron series en tendencias en este momento.");
        }

        foreach ($data['results'] as $serie) {
            $datosSerie = [
                ':serie_id' => $serie['id'],
                ':titulo' => $serie['name'],
                ':sinopsis' => $serie['overview'],
                ':anio_estreno' => isset($serie['first_air_date']) ? substr($serie['first_air_date'], 0, 4) : 'Desconocido',
                ':puntuacion' => $serie['vote_average'] ?? 'No disponible',
                ':imagen_url' => isset($serie['poster_path']) && $serie['poster_path']
                    ? "https://image.tmdb.org/t/p/w1280" . $serie['poster_path']
                    : "assets/img/placeholder.png"
            ];

            $sql_verificar = "SELECT * FROM series WHERE serie_id = :serie_id";
            $verificar = $conn->prepare($sql_verificar);
            $verificar->bindParam(':serie_id', $serie['id'], PDO::PARAM_INT);
            $verificar->execute();

            if ($verificar->rowCount() === 0) {

                $sql_insertar = "INSERT INTO series 
                                            (serie_id, 
                                            titulo, 
                                            sinopsis, 
                                            anio_estreno, 
                                            puntuacion, 
                                            imagen_url, 
                                            fecha_registro) 
                                VALUES (:serie_id, :titulo, :sinopsis, :anio_estreno, :puntuacion, :imagen_url, NOW())";
                $stmt = $conn->prepare($sql_insertar);

            } else {

                $sql_actualizar = "UPDATE series SET 
                                          titulo = :titulo, 
                                          sinopsis = :sinopsis, 
                                          anio_estreno = :anio_estreno, 
                                          puntuacion = :puntuacion, 
                                          imagen_url = :imagen_url, 
                                          fecha_registro = NOW()
                                    WHERE serie_id = :serie_id";
                $stmt = $conn->prepare($sql_actualizar);
            }

            $stmt->execute($datosSerie);

        }
    }
}
