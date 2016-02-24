<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<input type="hidden" name="worldskillsPeopleApiUrl" value="<?php echo h(\Config::get('worldskills.api_url')); ?>"/>

<input type="hidden" name="worldskillsPeopleSkillId" value="<?php echo h($skillId); ?>"/>

<div class="radio">
    <label>
        <input type="radio" name="typeFilter" id="typeFilterCompetitors" value="competitors" <?php if ($typeFilter == 'competitors'): ?> checked<?php endif; ?>>
        <?php echo t('Competitors') ?>
    </label>
</div>
<div class="radio">
    <label>
        <input type="radio" name="typeFilter" id="typeFilterExperts" value="experts" <?php if ($typeFilter == 'experts'): ?> checked<?php endif; ?>>
        <?php echo t('Experts') ?>
    </label>
</div>

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
Concrete.event.publish('worldskillspeople.edit.open');
</script>
