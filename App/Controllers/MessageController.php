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
        public function showMessaging(): void
        {
            $id = Utils::request("id", -1);

            $messageManager = new MessageManager();
            $messages = $messageManager->getMessagesById($id);
            $lastMessages = $messageManager->getLastMessagesById($id);

            $view = new View("Messagerie", "messaging");
            $view->render("messaging", ["messages" => $messages, "lastMessage" => $lastMessages]);
        }
    }
}
