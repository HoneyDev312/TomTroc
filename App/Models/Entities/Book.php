<?php

namespace App\Models\Entities {
    /**
     * Entité User : un user est défini par son id, un email et un password.
     */

    use App\Models\Entities\AbstractEntity;

    class Book extends AbstractEntity
    {
        private string $title;
        private string $description;
        private string $author;
        private ?string $pictureUri;
        private int $availability;
        private int $ownerId;
        private \DateTimeImmutable $createdAt;
        private string $ownername;


        /**
         * Setter pour le title.
         * @param string $title
         */
        public function setTitle(string $title): void
        {
            $this->title = $title;
        }

        /**
         * Getter pour le title.
         * @return string
         */
        public function getTitle(): string
        {
            return $this->title;
        }

        /**
         * Setter pour le description.
         * @param string $description
         */
        public function setDescription(string $description): void
        {
            $this->description = $description;
        }

        /**
         * Getter pour le description.
         * @return string
         */
        public function getDescription(): string
        {
            return $this->description;
        }

        public function getTruncateDescription(int $max = 120): string
        {
            if (mb_strlen($this->description) <= $max) {
                return $this->description;
            }

            return mb_substr($this->description, 0, $max) . '...';
        }

        /**
         * Setter pour le author.
         * @param string $author
         */
        public function setAuthor(string $author): void
        {
            $this->author = $author;
        }

        /**
         * Getter pour le author.
         * @return string
         */
        public function getAuthor(): string
        {
            return $this->author;
        }

        /**
         * Setter pour le pictureUri.
         * @param string $pictureUri
         */
        public function setPictureUri(?string $pictureUri): void
        {
            $this->pictureUri = $pictureUri;
        }

        /**
         * Getter brut (valeur exacte stockée en base).
         */
        public function getPictureUriRaw(): ?string
        {
            return $this->pictureUri;
        }

        /**
         * Getter affichage (retire le timestamp initial).
         * 20260320090000_esther.jpg -> esther.jpg
         */
        public function getPictureUri(): ?string
        {
            if ($this->pictureUri === null || $this->pictureUri === '') {
                return $this->pictureUri;
            }

            return preg_replace('/^\d+_/', '', $this->pictureUri);
        }

        /** 
         * Setter pour l'availability.
         * @param int $availability
         * @return void
         */
        public function setAvailability(int $availability): void
        {
            $this->availability = $availability;
        }


        /**
         * Getter pour l'availability.
         * @return int
         */
        public function getAvailability(): int
        {
            return $this->availability;
        }

        /** 
         * Setter pour l'ownerId.
         * @param int $ownerId
         * @return void
         */
        public function setOwnerId(int $ownerId): void
        {
            $this->ownerId = $ownerId;
        }


        /**
         * Getter pour l'ownerId.
         * @return int
         */
        public function getOwnerId(): int
        {
            return $this->ownerId;
        }

        /**
         * Setter pour le createdAt.
         * @param \DateTimeImmutable $createdAt
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
         * @return DateTimeImmutable
         */
        public function getCreatedAt(): \DateTimeImmutable
        {
            return $this->createdAt;
        }

        /**
         * Setter pour le ownername.
         * @param string $ownername
         */
        public function setOwnername(string $ownername): void
        {
            $this->ownername = $ownername;
        }

        /**
         * Getter pour le ownerName.
         * @return string
         */
        public function getOwnername(): string
        {
            return $this->ownername;
        }
    }
}
