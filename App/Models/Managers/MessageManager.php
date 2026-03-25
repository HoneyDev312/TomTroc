<?php

namespace App\Models\Managers {
    /** 
     * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
     */

    use App\Models\Entities\Message;
    use App\Models\Managers\AbstractEntityManager;

    class MessageManager extends AbstractEntityManager
    {

        /**
         * Récupère tous les messages reçus ou envoyés par id.
         * @param int : un id de user
         * @return array : un tableau d'objets Message.
         */
        public function getMessagesById(int $id): array
        {
            $sql = "SELECT
                    m.*, m.message_id AS id
                    FROM message m
                    WHERE sender_id = :id
                    OR receiver_id = :id
                    ORDER BY created_at DESC";

            $result = $this->db->query($sql, ['id' => $id]);
            $messages = [];

            while ($message = $result->fetch()) {
                $messages[] = new Message($message);
            }
            return $messages;
        }

        /**
         * Récupère le dernier message conversation par id.
         * @param int : un id de user
         * @return array : un objet Message ou null.
         */
        public function getLastMessagesById(int $id): array
        {
            $sql = "SELECT 
                        m.*,
                        u.user_id AS other_user_id,
                        u.username AS other_username
                    FROM message m
                    JOIN (
                        SELECT
                            LEAST(sender_id, receiver_id) AS u1,
                            GREATEST(sender_id, receiver_id) AS u2,
                            MAX(message_id) AS last_message_id
                        FROM message
                        WHERE sender_id = :user_id OR receiver_id = :user_id
                        GROUP BY
                            LEAST(sender_id, receiver_id),
                            GREATEST(sender_id, receiver_id)
                        ) x ON x.last_message_id = m.message_id
                    JOIN user u
                        ON u.user_id = CASE
                        WHEN m.sender_id = :user_id THEN m.receiver_id
                        ELSE m.sender_id
                        END
                    ORDER BY m.created_at DESC, m.message_id DESC;";

            $result = $this->db->query($sql, ['user_id' => $id]);

            $messages = [];
            while ($row = $result->fetch()) {
                $messages[] = new Message($row);
            }

            return $messages;
        }
    }
}
