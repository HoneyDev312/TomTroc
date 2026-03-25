<?php

namespace App\Controllers {

    use App\Services\Utils;
    use App\Views\View;
    use App\Models\Managers\UserManager;
    use App\Models\Entities\User;
    use App\Models\Managers\BookManager;

    class AccountController
    {
        /**
         * Affiche la page mon compte.
         * @return void
         */
        public function showMyAccount(): void
        {
            // On récupère l'id.
            $id = Utils::request("id");

            $userManager = new UserManager();
            $user = $userManager->getPrivateUserById($id);

            $bookManager = new BookManager();
            $books = $bookManager->getAllBookByOwnerId($id);

            $view = new View("Mon compte", "myAccount");
            $view->render("myAccount", ["user" => $user, "books" => $books]);
        }

        /**
         * Affiche la page publique d'un compte.
         * @return void
         */
        public function showPublicAccount(): void
        {
            // On récupère l'id.
            $id = Utils::request("id");

            $userManager = new UserManager();
            $user = $userManager->getPublicUserById($id);

            $bookManager = new BookManager();
            $books = $bookManager->getAllBookByOwnerId($id);

            $view = new View("Compte de {$user->getUsername()}", "publicAccount");
            $view->render("publicAccount", ["user" => $user, "books" => $books]);
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
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            // On vérifie que l'utilisateur existe.
            $userManager = new UserManager();
            $user = $userManager->getUserByEmail($email);
            if (!$user) {
                throw new \Exception("L'utilisateur demandé n'existe pas.");
            }

            // On vérifie que le mot de passe est correct.
            if (!password_verify($password, $user->getPassword())) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                throw new \Exception("Le mot de passe est incorrect : $hash");
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
         * Modification d'un User. 
         * @return void
         */
        public function updateMyAccount(): void
        {

            // On récupère les données du formulaire.
            $id = Utils::request("id");
            $email = Utils::request("email");
            $oldPassword = Utils::request("old_password");
            $newPassword = Utils::request("password");
            $username = Utils::request("username");

            // On vérifie que les données sont valides.
            if (empty($email) || empty($username)) {
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            $password = '';
            if ($newPassword !== '') {
                $password = password_hash($newPassword, PASSWORD_DEFAULT);
            } else {
                $password = $oldPassword;
            }

            // On crée l'objet User.
            $user = new User([
                'id' => $id,
                'email' => $email,
                'password' => $password,
                'old_password' => $oldPassword,
                'username' => $username,
            ]);

            // On met à jour le user.
            $userManager = new UserManager();
            $userManager->updateMyAccount($user);

            // On redirige vers la page d'administration.
            // On redirige vers la page mon compte.
            Utils::redirect("myAccount", ["id" => (int) $id]);
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
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


            // On crée l'objet User.
            $user = new User([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            // On ajoute le user.
            $userManager = new UserManager();
            $result = $userManager->addUser($user);

            // On vérifie que l'ajout a bien fonctionné.
            if (!$user || !$result) {
                throw new \Exception("Une erreur est survenue lors l'enregistrement de l'utilisateur");
            }

            // On enregistre l'utilisateur en session.
            $_SESSION['user'] = $user;
            $_SESSION['userId'] = $user->getId();

            // On redirige vers la page Home.
            Utils::redirect("home");
        }
    }
}
