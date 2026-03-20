<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'config/config.php';
require_once 'config/autoloader.php';

use App\Services\Utils;
use App\Controllers\BooksController;
use App\Controllers\AccountController;
use App\Controllers\MessageController;

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

        case 'book':
            $booksController = new BooksController();
            $booksController->showBook();
            break;

        case 'updateBook':
            $booksController = new BooksController();
            $booksController->showUpdateBook();
            break;

        case 'messaging':
            $messageController = new MessageController();
            $messageController->showMessaging();
            break;

        case 'myAccount':
            $accountController = new AccountController();
            $accountController->showMyAccount();
            break;

        case 'signin':
            $accountController = new AccountController();
            $accountController->showSignIn();
            break;

        case 'connectUser':
            $accountController = new AccountController();
            $accountController->connectUser();
            break;

        case 'signup':
            $accountController = new AccountController();
            $accountController->showSignUp();
            break;

        case 'addUser':
            $accountController = new AccountController();
            $accountController->addUser();
            break;

        case 'logout':
            session_start();
            $_SESSION = [];
            session_destroy();

            header('Location: /index.php');
            exit;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    echo $e;
}
