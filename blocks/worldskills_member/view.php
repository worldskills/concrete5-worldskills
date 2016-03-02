
<?php if ($member): ?>

    <?php if (isset($member['flag']) && $member['flag']): ?>
        <p><img src="<?php echo h($member['flag']['thumbnail']); ?>_small" class="img-responsive" alt="" style="border: 1px solid #ddd;"></p>
    <?php endif; ?>

    <h1><?php echo h($member['name']['text']); ?></h1>

    <?php foreach ($member['websites'] as $website): ?>
        <p>
            <a href="<?php echo h($website['url']); ?>" target="_blank">
                <span class="glyphicon glyphicon-globe"></span> Website <?php echo h($website['name']['text']); ?>
            </a>
        </p>
    <?php endforeach; ?>

<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty member block.')?></div>
<?php endif; ?>
