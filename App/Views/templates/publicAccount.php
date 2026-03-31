<div class="my-account-wrapper">
    <div class="my-account-content container">
        <div class="my-account-informations flex">
            <div class="my-account-informations-box flex left">
                <div class="my-account-avatar">
                    <img
                        src="<?= BOOK_IMAGE_BASE_URL_USERS . $user->getPictureUri() ?>" alt="" />
                </div>
                <div class="my-account-informations-separator"></div>
                <p class="my-account-informations-username"><?= $user->getUsername() ?></p>
                <p class="my-account-informations-since">Membre depuis le <?= $user->getCreatedAt()->format('d/m/Y') ?></p>
                <p class="my-account-informations-subtitle">BIBLIOTHÈQUE</p>
                <span class="my-account-informations-count flex"><img
                        src="<?= BOOK_IMAGE_BASE_URL_SVG . "books.svg" ?>" alt="" />
                    <?= count($books) ?> livres
                </span>
                <a href="/messaging/<?= $_SESSION["userId"] ?>/<?= $user->getId() ?>" class="btn btn-outlined">Écrire un message</a>
            </div>
            <div class="my-account-informations-box flex right">

                <table class="my-account-books-table" aria-label="Liste des livres">
                    <thead>
                        <tr>
                            <th class="my-account-books-table-image" scope="col">PHOTO</th>
                            <th scope="col">TITRE</th>
                            <th scope="col">AUTEUR</th>
                            <th scope="col">DESCRIPTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td class="my-account-books-table-image"><img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . $book->getPictureUri() ?>" alt="Couverture The Kinfolk Table" width="64" height="64"></td>
                                <td><?= $book->getTitle() ?></td>
                                <td><?= $book->getAuthor() ?></td>
                                <td class="my-account-books-table-desc"><?= $book->getTruncateDescription(70) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="my-account-books">


        </div>
    </div>
</div>