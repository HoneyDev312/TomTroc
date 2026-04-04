<?php

namespace App\Models\Entities {
    /**
     * Entité User : un user est défini par son id, un email et un password.
     */

    use App\Models\Entities\AbstractEntity;

    class User extends AbstractEntity
    {
        private string $username;
        private string $email;
        private string $password;
        private ?string $pictureUri;
        private \DateTimeImmutable $createdAt;


        /**
         * Setter pour le username.
         * @param string $username
         * @return void
         */
        public function setUsername(string $username): void
        {
            $this->username = $username;
        }

        /**
         * Getter pour le username.
         * @return string
         */
        public function getUsername(): string
        {
            return $this->username;
        }

        /**
         * Setter pour le email.
         * @param string $email
         * @return void
         */
        public function setEmail(string $email): void
        {
            $this->email = $email;
        }

        /**
         * Getter pour le email.
         * @return string
         */
        public function getEmail(): string
        {
            return $this->email;
        }

        /**
         * Setter pour le password.
         * @param string $password
         * @return void
         */
        public function setPassword(string $password): void
        {
            $this->password = $password;
        }

        /**
         * Getter pour le password.
         * @return string
         */
        public function getPassword(): string
        {
            return $this->password;
        }

        /**
         * Setter pour le pictureUri.
         * @param ?string $pictureUri
         */
        public function setPictureUri(?string $pictureUri): void
        {
            $this->pictureUri = $pictureUri;
        }

        /**
         * Getter affichage (retire le timestamp initial).
         * 20260320090000_filename.jpg -> filename.jpg
         * @return ?string
         */
        public function getPictureUri(): ?string
        {
            if ($this->pictureUri === null || $this->pictureUri === '') {
                return $this->pictureUri;
            }

            return $this->pictureUri;
        }

        /**
         * Setter pour le createdAt.
         * @param string|\DateTimeImmutable $createdAt
         * @return void
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
    }
}
