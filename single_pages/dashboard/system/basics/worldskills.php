<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>
<form method="post" action="<?php echo $view->action('save'); ?>">
    <?php echo $this->controller->token->output('save'); ?>

    <fieldset>
        <legend><?php echo t('WorldSkills') ?></legend>
        <div class="form-group">
            <label class="control-label" for="api_url"><?php echo t('API URL') ?></label>
            <input type="text" class="form-control" placeholder="https://example.org" value="<?php echo $apiUrl; ?>" name="api_url">
        </div>
        <div class="form-group">
            <label class="control-label" for="authorize_url"><?php echo t('Authorize URL') ?></label>
            <input type="text" class="form-control" placeholder="https://example.org" value="<?php echo $authorizeUrl; ?>" name="authorize_url">
        </div>
    </fieldset>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?php echo $interface->submit(t('Save'), 'url-form', 'right', 'btn-primary'); ?>
        </div>
    </div>
</form>
