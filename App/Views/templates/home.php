<!-- Section rejoingnez-nous -->

<section class="discover">
    <div class="discover-wrapper container flex">
        <div class="left-content flex">
            <h1>Rejoignez nos<br>lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à<br>travers les livres. </p>
            <a href="/index.php?action=ourBooks" class="btn btn-filled">
                Découvrir
            </a>
        </div>
        <div class="right-content">
            <div class="img-wrapper">
                <img src="/assets/images/hamza.jpg" alt="homme lisant entouré de tas de livres">
                <p>Hamza</p>
            </div>
        </div>
    </div>
</section>

<!-- Section des derniers livres ajoutés -->

<section class="books">
    <div class="books-wrapper container flex">
        <h2>Les derniers livres ajoutés</h2>
        <div class="card-wrapper flex">
            <?php foreach ($books as $book): ?>
                <a class="card-link" href="/index.php?action=book&id=<?= (int) $book->getId() ?>">
                    <div class="card">
                        <img class="card-img" src="<?= BOOK_IMAGE_BASE_URL . $book->getPictureUri() ?>" alt="">
                        <div class="card-description">
                            <p class="card-title"><?= $book->getTitle() ?></p>
                            <p class="card-author"><?= $book->getAuthor() ?></p>
                            <span class="card-owner">Vendu par: <?= $book->getOwnername() ?></span>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
        <a href="/index.php?action=ourBooks" class="btn btn-filled">
            Voir tous les livres
        </a>
    </div>
</section>

<!-- section comment ça marche ? -->

<section class="help">
    <div class="help-wrapper container flex">
        <h2>Comment ça marche ?</h2>
        <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div class="rules-wrapper flex">
            <div class="rules-card flex">
                <p>Inscrivez-vous gratuitement sur
                    notre plateforme.</p>
            </div>
            <div class="rules-card flex">
                <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            </div>
            <div class="rules-card flex">
                <p>Parcourez les livres disponibles chez d'autres membres.</p>
            </div>
            <div class="rules-card flex">
                <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
            </div>
        </div>
        <a href="/" class="btn btn-outlined">
            Voir tous les livres
        </a>
    </div>
</section>
<div class="banner-wrapper">
    <div class="banner container"></div>
</div>

<!-- Section nos valeurs -->

<section class="values">
    <div class="values-wrapper container">
        <h2>Nos valeurs</h2>
        <p class="values-text">Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br><br>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.<br><br>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <div class="signature">
            <span>L’équipe Tom Troc</span>
            <img src="/assets/svg/heart.svg" alt="">
        </div>
    </div>

</section>