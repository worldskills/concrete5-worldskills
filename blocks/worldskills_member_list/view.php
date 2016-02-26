<?php
$nh = \Loader::helper('navigation');
?>

<?php if (count($members) > 0): ?>
    <div class="row">
        <?php foreach ($members as $i => $member): ?>

            <?php if ($i % 6 == 0): ?>
               <div class="clearfix">
                    <p>&nbsp;</p>
               </div>
            <?php endif; ?>

            <div class="col-sm-2">
                <p>
                    <?php if (isset($member['flag']) && $member['flag']): ?>
                        <img src="<?php echo h($member['flag']['thumbnail']); ?>_small" class="img-responsive" alt="" style="border: 1px solid #ddd; max-height: 84px;">
                    <?php endif; ?>
                    <?php echo h($member['name']['text']); ?>
                </p>
            </div>

        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Member list block.')?></div>
<?php endif; ?>
