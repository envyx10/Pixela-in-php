<?php
session_start();

require_once 'clases/Api.php';
require_once 'clases/Ficha.php';
require_once 'clases/Review.php';
require_once 'clases/Usuario.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Serie no especificada.</p>";
    die();
}

$serie_id = $_GET['id'];
$api   = new Api();
$ficha = new Ficha($serie_id, $api);

$serie_detalles = $ficha->getDetails(Ficha::IDIOMA_ES);

if (empty($serie_detalles['overview'])) {
    $serie_detalles = $ficha->getDetails(Ficha::IDIOMA_EN);
}

$titulo_serie = $serie_detalles['name'] ?? 'Sin título';
$sinopsis_corta = $serie_detalles['overview'] ?? 'Sin sinopsis disponible';
$anio_estreno = isset($serie_detalles['first_air_date']) ? substr($serie_detalles['first_air_date'], 0, 4) : 'Desconocido';
$puntuacion = $serie_detalles['vote_average'] ?? 'No disponible';
$imagen_url = isset($serie_detalles['poster_path']) && $serie_detalles['poster_path']
    ? "https://image.tmdb.org/t/p/original" . $serie_detalles['poster_path']
    : "assets/img/placeholder.png";

$credits_details = $ficha->getCredits();
$actores = $credits_details['cast'] ?? [];

// Recuperamos el objeto usuario si está logueado
$usuario = isset($_SESSION['_usuario']) ? unserialize($_SESSION['_usuario']) : null;
$id_usuario = $usuario ? $usuario->getIdUsuario() : null;

## Crear una instancia de la clase Review y obtener las reseñas
$reviewObj = new Review();
$reviews = $reviewObj->getReviewsBySerieId($serie_id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo_serie ?></title>
    <link rel="stylesheet" href="./assets/style/ficha.css">
    <link rel="stylesheet" href="./assets/style/home.css">
</head>

<body>

    <div class="container">
        <div class="content">
            <h1 class="title"><?= $titulo_serie ?></h1>
            <div class="rating">
                <span>⭐ <?= $puntuacion * 10 ?>%</span>
                <span> - <?= $anio_estreno ?></span>
            </div>

            <p class="description"><?= nl2br($sinopsis_corta) ?></p>

            <div class="buttons">
                <a href="home.php#tendencias"><button class="btn">Volver atrás</button></a>
            </div>

            <div class="actors">
                <h2>Reparto principal de <?= $titulo_serie ?></h2>
                <div class="actors-list">

                    <?php
                    $primeros_actores = array_slice($actores, 0, 3);

                    foreach ($primeros_actores as $actor):
                        $actor_nombre = $actor['name'];
                        $personaje    = $actor['character'];
                        $foto_actor   = $actor['profile_path'] ? "https://image.tmdb.org/t/p/w185" . $actor['profile_path'] : "./assets/img/placeholder.png"; ?>

                        <div class="actor">
                            <img src="<?= $foto_actor ?>" alt="Imagen de <?= $actor_nombre ?>">
                            <p><?= $actor_nombre ?> como <span><?= $personaje ?></span></p>
                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="reseñas">

                    <hr>

                    <h2>Reseñas de usuarios</h2>

                    <div class="text-reseñas">
                        
                        <?php if (count($reviews) > 0): ?>

                            <?php foreach ($reviews as $review): ?>

                                <h3><?= $review['titulo'] ?></h3>

                                <p><?= $review['resenia']?></p>

                                <!--

                                Buscando he encontrado que ucfirst() https://www.php.net/manual/es/function.ucfirst.php
                                te pone la primera letra en mayusculas y 
                                es lo que buscaba para los nombres en caso de que este
                                no se registre con el nombre con la primera en mayuscula 

                                -->

                                <p>
                                    <strong><?= ucfirst($review['nombre_usuario']) ?></strong> <br> 
                                    <?= date('d/m/Y', strtotime($review['fecha_resenia'])) ?>
                                </p>

                                <p> Puntuación: <?= $review['puntuacion'] ?> / 5 estrellas </p>

                                <?php if ($id_usuario !== null && $id_usuario == $review['id_usuario']): ?>

                                    <div>
                                        <form action="review.php" method="get">
                                            <input type="hidden" name="id" value="<?= urlencode($serie_id) ?>">
                                            <input type="hidden" name="action" value="edit">
                                            <input type="hidden" name="review_id" value="<?= $review['id_resenia'] ?>">
                                            <button type="submit">Editar</button>
                                        </form>

                                        <form action="review.php" method="get">
                                            <input type="hidden" name="id" value="<?= urlencode($serie_id) ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="review_id" value="<?= $review['id_resenia'] ?>">
                                            <button type="submit">Borrar</button>
                                        </form>
                                    </div>
                                
                                <?php endif; ?>

                                <hr>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay reseñas para esta serie.</p>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($_SESSION['_usuario'])): ?>
                        <a href="review.php?id=<?= urlencode($serie_id) ?>">
                            <img src="./assets/svg/ficha/agregarR.svg" alt="Agregar Reseña">
                        </a>
                    <?php else: ?>
                        <p><a href="index.php">Inicia sesión</a> para agregar una reseña.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="image">
            <img src="<?= $imagen_url ?>" alt="Imagen de <?= $titulo_serie ?>">
        </div>

    </div>

</body>

</html>