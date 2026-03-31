<div class="book-header">
    <div class="container">
        <a href="/our-books">Nos livres</a> > <span><?= $book->getTitle() ?></span>
    </div>
</div>
<div class="book-wrapper">
    <div class="book-content container flex">

        <div class="book-picture">
            <img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . $book->getPictureUri() ?>" alt="">
        </div>

        <div class="book-informations">
            <h1><?= $book->getTitle() ?></h1>
            <p class="book-author">par <?= $book->getAuthor() ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">DESCRIPTION</p>
            <p class="book-description"><?= $book->getDescription() ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">PROPRIÉTAIRE</p>
            <a href="/public-account/<?= $book->getOwnerId() ?>" class="owner-wrapper flex">
                <div class="owner-picture"></div>
                <p><?= $book->getOwnername() ?></p>
            </a>
            <a href="/messaging/<?= $_SESSION["userId"] ?>/<?= $book->getOwnerId() ?>" class="btn btn-filled">
                Envoyer un message
            </a>
        </div>

    </div>
</div>