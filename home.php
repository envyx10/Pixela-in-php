<?php

session_start();

if (!empty($_SESSION)):
    include_once "./inc/session.php";
endif;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixela.io</title>
    <link rel="stylesheet" href="./assets/style/home.css">
</head>

<body>

    <header> <?php require_once './inc/nav.php'; ?> </header>

    <section id="shogun">
        <div class="shogun-item active">
            <img src="./assets/img/Header.jpg" alt="Shogun">
        </div>
    </section>

    <?php

        include_once "./clases/Api.php"; 

        try {
            
            $api = new Api();

            ## Sincronizo las series desde la API a la base de datos
            ## Por legibilidad las he includo de manera modulable en mi clase Api
            $api->sincronizarSeries();

            ## Obtener las series combinadas (API + base de datos)
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $sql_series = "SELECT * FROM series ORDER BY fecha_registro DESC LIMIT 20";
            $series_bd = $conn->query($sql_series)->fetchAll(PDO::FETCH_ASSOC);

            ## Formatear datos de las series para la vista
            $data = $api->getTrendingSeries();
            $series_combinadas = array_map(function ($serie) {
                return [
                    'id' => $serie['serie_id'] ?? $serie['id'],
                    'name' => $serie['titulo'] ?? $serie['name'],
                    'overview' => $serie['sinopsis'] ?? $serie['overview'],
                    'poster_path' => $serie['imagen_url'] ?? "https://image.tmdb.org/t/p/w1280" . $serie['poster_path'],
                    'vote_average' => $serie['puntuacion'] ?? $serie['vote_average'],
                ];
            }, array_merge($data['results'], $series_bd));
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }

    ?>

    <section id="series-destacadas">
        <h2>TENDENCIAS</h2>
        <div class="carousel">
            <div class="carousel-track">
                <?php
                foreach ($series_combinadas as $serie):
                    $posterPath = isset($serie['poster_path']) && $serie['poster_path'] 
                        ? $serie['poster_path'] 
                        : "assets/img/placeholder.png";
                    $title = htmlspecialchars($serie['name'], ENT_QUOTES, 'UTF-8');
                    $serieId = $serie['id'];
                    echo "<div class='carousel-item'> 
                            <a href='ficha.php?id={$serieId}'> 
                                <img src='{$posterPath}' alt='{$title}' loading='lazy'> 
                            </a> 
                          </div>";
                endforeach;
                ?>
            </div>
        </div>

        <!-- Controles del carrusel -->
        <div id="tendencias" class="carousel-controls">
            <button class="carousel-control prev">
                <svg width="79" height="80" viewBox="0 0 79 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36.2085 23.334L19.7502 40.0007L36.2085 56.6674" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M59.2502 23.3341L42.7919 40.0008L59.2502 56.6674" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button class="carousel-control next">
                <svg width="79" height="80" viewBox="0 0 79 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M42.7915 56.6659L59.2498 39.9992L42.7915 23.3326" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M19.7498 56.6659L36.2081 39.9992L19.7498 23.3326" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </section>

    <script src="./assets/js/slide.js"></script>

</body>

</html>
