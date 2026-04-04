<?php
$redirect = isset($_SESSION['userId'])
    ? '/messaging/' . (int) $_SESSION['userId'] . '/' . (int) $book->getOwnerId()
    : '/signin';
?>

<div class="book-header">
    <div class="container">
        <a href="/our-books">Nos livres</a> > <span><?= htmlspecialchars($book->getTitle()) ?></span>
    </div>
</div>
<div class="book-wrapper">
    <div class="book-content container flex">

        <div class="book-picture">
            <img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . htmlspecialchars($book->getPictureUri()) ?>" alt="">
        </div>

        <div class="book-informations">
            <h1><?= $book->getTitle() ?></h1>
            <p class="book-author">par <?= htmlspecialchars($book->getAuthor()) ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">DESCRIPTION</p>
            <p class="book-description"><?= htmlspecialchars($book->getDescription()) ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">PROPRIÉTAIRE</p>
            <a href="/public-account/<?= $book->getOwnerId() ?>" class="owner-wrapper flex">
                <div class="owner-picture">
                    <img
                        src="<?= BOOK_IMAGE_BASE_URL_USERS . htmlspecialchars($book->getOwnerPictureUri()) ?>" alt="" />
                </div>
                <p><?= $book->getOwnername() ?></p>
            </a>
            <a href="<?= $redirect ?>" class="btn btn-filled">
                Envoyer un message
            </a>
        </div>

    </div>
</div>