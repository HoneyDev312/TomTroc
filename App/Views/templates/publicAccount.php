<?php
$redirect = isset($_SESSION['userId'])
    ? '/messaging/' . (int) $_SESSION['userId'] . '/' . (int) $user->getId()
    : '/signin';
?>

<div class="public-account-wrapper">
    <div class="public-account-content container">
        <div class="public-account-informations flex">
            <div class="public-account-informations-box flex left">
                <div class="public-account-avatar">
                    <img
                        src="<?= BOOK_IMAGE_BASE_URL_USERS . htmlspecialchars($user->getPictureUri()) ?>" alt="" />
                </div>
                <div class="public-account-informations-separator"></div>
                <p class="public-account-informations-username"><?= htmlspecialchars($user->getUsername()) ?></p>
                <p class="public-account-informations-since">Membre depuis le <?= $user->getCreatedAt()->format('d/m/Y') ?></p>
                <p class="public-account-informations-subtitle">BIBLIOTHÈQUE</p>
                <span class="public-account-informations-count flex"><img
                        src="<?= BOOK_IMAGE_BASE_URL_SVG . "books.svg" ?>" alt="" />
                    <?= count($books) ?> livres
                </span>
                <a href="<?= $redirect ?>" class="btn btn-outlined">Écrire un message</a>
            </div>
            <div class="public-account-informations-box flex right">

                <table class="public-account-books-table" aria-label="Liste des livres">
                    <thead>
                        <tr>
                            <th class="public-account-books-table-image" scope="col">PHOTO</th>
                            <th scope="col">TITRE</th>
                            <th scope="col">AUTEUR</th>
                            <th scope="col">DESCRIPTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td class="public-account-books-table-image"><img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . $book->getPictureUri() ?>" alt="Couverture de livre" width="64" height="64"></td>
                                <td><?= $book->getTitle() ?></td>
                                <td><?= $book->getAuthor() ?></td>
                                <td class="public-account-books-table-desc"><?= $book->getTruncateDescription(70) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="public-account-list">
                    <?php if (empty($books)): ?>
                        <div class="public-account-list-card">
                            <p> Pas de livre enregistré pour le moment</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($books as $book): ?>
                            <div class="public-account-list-card">
                                <div class="public-account-list-card-header">
                                    <img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . $book->getPictureUri() ?>" alt="photo du livre" width="79" height="79">
                                    <div class="public-account-list-card-title">
                                        <p><?= $book->getTitle() ?></p>
                                        <p><?= $book->getAuthor() ?></p>
                                        <span class="public-account-tag <?= $book->getAvailability() ? "available" : "unavailable" ?>">
                                            <?= $book->getAvailability() ? "disponible" : "non-dispo." ?>
                                        </span>
                                    </div>
                                </div>
                                <p><?= $book->getTruncateDescription(90) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                </div>

            </div>
        </div>

    </div>
</div>