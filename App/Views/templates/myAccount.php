<div class="my-account-wrapper">
    <div class="my-account-content container">
        <h1>Mon compte</h1>
        <div class="my-account-informations flex">
            <div class="my-account-informations-box flex left">
                <div class="my-account-avatar">
                    <img
                        src="<?= BOOK_IMAGE_BASE_URL_USERS . strtolower($user->getUsername()) . ".jpg" ?>" alt="" />
                </div>
                <a href="/index.php">modifier</a>
                <div class="my-account-informations-separator"></div>
                <p class="my-account-informations-username"><?= $user->getUsername() ?></p>
                <p class="my-account-informations-since">Membre depuis le <?= $user->getCreatedAt()->format('d/m/Y') ?></p>
                <p class="my-account-informations-subtitle">BIBLIOTHÈQUE</p>
                <span class="my-account-informations-count flex"><img
                        src="<?= BOOK_IMAGE_BASE_URL_SVG . "books.svg" ?>" alt="" />
                    <?= count($books) ?> livres
                </span>

            </div>
            <div class="my-account-informations-box flex right">
                <div class="my-account-informations-form">
                    <p class="my-account-informations-title">Vos informations personnelles</p>
                    <form class="my-account-informations-form-connect" action="/index.php?action=addUser" method="post">

                        <label for="email">Adresse email</label>
                        <input type="email" name="email" id="email" value="<?= $user->getEmail() ?>">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                        <label for="username">Pseudo</label>
                        <input type="text" name="username" id="username" value="<?= $user->getUsername() ?>" required>
                        <button class="submit btn btn-outlined">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="my-account-books">
            <table class="my-account-books-table" aria-label="Liste des livres">
                <thead>
                    <tr>
                        <th class="my-account-books-table-image" scope="col">PHOTO</th>
                        <th scope="col">TITRE</th>
                        <th scope="col">AUTEUR</th>
                        <th scope="col">DESCRIPTION</th>
                        <th scope="col">DISPONIBILTÉ</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td class="my-account-books-table-image"><img src=<?= BOOK_IMAGE_BASE_URL_IMAGES . $book->getPictureUri() ?> alt="Couverture The Kinfolk Table" width="64" height="64"></td>
                            <td><?= $book->getTitle() ?></td>
                            <td><?= $book->getAuthor() ?></td>
                            <td class="my-account-books-table-desc"><?= $book->getTruncateDescription(90) ?></td>
                            <td><span class="my-account-books-table-image-tag <?= $book->getAvailability() ? "available" : "unavailable" ?>"><?= $book->getAvailability() ? "disponible" : "non-dispo." ?></span></td>
                            <td class="my-account-books-table-action">
                                <a href="#">Éditer</a>
                                <a class="delete" href="#">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>