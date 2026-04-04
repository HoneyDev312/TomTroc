<?php

namespace App\Controllers {

    use App\Services\Utils;
    use App\Views\View;
    use App\Models\Managers\UserManager;
    use App\Models\Entities\User;
    use App\Models\Managers\BookManager;

    class AccountController extends AbstractController
    {
        /**
         * Affiche la page mon compte.
         * @return void
         */
        public function showMyAccount(string $id): void
        {

            $this->checkIfUserIsConnected();

            // On récupère l'id.
            $userId = (int) $id;

            if ($userId <= 0) {
                throw new \RuntimeException('ID livre invalide');
            }

            $userManager = new UserManager();
            $user = $userManager->getPrivateUserById($userId);

            $bookManager = new BookManager();
            $books = $bookManager->getAllBookByOwnerId($userId);

            $view = new View("Mon compte", "myAccount");
            $view->render("myAccount", ["user" => $user, "books" => $books]);
        }

        /**
         * Affiche la page publique d'un compte.
         * @return void
         */
        public function showPublicAccount(string $id): void
        {
            // On récupère l'id.
            $userId = (int) $id;

            // On vérifie que l'id est valides.
            if ($userId <= 0) {
                throw new \RuntimeException('ID livre invalide');
            }

            $userManager = new UserManager();
            $user = $userManager->getPublicUserById($userId);

            $bookManager = new BookManager();
            $books = $bookManager->getAllBookByOwnerId($userId);

            // On redirige vers la page compte public.
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
         * Soumission du  formulaire de connexion de l'utilisateur.
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
         * Soumission du formulaire d'inscription d'un utilisateur.
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

            // On hash le mot de pass.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // On crée l'objet User.
            $user = new User([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);

            // On ajoute l'utilisateur en base de données et récupère le user_id du nouvel utilisateur
            $userManager = new UserManager();
            $userId = $userManager->addUser($user);

            // On vérifie que l'ajout a bien fonctionné.
            if (!$user || !$userId) {
                throw new \Exception("Une erreur est survenue lors l'enregistrement de l'utilisateur");
            }

            // On enregistre l'utilisateur en session.
            $_SESSION['user'] = $user;
            $_SESSION['userId'] = $userId;

            // On redirige vers la page Home.
            Utils::redirect("home");
        }

        /**
         * Soumission du formulaire de mise à jour d'un User. 
         * @return void
         */
        public function updateMyAccount(): void
        {

            $this->checkIfUserIsConnected();

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

            // on vérifie si un nouveau mot de passe est envoyé.
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

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => (int) $id]);
        }

        /**
         * Soumission du formulaire de mise à jour d'une photo de User. 
         * @return void
         */
        public function updateMyAccountPicture(): void
        {

            $this->checkIfUserIsConnected();

            // On récupère les données du formulaire.
            $id = Utils::request("id");
            $file = $_FILES["pictureFile"];

            // On vérifie que les données sont valides.
            if (empty($file)) {
                throw new \Exception("Erreur lors du téléchargement.");
            }
            $tmp = $file['tmp_name'];
            $originalName = $file["full_path"];
            $timestamp = date('YmdHis');
            $fileName = $timestamp . '_' . $originalName;

            //On met à jour la piucture du user en base de données.
            $userManager = new UserManager();
            $user = $userManager->getPrivateUserById((int)$id);
            $old = $user->getPictureUri();
            $userManager->updateMyAccountPicture($id, $fileName);

            if (!empty($old)) {
                $oldPath = dirname(__DIR__, 2) . BOOK_IMAGE_BASE_URL_USERS . $old;
                if (is_file($oldPath) && $old !== $fileName) {
                    unlink($oldPath);
                }
            }

            //On met à jour la picture dand le dossier assets/users.
            $uploadDir = dirname(__DIR__, 2) . BOOK_IMAGE_BASE_URL_USERS;
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
                throw new \Exception("Impossible de créer le dossier upload.");
            }

            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($tmp, $targetPath)) {
                throw new \Exception('Erreur upload');
            }

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => (int) $id]);
        }

        /**
         * Deconexion d'un utilisateur.
         * @return void
         */
        public function logoutUser(): void
        {
            // Vérification du status de la session
            if (session_status() === PHP_SESSION_ACTIVE) {
                // On vide la session
                $_SESSION = [];
                // Destruction de la session
                session_destroy();
            }

            // On redirige vers la page Home.
            Utils::redirect('home');
        }
    }
}
