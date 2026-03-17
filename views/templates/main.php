<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc - <?= $title ?></title>
    <link rel="stylesheet" href="/css/common.css">
    <?php if (!empty($templateCss)): ?>
        <link rel="stylesheet" href="/css/<?= strtolower(htmlspecialchars($templateCss)) ?>.css">
    <?php endif; ?>
</head>

<body>

    <main>
        <?= $content  ?>
    </main>

</body>

</html>