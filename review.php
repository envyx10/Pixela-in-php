<?php

session_start();

require_once 'clases/Review.php'; 
require_once 'clases/Usuario.php';  
include_once './inc/session.php';  

## Verificamos si el usuario está logueado
if (!isset($_SESSION['_usuario'])) {
    die(header('Location: index.php'));
}

$usuario = unserialize($_SESSION['_usuario']);
$id_usuario = $usuario->getIdUsuario();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Serie no especificada.</p>";
    die();
}

$serie_id = $_GET['id'];

## Variables adicionales para editar reseñas
$action = isset($_GET['action']) ? $_GET['action'] : null;
$review_id = isset($_GET['review_id']) && is_numeric($_GET['review_id']) ? (int) $_GET['review_id'] : null;

## Crear instancia del objeto Review
$reviewObj = new Review();

## Si la acción es "delete" y existe review_id
if ($action === 'delete' && $review_id !== null) {
    ## Obtenemos la reseña para confirmar que es del usuario
    $reviewData = $reviewObj->getReviewById($review_id);
    if ($reviewData && $reviewData['id_usuario'] == $id_usuario) {
        $reviewObj->deleteReview($review_id);
    }
    ## Redirigimos de vuelta a la ficha
    header("Location: ficha.php?id=" . urlencode($serie_id));
    exit();
}

## Si la acción es "edit" y existe review_id, obtenemos los datos de la reseña
if ($action === 'edit' && $review_id !== null) {
    $reviewData = $reviewObj->getReviewById($review_id);
    if (!$reviewData || $reviewData['id_usuario'] != $id_usuario) {
        echo "<p>No tienes permiso para editar esta reseña.</p>";
        die();
    }
    ## Pre-cargamos variables para el formulario
    $rating = $reviewData['puntuacion'];
    $titulo = $reviewData['titulo'];
    $resena = $reviewData['resenia'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rating = $_POST['rating'];
    $titulo = trim($_POST['titulo']);
    $resena = trim($_POST['resena']);

    $titulo_length = mb_strlen($titulo, 'UTF-8');
    if ($titulo_length === 0) {
        $errores[] = "El título es obligatorio.";
    } elseif ($titulo_length > 100) {
        $errores[] = "El título no puede tener más de 100 caracteres.";
    }

    $resena_length = mb_strlen($resena, 'UTF-8');
    if ($resena_length === 0) {
        $errores[] = "La reseña es obligatoria.";
    } elseif ($resena_length > 600) {
        $errores[] = "La reseña no puede tener más de 600 caracteres.";
    }

    if (empty($errores)) {

        if ($action === 'edit' && $review_id !== null) {
            ## Actualizar reseña existente
            $success = $reviewObj->updateReview($review_id, $id_usuario, $titulo, $resena, $rating);
        } else {
            ## Crear nueva reseña
            $success = $reviewObj->addReview($id_usuario, $serie_id, $titulo, $resena, $rating);
        }

        if ($success) {
            header("Location: ficha.php?id=" . urlencode($serie_id));
            exit();
        } else {
            $errores[] = "Error al guardar la reseña.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($action === 'edit') ? 'Editar Reseña' : 'Crear Reseña' ?></title>
    <link rel="stylesheet" href="./assets/style/critica.css">
</head>

<body>

    <div class="arrow">
        <a href="ficha.php?id=<?= urlencode($serie_id) ?>">
            <!-- SVG de la flecha -->
            <svg width="76" height="76" viewBox="0 0 76 76" fill="#EC1B69" xmlns="http://www.w3.org/2000/svg">
                <path d="M37.9998 69.667C55.4888 69.667 69.6665 55.4894 69.6665 38.0003C69.6665 20.5113 55.4888 6.33368 37.9998 6.33368C20.5108 6.33368 6.33313 20.5113 6.33313 38.0003C6.33313 55.4894 20.5108 69.667 37.9998 69.667Z" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M37.9998 25.3336L25.3331 38.0003L37.9998 50.667" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M50.6665 38.0004H25.3331" stroke="#EC1B69" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
    <div class="header">
        <h1><?= ($action === 'edit') ? 'EDITAR' : 'CREAR' ?> <br> RESEÑA</h1>
    </div>

    <div class="review-container">
        <?php if (!empty($errores)): ?>
            <div class="error-messages">
                <?php foreach ($errores as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="rating">
                <label for="rating">Selecciona una calificación</label>
                <div class="stars">
                    <input type="radio" id="star5" name="rating" value="5" aria-label="5 estrellas" required <?= (isset($rating) && $rating == 5) ? 'checked' : '' ?>>
                    <label for="star5" title="5 estrellas"></label>

                    <input type="radio" id="star4" name="rating" value="4" aria-label="4 estrellas" <?= (isset($rating) && $rating == 4) ? 'checked' : '' ?>>
                    <label for="star4" title="4 estrellas"></label>

                    <input type="radio" id="star3" name="rating" value="3" aria-label="3 estrellas" <?= (isset($rating) && $rating == 3) ? 'checked' : '' ?>>
                    <label for="star3" title="3 estrellas"></label>

                    <input type="radio" id="star2" name="rating" value="2" aria-label="2 estrellas" <?= (isset($rating) && $rating == 2) ? 'checked' : '' ?>>
                    <label for="star2" title="2 estrellas"></label>

                    <input type="radio" id="star1" name="rating" value="1" aria-label="1 estrella" <?= (isset($rating) && $rating == 1) ? 'checked' : '' ?>>
                    <label for="star1" title="1 estrella"></label>
                </div>

            </div>

            <div class="input-group">
                <label for="titulo">Título de la reseña</label>
                <input type="text" id="titulo" name="titulo" placeholder="Escribe aquí el título de la reseña" maxlength="100" required autofocus value="<?= isset($titulo) ? htmlspecialchars($titulo) : '' ?>">
            </div>

            <div class="input-group">
                <label for="resena">Tu reseña</label>
                <textarea id="resena" name="resena" placeholder="Escribe aquí tu reseña" rows="5" maxlength="600" required><?= isset($resena) ? htmlspecialchars($resena) : '' ?></textarea>
            </div>

            <div class="char-count">
                Máximo: 600 caracteres
            </div>

            <button type="submit"><?= ($action === 'edit') ? 'Actualizar' : 'Enviar' ?></button>
        </form>

    </div>
</body>

</html>
