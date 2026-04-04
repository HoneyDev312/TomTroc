<?php

declare(strict_types=1);

// Enregistre une fonction d'autoload appelée automatiquement
// quand PHP rencontre une classe non encore chargée.
spl_autoload_register(function (string $class): void {
    // Namespace racine de l'application
    $prefix = "App\\";

    // Dossier de base correspondant au namespace App\
    $baseDir = __DIR__ . '/../App/';

    // Si la classe ne commence pas par "App\", on ignore.
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    // Retire le préfixe "App\" pour garder la partie relative
    // ex: Controllers\HomeController
    $relativeClass = substr($class, strlen($prefix));

    // Convertit les "\" du namespace en "/" de chemin
    // puis ajoute ".php"
    // ex: App\Controllers\HomeController -> App/Controllers/HomeController.php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Charge le fichier s'il existe
    if (is_file($file)) {
        require_once $file;
    }
});
