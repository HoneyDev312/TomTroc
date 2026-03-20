<?php

namespace App\Models\Managers {
    /** 
     * Classe BookManager pour gérer les requêtes liées aux book.
     */

    use App\Models\Entities\Book;
    use App\Models\Managers\AbstractEntityManager;

    class BookManager extends AbstractEntityManager
    {
        /**
         * Récupère tous les books.
         * @return array : un tableau d'objets Book.
         */
        public function getAllBooks(): array
        {
            $sql = "SELECT
                    b.*, b.book_id AS id,u.username AS ownername
                    FROM book b
                    INNER JOIN user u ON u.user_id = b.owner_id
                    ORDER BY created_at ASC
                    ";
            $result = $this->db->query($sql);
            $books = [];

            while ($book = $result->fetch()) {
                $books[] = new Book($book);
            }
            return $books;
        }

        /**
         * Récupère tous les 4 derniers books.
         * @return array : un tableau d'objets de Book.
         */
        public function getLastFourBooks(): array
        {
            $sql = "SELECT
                    b.*, b.book_id AS id,u.username AS ownername
                    FROM book b
                    INNER JOIN user u ON u.user_id = b.owner_id
                    ORDER BY created_at DESC
                    LIMIT 4;
                    ";
            $result = $this->db->query($sql);
            $books = [];

            while ($book = $result->fetch()) {
                $books[] = new Book($book);
            }
            return $books;
        }

        /**
         * Récupère tous un book par son id.
         * @param int : un id de livre book_id
         * @return array : un tableau d'objets Book.
         */
        public function getBookById(int $id): ?Book
        {
            $sql = "SELECT
                    b.*, b.book_id AS id,u.username AS ownername
                    FROM book b
                    INNER JOIN user u ON u.user_id = b.owner_id
                    WHERE book_id = :id";

            $result = $this->db->query($sql, ['id' => $id]);
            $book = $result->fetch();
            if ($book) {
                return new Book($book);
            }
            return null;
        }
    }
}
