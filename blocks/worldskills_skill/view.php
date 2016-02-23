
<?php if ($skill): ?>

    <?php foreach ($skill['photos'] as $photo): ?>
        <img src="<?php echo h($photo['thumbnail']); ?>_small" class="img-responsive" alt="">
        <?php break; ?>
    <?php endforeach; ?>

    <h1><?php echo h($skill['name']['text']); ?></h1>

    <p><?php echo $skill['description']['text']; ?></p>

<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty skill block.')?></div>
<?php endif; ?>
