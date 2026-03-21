<div class="book-header">
    <div class="container">
        <a href="/index.php?action=ourBooks">Nos livres</a> > <span><?= $book->getTitle() ?></span>
    </div>
</div>
<div class="book-wrapper">
    <div class="book-content container flex">

        <div class="book-picture">
            <img src="<?= BOOK_IMAGE_BASE_URL . $book->getPictureUri() ?>" alt="">
        </div>

        <div class="book-informations">
            <h1><?= $book->getTitle() ?></h1>
            <p class="book-author">par <?= $book->getAuthor() ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">DESCRIPTION</p>
            <p class="book-description"><?= $book->getDescription() ?></p>
            <div class="separator"></div>
            <p class="book-subtitle">PROPRIÉTAIRE</p>
            <a href="/index.php?action=publicAccount&id=<?= $book->getOwnerId() ?>" class="owner-wrapper flex">
                <div class="owner-picture"></div>
                <p><?= $book->getOwnername() ?></p>
            </a>
            <a href="/index.php?action=messaging" class="btn btn-filled">
                Envoyer un message
            </a>
        </div>

    </div>
</div>