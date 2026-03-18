<?php

require_once 'config/config.php';
require_once 'services/Utils.php';
require_once 'controllers/BooksController.php';
require_once 'controllers/MessageController.php';
require_once 'controllers/AccountController.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {

        case 'home':
            $booksController = new BooksController();
            $booksController->showHome();
            break;

        case 'ourBooks':
            $booksController = new BooksController();
            $booksController->showOurBooks();
            break;

        case 'updateBook':
            $booksController = new BooksController();
            $booksController->showUpdateBook();
            break;

        case 'messaging':
            $messgeController = new MessageController();
            $messgeController->showMessaging();
            break;

        case 'myAccount':
            $messgeController = new AccountController();
            $messgeController->showMyAccount();
            break;

        case 'signin':
            $messgeController = new AccountController();
            $messgeController->showSignIn();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    echo $e;
}
