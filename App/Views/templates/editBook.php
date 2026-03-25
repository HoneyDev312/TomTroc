<div class="update-book-wrapper">
    <div class="update-book-content container">
        <h1>Modifier les informations</h1>
        <div class="update-book-informations flex">

            <div class="update-book-image">
                <p>Photo</p>
                <div class="update-book-image-wrapper">
                    <img src="<?= BOOK_IMAGE_BASE_URL_IMAGES . $book->getPictureUri() ?>" alt="" />
                </div>
                <div class="update-book-image-link">
                    <a>Modifier la photo</a>
                </div>
            </div>
            <div class="update-book-form-wrapper flex">
                <form class="update-book-form" action="/index.php?action=updateBook&id=<?= $book->getId() ?>&userId=<?= $book->getOwnerId() ?>" method="post">
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?= $book->getTitle() ?>">
                    <label for="author">Auteur</label>
                    <input type="text" name="author" id="author" value="<?= $book->getAuthor() ?>">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required><?= $book->getDescription() ?></textarea>
                    <fieldset class="availability-wrapper">
                        <legend>Disponibilité</legend>
                        <div class="availability">
                            <label><input type="radio" name="availability" value="1" <?= $book->getAvailability() ? 'checked' : '' ?>> Disponible</label>
                            <label><input type="radio" name="availability" value="0" <?= $book->getAvailability() === 0 ? 'checked' : '' ?>> Non disponible</label>
                        </div>
                    </fieldset>

                    <button class="submit btn btn-filled">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>