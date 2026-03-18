<?php

/** 
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */

require_once("models/Database.php");
require_once("./models/entities/User.php");


class UserManager
{
    /**
     * Récupère un user par son email.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email): ?User
    {

        $db = Database::getInstance();
        $sql = "SELECT user_id AS id, username, email, password, picture_uri, created_at FROM user WHERE email = :email";
        $result = $db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }
}
