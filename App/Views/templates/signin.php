<div class="signin-wrapper">
    <div class="signin-content container flex">
        <div class="form-wrapper">
            <h1>Connexion</h1>
            <form class="form-connect" action="/index.php?action=connectUser" method="post">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                <button class="submit btn btn-filled">Se connecter</button>
                <span>Pas de compte ? <a href="/index.php?action=signup">Inscrivez-vous</a></span>
            </form>
        </div>
        <div class="picture-wrapper">
        </div>
    </div>