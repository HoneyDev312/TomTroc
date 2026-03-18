<?php

require_once 'config/config.php';
require_once 'views/View.php';
require_once 'models/Database.php';



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
