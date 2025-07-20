<?php if (isset($message) && $message instanceof \Helpers\Message): ?>
    <div class="<?= $message->getType() ?> white-text" role="alert">
        <?php if (!empty($message->getTitle())): ?>
            <strong><?= $message->getTitle() ?>:</strong>
        <?php endif; ?>
        <?= $message->getText() ?>
    </div>
<?php endif; ?>
