<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc - <?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <?php if (!empty($templateCss)): ?>
        <link rel="stylesheet" href="/css/<?= strtolower(htmlspecialchars($templateCss)) ?>.css">
    <?php endif; ?>
</head>

<body>
    <header>
        <nav aria-label="Navigation principale">
            <div class="container flex">
                <a href="/index.php" class="logo-link">
                    <div class="logo-wrapper">
                        <img src="/assets/svg/logo_white.svg" alt="Logo Tom Troc">
                    </div>
                    <span class="logo-text">Tom Troc</span>
                </a>

                <ul class="link-wrapper flex">
                    <li>
                        <a href="/index.php">
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="/index.php?action=ourBooks">
                            Nos livres à l'échange
                        </a>
                    </li>

                </ul>

                <ul class="account-wrapper flex">
                    <li>
                        <a href="/index.php?action=messaging" class="link-message flex">
                            <img src="/assets/svg/message.svg" alt="">
                            <span>Messagerie</span>
                            <span class="message-counter flex">1</span>
                        </a>
                    </li>
                    <li>
                        <a href="/index.php?action=myAccount" class="link-account flex">
                            <img src="/assets/svg/account.svg" alt="">
                            <span>Mon compte</span>
                        </a>
                    </li>
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <li>
                            <a href="/index.php?action=signin" class="link-connection flex">
                                <span>Connexion</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/index.php?action=logout">Déconnexion</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </nav>
    </header>
    <main>
        <?= $content  ?>
    </main>
    <footer>
        <ul class="footer-wrapper flex">
            <li>
                <a href="/">
                    Politique de confidentialité
                </a>
            </li>
            <li>
                <a href="/">Mentions légales</a>
            </li>
            <li>
                <a href="/">Tom Troc©</a>
            </li>
            <li>
                <a href="/"><img src="/assets/svg/logo_green.svg" alt="Logo Tom Troc"></a>
            </li>
        </ul>
    </footer>
</body>

</html>