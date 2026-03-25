<?php

namespace App\Models\Entities {
    /**
     * Entité Message : un messsage est défini par son id, un contenu, un sender_id et un receiver_id.
     */

    use App\Models\Entities\AbstractEntity;

    class Message extends AbstractEntity
    {
        private string $content;
        private int $senderId;
        private int $receiverId;
        private \DateTimeImmutable $createdAt;
        private string $otherUsername;


        /**
         * Setter pour le content.
         * @param string $content
         */
        public function setContent(string $content): void
        {
            $this->content = $content;
        }

        /**
         * Getter pour le content.
         * @return string
         */
        public function getContent(): string
        {
            return $this->content;
        }

        /**
         * Setter pour le senderId.
         * @param int $email
         */
        public function setSenderId(string $senderId): void
        {
            $this->senderId = $senderId;
        }

        /**
         * Getter pour le senderId.
         * @return int
         */
        public function getSenderId(): int
        {
            return $this->senderId;
        }

        /**
         * Setter pour le receiverId.
         * @param int $receiverId
         */
        public function setReceiverId(string $receiverId): void
        {
            $this->receiverId = $receiverId;
        }

        /**
         * Getter pour le receiverId.
         * @return int
         */
        public function getReceiverId(): int
        {
            return $this->receiverId;
        }

        /**
         * Setter pour le createdAt.
         * @param string|\DateTimeImmutable $createdAt
         */
        public function setCreatedAt(string|\DateTimeImmutable $createdAt): void
        {
            if (is_string($createdAt)) {
                $this->createdAt = new \DateTimeImmutable($createdAt);
                return;
            }

            $this->createdAt = $createdAt;
        }

        /**
         * Getter pour le createdAt.
         * @return string|\DateTimeImmutable
         */
        public function getCreatedAt(): \DateTimeImmutable
        {
            return $this->createdAt;
        }

        /**
         * Setter pour le otherUsername.
         * @param string $otherUsername
         */
        public function setOtherUsername(string $otherUsername): void
        {
            $this->otherUsername = $otherUsername;
        }

        /**
         * Getter pour le otherUsername.
         * @return string
         */
        public function getOtherUsername(): string
        {
            return $this->otherUsername;
        }
    }
}
