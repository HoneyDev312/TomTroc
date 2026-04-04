<?php

namespace App\Controllers {

    use App\Views\View;
    use App\Models\Entities\Book;
    use App\Models\Managers\BookManager;
    use App\Services\Utils;

    class BooksController extends AbstractController
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

            $this->checkIfUserIsConnected();

            $bookManager = new BookManager();
            $books = $bookManager->getAllBooks();

            $view = new View("Nos Livres", "ourBooks");
            $view->render("ourBooks", ['books' => $books]);
        }

        public function searchBooks(): void
        {
            // On récupère les données du formulaire GET.
            $titleTrimmed = trim((string) Utils::request('title', ''));

            $bookManager = new BookManager();
            $books = ($titleTrimmed === '')
                ? $bookManager->getAllBooks()
                : $bookManager->searchBooksByTitle($titleTrimmed);

            $view = new View('Nos Livres', 'ourBooks');
            $view->render('ourBooks', [
                'books' => $books,
                'title' => $titleTrimmed
            ]);
        }

        /**
         * Affiche la page d'un livre.
         * @param string $id
         * @return void
         */
        public function showBook(string $id): void
        {
            $this->checkIfUserIsConnected();

            $bookId = (int) $id;

            // On vérifie que l'id est valide.
            if ($bookId <= 0) {
                throw new \RuntimeException("Le livre demandé n'existe pas");
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
         * @param ?string $id
         * @return void
         */
        public function showEditBook(?string $id = null): void
        {
            $this->checkIfUserIsConnected();

            $bookId = $id !== null ? (int)$id : null;

            // Si id est null on redirige sur le formulaire d'ajoute de livre.
            if ($bookId === null) {
                $view = new View("Ajouter un livre", "editBook");
                $view->render("editBook");

                // Sinon on redirige sur le formulaire de mis à jour de livre.
            } else {
                $bookManager = new BookManager();
                $book = $bookManager->getBookById($bookId);

                $view = new View("Modifier un livre", "editBook");
                $view->render("editBook", ['book' => $book]);
            }
        }

        /**
         * Ajouter un livre. 
         * @return void
         */
        public function addBook(): void
        {
            $this->checkIfUserIsConnected();

            // On récupère les données du formulaire POST.
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
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'availability' => (int) $availability,
                'ownerId' => (int) $userId,
            ]);

            // On ajoute le livre.
            $bookManager = new BookManager();
            $bookManager->addBook($book);

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => (int) $userId]);
        }

        /**
         * Soumission de mise à jour d'un livre. 
         * @return void
         */
        public function updateBook(): void
        {
            $this->checkIfUserIsConnected();

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
         * Soumission du formulaire de mise à jour d'une photo d'un Livre. 
         * @return void
         */
        public function updateBookPicture(): void
        {

            $this->checkIfUserIsConnected();

            // On récupère les données du formulaire.
            $id = Utils::request("id");
            $file = $_FILES["pictureFile"];

            // On vérifie que les données sont valides.
            if (empty($file)) {
                throw new \Exception("Erreur lors du téléchargement.");
            }
            $tmp = $file['tmp_name'];
            $originalName = $file["full_path"];
            $timestamp = date('YmdHis');
            $fileName = $timestamp . '_' . $originalName;

            //On met à jour la piucture du user en base de données.
            $bookManager = new BookManager();
            $user = $bookManager->getBookById((int)$id);
            $old = $user->getPictureUri();
            $bookManager->updateBookPicture($id, $fileName);


            //On met à jour la picture du livre dans le fichier assets/books.
            if (!empty($old)) {
                $oldPath = dirname(__DIR__, 2) . BOOK_IMAGE_BASE_URL_BOOKS . $old;
                if (is_file($oldPath) && $old !== $fileName) {
                    unlink($oldPath);
                }
            }

            $uploadDir = dirname(__DIR__, 2) . BOOK_IMAGE_BASE_URL_BOOKS;
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
                throw new \Exception("Impossible de créer le dossier upload.");
            }

            $targetPath = $uploadDir . $fileName;

            if (!move_uploaded_file($tmp, $targetPath)) {
                throw new \Exception('Erreur upload');
            }

            // On redirige vers la page mon compte.
            Utils::redirect("edit-book.show", ["id" => (int) $id]);
        }

        /**
         * Suppression d'un livre.
         * @param string $book_id
         * @param string $user_id
         * @return void
         */
        public function deleteBook(string $book_id, string $user_id): void
        {

            $this->checkIfUserIsConnected();

            // On récupère les params dans l'url GET.
            $bookId = (int) $book_id;
            $userId = (int) $user_id;

            // On vérifie que l'id du livre est valide.
            if ($bookId <= 0) {
                throw new \RuntimeException('Id de livre invalide');
            }

            // On supprime le livre.
            $bookManager = new BookManager();
            $bookManager->deleteBook($bookId);

            // On redirige vers la page mon compte.
            Utils::redirect("my-account.show", ["id" => $userId]);
        }
    }
}
