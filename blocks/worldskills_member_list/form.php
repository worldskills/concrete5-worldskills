<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">
    <?php echo $form->label('parentId', t('Member of:')); ?>
    <div class="input">
        <select name="parentId" id="parentId" class="form-control">
            <?php foreach ($members as $member): ?>
                <option value="<?php echo h($member['id']); ?>"<?php if ($parentId == $member['id']) { echo ' selected="selected"'; } ?>>
                    <?php echo h($member['name']['text']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
