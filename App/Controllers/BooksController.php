<?php

namespace App\Controllers {

    use App\Views\View;
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
         * Affiche la page de mise à jour d'un livre.
         * @return void
         */
        public function showUpdateBook(): void
        {
            $view = new View("Nos Livres", "updateBook");
            $view->render("updateBook");
        }

        /**
         * Affiche la page d'un livre.
         * @return void
         */
        public function showBook(): void
        {
            $id = Utils::request("id", -1);

            $bookManager = new BookManager();
            $book = $bookManager->getBookById($id);

            $view = new View("Nos Livres", "book");
            $view->render("book", ['book' => $book]);
        }

        /**
         * Suppression d'un article.
         * @return void
         */
        public function deleteBook(): void
        {

            $id = Utils::request("id", -1);
            $userId = Utils::request("userId", -1);

            if ($id <= 0) {
                throw new \RuntimeException('Id utilisateur invalide');
            }

            // On supprime le book.
            $bookManager = new BookManager();
            $bookManager->deleteBook((int) $id);

            // On redirige vers la page mon compte.
            Utils::redirect("myAccount", ["id" => $userId]);
        }
    }
}
