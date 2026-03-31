<?php
$title = 'Erreur';
$message = 'Une erreur est survenue.';

if ($statusCode === 404) {
    $title = 'Erreur 404';
    $message = 'Une erreur est survenue.';
} elseif ($statusCode === 500) {
    $title = 'Erreur 500';
    $message = 'Erreur interne du serveur.';
}
?>

<section class="error-page">
    <div class="error-content container flex">
        <h1><?= $title ?></h1>
        <p><?= $message ?></p>
        <a class="btn btn-filled" href="/">Retour à l'accueil</a>
    </div>
</section>