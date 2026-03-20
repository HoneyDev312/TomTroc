<div class="ourBooks-wrapper">
    <div class="ourBooks-content container">
        <div class="ourBooks-header">
            <h1>Nos livres à l'échange</h1>
            <input class="search" type="text" name="search" id="search" placeholder="Rechercher un livre">
        </div>
        <div class="ourBooks-grid">
            <?php foreach ($books as $book): ?>
                <div class="card card-grid">
                    <img class="card-img" src="<?= BOOK_IMAGE_BASE_URL . $book->getPictureUri() ?>" alt="">
                    <div class="card-description">
                        <p class="card-title"><?= $book->getTitle() ?></p>
                        <p class="card-author"><?= $book->getAuthor() ?></p>
                        <span class="card-owner">Vendu par: <?= $book->getOwnername() ?></span>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>