<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="form-group">
    <?php echo $form->label('apikey', t('App ID')); ?>
    <?php echo $form->text('apikey', $apikey); ?>
</div>
<div class="form-group">
    <?php echo $form->label('apisecret', t('App Secret')); ?>
    <div class="input-group">
        <?php echo $form->password('apisecret', $apisecret, array('autocomplete' => 'off')); ?>
        <span class="input-group-btn">
        <button id="showsecret" class="btn btn-warning" type="button"><?php echo t('Show secret key')?></button>
      </span>
    </div>
</div>
<div class="form-group">
    <?php echo $form->label('roles_application_code', t('Roles Application Code')); ?>
    <?php echo $form->text('roles_application_code', $rolesApplicationCode); ?>
</div>
<div class='form-group registration-group'>
    <label for="registration_group" class="control-label"><?php echo t('Group to enter on registration'); ?></label>
    <select name="registration_group" class="form-control">
        <option value="0"><?php echo t("None"); ?></option>
        <?php foreach ($groups as $group): ?>
            <option value="<?php echo $group->getGroupID(); ?>" <?php echo intval($group->getGroupID(), 10) === intval(\Config::get('auth.worldskills.registration.group', false), 10) ? 'selected' : ''; ?>>
                <?php echo $group->getGroupDisplayName(false); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<script type="text/javascript">
    var button = $('#showsecret');
    button.click(function() {
        var apisecret = $('#apisecret');
        if(apisecret.attr('type') == 'password') {
            apisecret.attr('type', 'text');
            button.html('<?php echo addslashes(t('Hide secret key')); ?>');
        } else {
            apisecret.attr('type', 'password');
            button.html('<?php echo addslashes(t('Show secret key')); ?>');
        }
    });
</script>
