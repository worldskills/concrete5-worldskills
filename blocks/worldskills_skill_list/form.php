<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<input type="hidden" name="worldskillsSkillListToolsDir" value="<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/"/>

<div class="form-group">
    <?php echo $form->label('eventId', t('Competition:')); ?>
    <div class="input">
        <select name="eventId" id="eventId" class="form-control">
            <?php foreach ($events as $event): ?>
                <option value="<?php echo h($event['id']); ?>"<?php if ($eventId == $event['id']) { echo ' selected="selected"'; } ?>>
                    <?php echo h($event['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<?php if (isset($b)): ?>
    <h2>
        <legend><?php echo t('Skill sub pages') ?></legend>
    </h2>

    <div class="form-group">
        <input type="hidden" name="bID" value="<?php echo $b->getBlockID(); ?>" />
        <input type="button" name="worldskillsSkillListSyncPages" value="<?php echo t('Synchronize pages'); ?>" class="btn btn-success" />
    </div>
    <p id="worldskillsSkillListStatus"></p>
<?php endif; ?>

<script>
Concrete.event.publish('worldskillsskilllist.edit.open');
</script>
