<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($message)): ?>
    <div class="alert alert-success"><?php echo $message; ?></div>
<?php endif; ?>
<?php

$user = new User;

if ($user->isLoggedIn()) {
    ?>
    <div class="form-group">
        <span>
            <?php echo t('Attach a %s account', 'WorldSkills'); ?>
        </span>
        <hr>
    </div>
    <div class="form-group">
        <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/worldskills/attempt_attach'); ?>" class="btn btn-primary btn-block">
            <i class="fa fa-lock"></i>
            <?php echo t('Attach a %s account', 'WorldSkills'); ?>
        </a>
    </div>
<?php
} else {
    ?>
    <div class="form-group">
        <span>
            <?php echo t('Sign in with %s', 'WorldSkills'); ?>
        </span>
        <hr>
    </div>
    <div class="form-group">
        <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/worldskills/attempt_auth'); ?>" class="btn btn-primary btn-block">
            <i class="fa fa-lock"></i>
            <?php echo t('Log in with %s', 'WorldSkills'); ?>
        </a>
    </div>
<?php
}
?>
