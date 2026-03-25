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
         * Affiche la page de mise à jour d'un livre.
         * @return void
         */
        public function showEditBook(): void
        {
            $id = Utils::request("id", -1);

            $bookManager = new BookManager();
            $book = $bookManager->getBookById($id);

            $view = new View("Modifier un livre", "editBook");
            $view->render("editBook", ['book' => $book]);
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
         * Modification d'un book. 
         * @return void
         */
        public function updateBook(): void
        {

            // On récupère les données du formulaire.
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

            // On met à jour l'article.
            $bookManager = new BookManager();
            $bookManager->updateBook($book);

            // On redirige vers la page d'administration.
            // On redirige vers la page mon compte.
            Utils::redirect("myAccount", ["id" => (int) $userId]);
        }

        /**
         * Suppression d'un article.
         * @return void
         */
        public function deleteBook(): void
        {

            $id = Utils::request("id");
            $userId = Utils::request("userId");

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
