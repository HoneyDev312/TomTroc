<?php

namespace App\Controllers {

    use App\Services\Utils;

    abstract class AbstractController
    {
        /**
         * Vérifie que l'utilisateur est connecté.
         * Si pas connecté redirige sur la page de connexion.
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
