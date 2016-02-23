<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<input type="hidden" name="worldskillsSkillApiUrl" value="<?php echo h(\Config::get('worldskills.api_url')); ?>"/>

<input type="hidden" name="worldskillsSkillId" value="<?php echo h($skillId); ?>"/>

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

<div class="form-group">
    <?php echo $form->label('skillId', t('Skill:')); ?>
    <div class="input">
        <select name="skillId" id="skillId" class="form-control" disabled>
            <option><?php echo t('Please select a competition'); ?></option>
        </select>
    </div>
</div>

<script>
Concrete.event.publish('worldskillsskill.edit.open');
</script>
