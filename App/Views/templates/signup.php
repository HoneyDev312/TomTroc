    <div class="connect-content container flex">
        <div class="form-wrapper">
            <h1>Connexion</h1>
            <form class="form-connect" action="/add-user" method="post">
                <label for="username">Pseudo</label>
                <input type="text" name="username" id="username" required>
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="submit btn btn-filled">S'inscrire</button>
                <span>Déjà inscrit ? <a href="/signin">Connectez-vous</a></span>
            </form>
        </div>
        <div class="connect-picture">
            <img src="<?= BOOK_IMAGE_BASE_URL_IMAGES . "bookstore.jpg" ?>" alt="">
        </div>
    </div>