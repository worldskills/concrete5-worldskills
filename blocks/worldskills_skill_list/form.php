<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

<input type="hidden" name="worldskillsSkillListApiUrl" value="<?php echo h(\Config::get('worldskills.api_url')); ?>"/>

<input type="hidden" name="worldskillsSkillListToolsDir" value="<?php echo Loader::helper('concrete/urls')->getBlockTypeToolsURL($bt); ?>/"/>

<input type="hidden" name="worldskillsSkillListSectorId" value="<?php echo h($sectorId); ?>"/>

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
    <?php echo $form->label('sectorId', t('Sector:')); ?>
    <div class="input">
        <select name="sectorId" id="sectorId" class="form-control">
            <option></option>
        </select>
    </div>
</div>

<?php
$skillTypes = array(
    'official' => t('Official Skill'),
    'demo' => t('Demonstration Skill'),
    'presentation' => t('Presentation Skill'),
    'multi' => t('Multi Skill'),
    'possible_official' => t('Possible Official Skill'),
    'proposed_demo' => t('Proposed Demonstration Skill'),
);
?>
<div class="form-group">
    <?php echo $form->label('types', t('Types:')); ?>
    <?php echo $form->selectMultiple('types', $skillTypes, explode(',', $types))?>
</div>

<?php if (isset($b)): ?>
    <h2>
        <legend><?php echo t('Skill sub pages') ?></legend>
    </h2>

    <div class="form-group">
        <input type="hidden" name="worldskillsSkillListbID" value="<?php echo $b->getBlockID(); ?>" />
        <input type="button" name="worldskillsSkillListSyncPages" value="<?php echo t('Synchronize pages'); ?>" class="btn btn-success" />
    </div>
    <p id="worldskillsSkillListStatus"></p>
<?php endif; ?>

<script>
Concrete.event.publish('worldskillsskilllist.edit.open');
</script>
