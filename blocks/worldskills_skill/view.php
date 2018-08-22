
<?php if ($skill && isset($skill['name'])): ?>

    <?php foreach ($skill['photos'] as $photo): ?>
        <img src="<?php echo h($photo['thumbnail']); ?>_small" class="img-fluid" alt="">
        <?php break; ?>
    <?php endforeach; ?>

    <h1><?php echo h($skill['name']['text']); ?></h1>

    <div class="ws-content">
        <?php echo $skill['description']['text']; ?>
    </div>

<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty skill block.')?></div>
<?php endif; ?>
