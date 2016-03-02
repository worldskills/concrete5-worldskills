<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<input type="hidden" name="worldskillsMemberListToolsDir" value="<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/"/>

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

<?php if (isset($b)): ?>
    <h2>
        <legend><?php echo t('Member sub pages') ?></legend>
    </h2>

    <div class="form-group">
        <input type="hidden" name="bID" value="<?php echo $b->getBlockID(); ?>" />
        <input type="button" name="worldskillsMemberListSyncPages" value="<?php echo t('Synchronize pages'); ?>" class="btn btn-success" />
    </div>
    <p id="worldskillsMemberListStatus"></p>
<?php endif; ?>

<script>
Concrete.event.publish('worldskillsmemberlist.edit.open');
</script>
