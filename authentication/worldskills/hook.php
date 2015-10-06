<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div class="form-group">
        <span>
            <?php echo t('Attach a %s account', 'WorldSkills'); ?>
        </span>
    <hr>
</div>
<div class="form-group">
    <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/worldskills/attempt_attach'); ?>" class="btn btn-primary">
        <i class="fa fa-lock"></i>
        <?php echo t('Attach a %s account', 'WorldSkills'); ?>
    </a>
</div>
