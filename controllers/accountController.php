<?php

require_once 'config/config.php';
require_once 'views/View.php';
require_once 'models/Database.php';
require_once 'models/managers/UserManager.php';

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
    public function showSignIn(): void
    {
        $view = new View("Connexion", "connect");
        $view->render("signin");
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser(): void
    {
        // On récupère les données du formulaire.
        $login = Utils::request("email");
        $password = Utils::request("password");

        var_dump($login,  $password);

        // On vérifie que les données sont valides.
        if (empty($login) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($login);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['userId'] = $user->getId();

        // On redirige vers la page Home.
        Utils::redirect("home");
    }

    /**
     * Affiche la Page de d'inscription.
     * @return void
     */
    public function showSignUp(): void
    {
        $view = new View("Inscription", "connect");
        $view->render("signup");
    }
}
