<?php

namespace App\Controllers {

    use App\Views\View;
    use App\Models\Managers\MessageManager;
    use App\Services\Utils;

    class MessageController
    {
        /**
         * Affiche la Messagerie.
         * @return void
         */
        public function showMessaging(string $id): void
        {
            // On récupère l'id.
            $userId = (int) $id;

            if ($userId <= 0) {
                throw new \RuntimeException('ID livre invalide');
            }

            $messageManager = new MessageManager();
            $messages = $messageManager->getMessagesById($userId);
            $lastMessages = $messageManager->getLastMessagesById($userId);

            $view = new View("Messagerie", "messaging");
            $view->render("messaging", ["messages" => $messages, "lastMessage" => $lastMessages]);
        }
    }
}
