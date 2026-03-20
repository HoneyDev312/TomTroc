<?php

namespace App\Controllers {

    use App\Views\View;

    class MessageController
    {
        /**
         * Affiche la Messagerie.
         * @return void
         */
        public function showMessaging(): void
        {
            $view = new View("Messagerie", "messaging");
            $view->render("messaging");
        }
    }
}
