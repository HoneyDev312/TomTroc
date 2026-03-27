<div class="ourBooks-wrapper">
    <div class="ourBooks-content container">
        <div class="ourBooks-header">
            <h1>Nos livres à l'échange</h1>
            <form class="ourBooks-form" method="get" action="/search-book">
                <input
                    class="ourBooks-search"
                    type="search"
                    name="title"
                    value="<?= htmlspecialchars($title ?? '') ?>"
                    placeholder="Rechercher un titre">
            </form>
        </div>
        <div class="ourBooks-grid">
            <?php foreach ($books as $book): ?>
                <a class="card-link" href="/book/<?= (int) $book->getId() ?>">
                    <div class="card">
                        <img class="card-img" src="<?= BOOK_IMAGE_BASE_URL_IMAGES . $book->getPictureUri() ?>" alt="">
                        <div class="card-description">
                            <p class="card-title"><?= $book->getTitle() ?></p>
                            <p class="card-author"><?= $book->getAuthor() ?></p>
                            <span class="card-owner">Vendu par: <?= $book->getOwnername() ?></span>
                        </div>
                        <?php if (!$book->getAvailability()): ?>
                            <span class="card-tag">
                                non-dispo.
                            </span>
                        <?php endif ?>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>