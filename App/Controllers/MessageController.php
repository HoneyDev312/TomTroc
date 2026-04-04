<?php

namespace App\Controllers {

    use App\Views\View;
    use App\Models\Managers\MessageManager;
    use App\Models\Entities\Message;
    use App\Services\Utils;

    class MessageController extends AbstractController
    {
        /**
         * Affiche la Messagerie.
         * @param string $id
         * @param ?string $otherId default null
         * @return void
         */
        public function showMessaging(string $id, ?string $otherId = null): void
        {
            $this->checkIfUserIsConnected();

            // On récupère l'id.
            $userId = (int) $id;
            $otherUserId = $otherId !== null ? (int)$otherId : null;

            // On vérifie que l'id du user est valide.
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

            // Gestion du rendu desktop ou mobile
            $pageMode = $otherUserId === null ? 'list' : 'thread';

            //On redirige vers la messagerie.
            $view = new View("Messagerie", "messaging");
            $view->render(
                "messaging",
                [
                    "conversations" => $conversations,
                    "messages" => $messages,
                    "otherId" => $otherUserId,
                    "pageMode" => $pageMode,
                ]
            );
        }

        /**
         * Envoyer un message.
         * @return void
         */
        public function sendMessage(): void
        {

            $this->checkIfUserIsConnected();

            // On récupère les données du formulaire POST.
            $senderId = (int) Utils::request("senderId");
            $receiverId = (int) Utils::request("receiverId");
            $content = Utils::request("content");

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

            // On redirige vers la messagerie.
            Utils::redirect("messaging.thread", ["id" => $senderId, "otherId" => $receiverId]);
        }
    }
}
