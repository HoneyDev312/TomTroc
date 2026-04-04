<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once 'config/config.php';
require_once 'config/db_config.php';
require_once 'config/autoloader.php';

use App\Core\Router;
use App\Services\Utils;
use App\Controllers\ErrorController;

// Instanciation du Router
$router = new Router();

// Charge la déclaration des routes
require_once 'public/routes.php';
try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (\RuntimeException $e) {
    Utils::logException($e);
    (new ErrorController())->render(404, $e->getMessage());
} catch (\Throwable $e) {
    Utils::logException($e);
    (new ErrorController())->render(500, $e->getMessage());
}
