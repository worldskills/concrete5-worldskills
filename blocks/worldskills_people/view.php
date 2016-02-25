
<?php if ($people->getTotalCount() > 0): ?>

    <?php foreach ($people as $i => $person): ?>

        <?php if ($i % 6 == 0): ?>
           <div class="clearfix"></div>
        <?php endif; ?>

        <div class="col-sm-2">
            <div class="row">
                <div class="col-md-10">
                    <?php if (isset($person['images'][0])): ?>
                        <img src="<?php echo h($person['images'][0]['thumbnail']); ?>_portrait" class="img-responsive">
                    <?php else: ?>
                        <img src="https://people.worldskills.org/images/user_portrait.png" class="img-responsive">
                    <?php endif; ?>
                </div>
            </div>
            <p>
                <?php echo h($person['first_name']); ?> <?php echo h($person['last_name']); ?><br/>
                <span class="text-muted"><?php echo h($person['country']['member']['name']['text']); ?></span>
            </p>
        </div>

    <?php endforeach; ?>

<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty people block.')?></div>
<?php endif; ?>
