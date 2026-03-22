<?php

namespace App\Models\Managers {
    /** 
     * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
     */

    use App\Models\Entities\User;
    use App\Models\Managers\AbstractEntityManager;

    class UserManager extends AbstractEntityManager
    {
        /**
         * Récupère un user par son email.
         * @param string $email
         * @return ?User
         */
        public function getUserByEmail(string $email): ?User
        {

            $sql = "SELECT user_id AS id, username, email, password, picture_uri, created_at FROM user WHERE email = :email";
            $result = $this->db->query($sql, ['email' => $email]);
            $user = $result->fetch();
            if ($user) {
                return new User($user);
            }
            return null;
        }

        /**
         * Récupère un user par son id.
         * @param string $id
         * @return ?User 
         */
        public function getPrivateUserById(string $id): ?User
        {

            $sql = "SELECT u.*, u.user_id AS id 
                    FROM user u
                    WHERE user_id = :id";
            $result = $this->db->query($sql, ['id' => $id]);
            $user = $result->fetch();
            if ($user) {
                return new User($user);
            }
            return null;
        }

        /**
         * Récupère un user par son id.
         * @param string $id
         * @return ?User : id, username picture_uri, created_at
         */
        public function getPublicUserById(string $id): ?User
        {

            $sql = "SELECT user_id AS id, username, picture_uri, created_at 
                    FROM user 
                    WHERE user_id = :id";
            $result = $this->db->query($sql, ['id' => $id]);
            $user = $result->fetch();
            if ($user) {
                return new User($user);
            }
            return null;
        }

        /**
         * Ajoute un user.
         * @param User $user : l'user à ajouter.
         * @return void
         */
        public function addUser(User $user): bool
        {
            $sql = "INSERT INTO user ( username, email, password) VALUES (:username, :email, :password)";

            $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

            $statement = $this->db->query($sql, [
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $hashedPassword
            ]);

            return $statement->rowCount() > 0;
        }
    }
}
