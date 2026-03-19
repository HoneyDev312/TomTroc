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
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
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

    /**
     * Enregitrement d'un utilisateur.
     * @return void
     */
    public function addUser(): void
    {
        // On récupère les données du formulaire.
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On crée l'objet Comment.
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        // On ajoute le commentaire.
        $userManager = new UserManager();
        $result = $userManager->addUser($user);

        // On vérifie que l'ajout a bien fonctionné.
        if (!$user) {
            throw new Exception("Une erreur est survenue lors l'enregistrement de l'utilisateur");
        }

        // On redirige vers la page de l'article.
        Utils::redirect("signin");
    }
}
