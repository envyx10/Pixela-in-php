<?php

class Ficha {

    private $serie_id;
    private $api; ## Instancia de Api para manejar las solicitudes

    /** 
     * Constantes para 
     * los idiomas posibles y de esta manera poder 
     * modificarlos facilmente en caso de querer cambiarlos
     */
    const IDIOMA_ES = 'es-ES';
    const IDIOMA_EN = 'en-US';

    /**
     * Constructor que inicializa el ID de la serie y una instancia de Api.
     *
     * @param int $serie_id ID de la serie para trabajar con los detalles.
     * @param Api $api Instancia de la clase Api para realizar solicitudes.
     */
    public function __construct($serie_id, Api $api) {
        $this->serie_id = $serie_id;
        $this->api = $api;
    }

    /**
     * Obtiene los detalles de la serie en el idioma especificado.
     *
     * @param string $language Código del idioma para la solicitud (por defecto es 'es-ES').
     * @return array Los detalles de la serie como array asociativo.
     */
    public function getDetails($idioma = self::IDIOMA_ES) {
        $endpoint = 'tv/' . $this->serie_id;
        return $this->api->request($endpoint, ['language' => $idioma]);
    }

    /**
     * Obtiene los créditos (actores, directores, etc.) de la serie.
     *
     * @return array Los créditos de la serie como array asociativo.
     */
    public function getCredits() {
        $endpoint = 'tv/' . $this->serie_id . '/credits';
        return $this->api->request($endpoint, ['language' => self::IDIOMA_ES]);
    }
}
