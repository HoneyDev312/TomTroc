<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;

class ErrorController
{
    public function render(int $statusCode = 500, ?string $errorMessage = null): void
    {
        http_response_code($statusCode);

        $view = new View('Erreur', 'error');
        $view->render('error', [
            'statusCode' => $statusCode,
            'errorMessage' => $errorMessage
        ]);
    }
}
