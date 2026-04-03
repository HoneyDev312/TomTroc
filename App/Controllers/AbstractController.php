<?php

namespace App\Controllers {

    use App\Services\Utils;

    abstract class AbstractController
    {
        /**
         * Vérifie que l'utilisateur est connecté.
         * @return void
         */
        protected function checkIfUserIsConnected(): void
        {
            if (empty($_SESSION['userId'])) {
                Utils::redirect('signin.show');
            }
        }
    }
}
