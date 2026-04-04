<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;

class ErrorController
{
    /**
     * Gestion des erreurs.
     * @param int $statusCode default 500
     * @param string $errorMessage default null
     * @return void
     */
    public function render(int $statusCode = 500, ?string $errorMessage = null): void
    {
        http_response_code($statusCode);

        //On redirige vers la page d'erreur.
        $view = new View('Erreur', 'error');
        $view->render('error', [
            'statusCode' => $statusCode,
            'errorMessage' => $errorMessage
        ]);
    }
}
