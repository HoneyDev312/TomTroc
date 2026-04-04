<?php

$hasConversations = !empty($conversations);
$hasMessages = !empty($messages);
$activeMessage = $hasMessages ? $messages[0] : null;

$receiverId = null;

if ($hasMessages) {
    $receiverId = $messages[0]->getOtherUserId();
} elseif (!empty($otherId)) {
    $receiverId = (int) $otherId;
}

?>

<div class="messaging-wrapper">
    <div class="messaging-content <?= $pageMode === 'thread' ? 'is-thread-page' : 'is-list-page' ?> container">
        <aside class="messaging-list">
            <h1>Messagerie</h1>
            <?php if (!$hasConversations): ?>
                <div class="messaging-empty">
                    <p>Aucune conversation pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($conversations as $conversation): ?>
                    <a href="/messaging/<?= $_SESSION["userId"] ?>/<?= $conversation->getOtherUserId() ?>" class="messaging-list-item flex <?= ($activeMessage && $conversation->getOtherUserId() === $activeMessage->getOtherUserId()) ? 'selected' : '' ?>">
                        <div class="messaging-list-avatar">
                            <?php if ($conversation->getOtherPictureUri() !== null): ?>
                                <img
                                    src="<?= BOOK_IMAGE_BASE_URL_USERS . htmlspecialchars($conversation->getOtherPictureUri()) ?>" alt="" />
                            <?php else: ?>
                                <p>PAS DE PHOTO</p>
                            <?php endif ?>
                        </div>
                        <div class="messaging-list-body">
                            <div class="messaging-list-header">
                                <span class="messaging-list-sender">
                                    <?= htmlspecialchars($conversation->getOtherUsername()) ?>
                                </span>
                                <span class="messaging-list-time">
                                    <?= $conversation->getCreatedAtHourMinute() ?>
                                </span>
                            </div>
                            <span class="messaging-list-overview">
                                <?= $conversation->getContentExcerpt() ?>
                            </span>
                        </div>
                    </a>
                <?php endforeach ?>
            <?php endif; ?>


        </aside>
        <div class="messaging-thread">
            <?php if (!$hasMessages): ?>
                <div class="messaging-empty">
                    <p>Commencez une conversation depuis <br> la page de description d'un livre ou une page de profil utilisateur.
                </div>
            <?php else: ?>
                <div class="messaging-thread-header flex">
                    <div class="messaging-thread-avatar">
                        <?php if ($messages[0]->getOtherPictureUri() !== null): ?>
                            <img class="messaging-img-header" src="<?= BOOK_IMAGE_BASE_URL_USERS . htmlspecialchars($messages[0]->getOtherPictureUri()) ?>" alt="">
                        <?php else: ?>
                            <p>PAS DE PHOTO</p>
                        <?php endif; ?>
                    </div>
                    <span><?= $messages[0]->getOtherUsername() ?></span>
                </div>

                <div class="messaging-thread-content">
                    <?php foreach ($messages as $message): ?>
                        <div class="messaging-line messaging-<?= $message->getSenderId() === $_SESSION["userId"] ? "user-" : "" ?>line">
                            <div class="messaging-thread-data flex">
                                <?php if ($message->getSenderId() !== $_SESSION["userId"]): ?>
                                    <div class="messaging-thread-avatar">
                                        <?php if ($message->getOtherPictureUri() !== null): ?>
                                            <img class="messaging-img-content" src="<?= BOOK_IMAGE_BASE_URL_USERS . htmlspecialchars($message->getOtherPictureUri()) ?>" alt="">
                                        <?php else: ?>
                                            <p>PAS DE PHOTO</p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif ?>
                                <span><?= $message->getCreatedAtDayMonthHourMinute() ?></span>
                            </div>
                            <p class="messaging-text messaging-<?= $message->getSenderId() === $_SESSION["userId"] ? "user" : "other" ?>-text"><?= htmlspecialchars($message->getContent()) ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif; ?>

            <?php if ($receiverId !== null): ?>
                <div class="messaging-thread-input">
                    <form action="/send-message" class="messaging-thread-form" method="post">
                        <input type="hidden" name="senderId" value="<?= (int) $_SESSION['userId'] ?>">
                        <input type="hidden" name="receiverId" value="<?= $receiverId ?>">
                        <input type="text" name="content" placeholder="Tapez votre texte ici" autocomplete="off">
                        <button type="submit" class="btn btn-filled">Envoyer</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>