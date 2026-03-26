<?php

namespace App\Controllers {

    use App\Views\View;
    use App\Models\Entities\Book;
    use App\Models\Managers\BookManager;
    use App\Services\Utils;

    class BooksController
    {
        /**
         * Affiche la page d'accueil.
         * @return void
         */
        public function showHome(): void
        {
            $bookManager = new BookManager();
            $books = $bookManager->getLastFourBooks();

            $view = new View("Accueil", "home");
            $view->render("home", ['books' => $books]);
        }

        /**
         * Affiche la page des livres.
         * @return void
         */
        public function showOurBooks(): void
        {
            $bookManager = new BookManager();
            $books = $bookManager->getAllBooks();

            $view = new View("Nos Livres", "ourBooks");
            $view->render("ourBooks", ['books' => $books]);
        }

        /**
         * Affiche la page d'un livre.
         * @return void
         */
        public function showBook(string $id): void
        {
            $bookId = (int) $id;

            if ($bookId <= 0) {
                throw new \RuntimeException('ID livre invalide');
            }

            $bookManager = new BookManager();
            $book = $bookManager->getBookById($bookId);

            if ($book === null) {
                throw new \RuntimeException('Livre introuvable');
            }

            $view = new View("Nos Livres", "book");
            $view->render("book", ['book' => $book]);
        }

        /**
         * Affiche la page du formulaire de mise à jour d'un livre.
         * @return void
         */
        public function showEditBook(string $id): void
        {
            $bookId = $id;

            $bookManager = new BookManager();
            $book = $bookManager->getBookById($bookId);

            $view = new View("Modifier un livre", "editBook");
            $view->render("editBook", ['book' => $book]);
        }

        /**
         * Submit de mis à jour d'un livre. 
         * @return void
         */
        public function updateBook(): void
        {

            // On récupère les données du formulaire POST.
            $id = Utils::request("id");
            $title = Utils::request("title");
            $author = Utils::request("author");
            $description = Utils::request("description");
            $availability = Utils::request("availability");
            $userId = Utils::request("userId");

            // On vérifie que les données sont valides.
            if (empty($title) || empty($author) || empty($description) || $availability === "") {
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            // On crée l'objet Book.
            $book = new Book([
                'id' => $id,
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'availability' => (int) $availability,
            ]);

            // On met à jour le livre.
            $bookManager = new BookManager();
            $bookManager->updateBook($book);

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => (int) $userId]);
        }

        /**
         * Suppression d'un article.
         * @return void
         */
        public function deleteBook(string $book_id, string $user_id): void
        {
            // On récupère les params dans l'url GET.
            $bookId = (int) $book_id;
            $userId = (int) $user_id;

            if ($bookId <= 0) {
                throw new \RuntimeException('Id de livre invalide');
            }

            // On supprime le book.
            $bookManager = new BookManager();
            $bookManager->deleteBook($bookId);

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => $userId]);
        }
    }
}
