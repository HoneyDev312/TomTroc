<?php

require_once 'config/config.php';
require_once 'views/View.php';
require_once 'models/Database.php';



class AccountController
{
    /**
     * Affiche la Messagerie.
     * @return void
     */
    public function showMyAccount(): void
    {
        $view = new View("Mon compte", "myAccount");
        $view->render("myAccount");
    }

    /**
     * Affiche la Page de connexion.
     * @return void
     */
    public function showSignin(): void
    {
        $view = new View("Connexion", "signin");
        $view->render("signin");
    }
}
