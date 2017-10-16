<?php   
defined('C5_EXECUTE') or die("Access Denied.");
?>

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
