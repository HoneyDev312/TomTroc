<?php
$hasBook = isset($book);
?>
<div class="update-book-wrapper">
    <div class="update-book-content container">
        <button type="button" onclick="history.back()"><img src="<?= BOOK_IMAGE_BASE_URL_SVG . "arrow-left.svg" ?>" alt="" width="16" height="16"> retour</button>
        <h1>Modifier les informations</h1>
        <div class="update-book-informations flex">
            <?php if ($hasBook): ?>
                <div class="update-book-image">
                    <p>Photo</p>
                    <div class="update-book-image-wrapper">
                        <?php if ($book->getPictureUri() !== null): ?>
                            <img src="<?= BOOK_IMAGE_BASE_URL_BOOKS . htmlspecialchars($book->getPictureUri()) ?>" alt="" />
                        <?php else: ?>
                            <p>PAS ENCORE DE PHOTO</p>
                        <?php endif ?>
                    </div>
                    <div class="update-book-image-link">
                        <form id="update-picture-form" class='update-picture-form' action="/update-book-picture" method="post" enctype="multipart/form-data">
                            <input type="text" name="id" id="id" value="<?= $book->getId() ?>" hidden>
                            <label for="pictureFile">Modifier la photo</label>
                            <input class="update-picture-file" type="file" name="pictureFile" id="pictureFile" accept="image/*" hidden>
                        </form>
                    </div>
                </div>
            <?php endif ?>
            <div class="update-book-form-wrapper flex">
                <form class="update-book-form" action="<?= $hasBook ? "/update-book" : "/add-book" ?>" method="post">
                    <input type="text" name="id" id="id" value="<?= $hasBook ? $book->getId() : "" ?>" hidden>
                    <input type="text" name="userId" id="userId" value="<?= $hasBook ? $book->getOwnerId() : $_SESSION["userId"] ?>" hidden>
                    <label for="title">Titre</label>
                    <input type="text" name="title" id="title" value="<?= $hasBook ? htmlspecialchars($book->getTitle()) : "" ?>">
                    <label for="author">Auteur</label>
                    <input type="text" name="author" id="author" value="<?= $hasBook ? htmlspecialchars($book->getAuthor()) : "" ?>">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" required><?= $hasBook ? htmlspecialchars($book->getDescription()) : "" ?></textarea>
                    <label for="availability">Disponibilité</label>
                    <select name="availability" id="availability">
                        <option value="1" <?= $hasBook && $book->getAvailability() == 1 ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= $hasBook && $book->getAvailability() == 0 ? 'selected' : '' ?>>Non disponible</option>
                    </select>
                    <button class="submit btn btn-filled"><?= $hasBook ? "Mettre à jour" : "Ajouter" ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>