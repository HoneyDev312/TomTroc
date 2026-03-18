<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc - <?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/common.css">
    <link rel="stylesheet" href="/css/header.css">
    <?php if (!empty($templateCss)): ?>
        <link rel="stylesheet" href="/css/<?= strtolower(htmlspecialchars($templateCss)) ?>.css">
    <?php endif; ?>
</head>

<body>
    <header>
        <nav aria-label="Navigation principale">
            <div class="container flex">
                <a href="/" class="logo-link">
                    <div class="logo-wrapper">
                        <img src="/assets/svg/logo_white.svg" alt="Logo Tom Troc">
                    </div>
                    <span class="logo-text">Tom Troc</span>
                </a>

                <ul class="link-wrapper flex">
                    <li>
                        <a href="/">
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            Nos livres à l'échange
                        </a>
                    </li>

                </ul>

                <ul class="account-wrapper flex">
                    <li>
                        <a href="/" class="link-message flex">
                            <img src="/assets/svg/message.svg" alt="">
                            <span>Messagerie</span>
                            <span class="message-counter flex">1</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" class="link-account flex">
                            <img src="/assets/svg/account.svg" alt="">
                            <span>Mon compte</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" class="link-connection flex">
                            <span>Connexion</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </header>
    <main>
        <?= $content  ?>
    </main>
</body>

</html>