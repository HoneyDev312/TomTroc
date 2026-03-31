<?php

namespace App\Controllers {

    use App\Views\View;
    use App\Models\Managers\MessageManager;
    use App\Models\Entities\Message;
    use App\Services\Utils;

    class MessageController
    {
        /**
         * Affiche la Messagerie.
         * @return void
         */
        public function showMessaging(string $id, ?string $otherId = null): void
        {
            // On récupère l'id.
            $userId = (int) $id;
            $otherUserId = $otherId !== null ? (int)$otherId : 0;


            if ($userId <= 0) {
                throw new \RuntimeException('ID user invalide');
            }

            $messageManager = new MessageManager();
            $conversations = $messageManager->getConversationsById($userId);

            $messages = [];
            if ($otherId <= 0) {
                if (!empty($conversations)) {
                    $conversation = $conversations[0];
                    $messages = $messageManager->getMessagesById($userId, $conversation->getOtherUserId());
                }
            } else {
                $messages = $messageManager->getMessagesById($userId, $otherUserId);
            }

            $view = new View("Messagerie", "messaging");
            $view->render("messaging", ["conversations" => $conversations, "messages" => $messages, "otherId" => $otherUserId]);
        }

        /**
         * Envoyer la Messagerie.
         * @return void
         */
        public function sendMessage(): void
        {
            // On récupère les données du formulaire POST.
            $senderId = (int) Utils::request("senderId");
            $receiverId = (int) Utils::request("receiverId");
            $content = Utils::request("content");
            var_dump($senderId, $receiverId, $content);
            // On vérifie que les données sont valides.
            if (empty($senderId) || empty($receiverId) || empty($content)) {
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            // On crée l'objet Message.
            $message = new Message([
                'senderId' => $senderId,
                'receiverId' => $receiverId,
                'content' => $content,
            ]);

            // On envoie le message.
            $messageManager = new MessageManager();
            $messageId = $messageManager->sendMessage($message);


            // On vérifie que l'ajout a bien fonctionné.
            if (!$messageId || !$messageId) {
                throw new \Exception("Une erreur est survenue lors l'enregistrement de votre message");
            }

            // On redirige vers la page mon compte.
            Utils::redirect("messaging.show", ["id" => $senderId, "otherId" => $receiverId]);
        }
    }
}
