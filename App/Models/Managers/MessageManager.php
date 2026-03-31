<?php

namespace App\Models\Managers {
    /** 
     * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
     */

    use App\Models\Entities\Message;
    use App\Models\Managers\AbstractEntityManager;

    class MessageManager extends AbstractEntityManager
    {

        public function getMessagesById(int $id, int $otherId): array
        {
            $sql = "SELECT
                m.*,
                m.message_id AS id,
                u.user_id AS other_user_id,
                u.username AS other_username,
                u.picture_uri AS other_picture_uri
            FROM message m
            JOIN user u
              ON u.user_id = CASE
                    WHEN m.sender_id = :id THEN m.receiver_id
                    ELSE m.sender_id
                 END
            WHERE (m.sender_id = :id AND m.receiver_id = :other_id)
               OR (m.sender_id = :other_id AND m.receiver_id = :id)
            ORDER BY m.created_at ASC, m.message_id ASC";

            $result = $this->db->query($sql, [
                'id' => $id,
                'other_id' => $otherId
            ]);

            $messages = [];
            while ($row = $result->fetch()) {
                $messages[] = new Message($row);
            }

            return $messages;
        }

        /**
         * Récupère le dernier message conversation par id.
         * @param int : un id de user
         * @return array : un objet Message ou null.
         */
        public function getConversationsById(int $id): array
        {
            $sql = "SELECT 
                        m.*,
                        u.user_id AS other_user_id,
                        u.username AS other_username,
                        u.picture_uri AS other_picture_uri
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

            $conversations = [];
            while ($row = $result->fetch()) {
                $conversations[] = new Message($row);
            }

            return $conversations;
        }

        /**
         * Ajoute un message.
         * @param Message $message : le message à ajouter.
         * @return void
         */
        public function sendMessage(Message $message): ?int
        {
            $sql = "INSERT INTO message ( content, sender_id, receiver_id) VALUES (:content, :sender_id, :receiver_id)";

            $statement = $this->db->query($sql, [
                'content' => $message->getContent(),
                'sender_id' => $message->getSenderId(),
                'receiver_id' => $message->getReceiverId()
            ]);

            if ($statement->rowCount() > 0) {
                return (int) $this->db->getPDO()->lastInsertId();
            }
            return null;
        }
    }
}
