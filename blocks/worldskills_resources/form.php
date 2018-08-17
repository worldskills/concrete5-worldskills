<?php
defined('C5_EXECUTE') or die("Access Denied.");
$form = Loader::helper('form');
?>

<fieldset>
    <legend><?=t('Basics')?></legend>

    <div class="form-group">
        <?php echo $form->label('entityId', t('Entity')); ?>
        <div class="input">
            <select name="entityId" id="entityId" class="form-control">
                <option value=""<?php if (!$entityId) { echo ' selected="selected"'; } ?>></option>
                <?php
                $found = false;
                ?>
                <?php if (is_array($entities) && count($entities) > 0): ?>
                    <?php foreach ($entities as $e): ?>
                        <option value="<?php echo h($e['id']); ?>"<?php if ($entityId == $e['id']) { $found = true; echo ' selected="selected"'; } ?>>
                            <?php echo h($e['name']['text']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($entityId && !$found): ?>
                    <option value="<?php echo h($entityId); ?>" selected="selected"><?php echo t('%s', $entityName); ?></option>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label('tags', t('Tags (comma separated)')); ?>
        <div class="input">
            <?php echo $form->text('tags', $tags); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label('sort', t('Sort')); ?>
        <div class="input">
            <select name="sort" id="sort" class="form-control">
                <option value=""<?php if (!$sort) { echo ' selected="selected"'; } ?>></option>
                <option value="name"<?php if ($sort == 'name') { echo ' selected="selected"'; } ?>>By Name</option>
                <option value="name_desc"<?php if ($sort == 'name_desc') { echo ' selected="selected"'; } ?>>By Name Descending</option>
                <option value="v_date"<?php if ($sort == 'v_date') { echo ' selected="selected"'; } ?>>By Version Date</option>
                <option value="v_date_desc"<?php if ($sort == 'v_date_desc') { echo ' selected="selected"'; } ?>>By Version Date Descending</option>
                <option value="v_mod_date"<?php if ($sort == 'v_mod_date') { echo ' selected="selected"'; } ?>>By Modified Date</option>
                <option value="v_mod_date_desc"<?php if ($sort == 'v_mod_date_desc') { echo ' selected="selected"'; } ?>>By Modified Date Descending</option>
            </select>
        </div>
    </div>

</fieldset>

<fieldset>
    <legend><?php echo t('Advanced'); ?></legend>

    <div class="form-group">
        <?php echo $form->label('typeId', t('Document type')); ?>
        <div class="input">
            <select name="type" id="typeId" class="form-control">
                <option value=""<?php if (!$type) { echo ' selected="selected"'; } ?>></option>
                <?php if (is_array($resourceTypes) && count($resourceTypes) > 0): ?>
                    <?php foreach ($resourceTypes as $resourceType): ?>
                        <option value="<?php echo h($resourceType['id']); ?>"<?php if ($type == $resourceType['id']) { echo ' selected="selected"'; } ?>>
                            <?php echo h($resourceType['name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label('eventId', t('Competition for displaying resources by Skill')); ?>
        <div class="input">
            <select name="event" id="eventId" class="form-control">
                <option value=""<?php if (!$event) { echo ' selected="selected"'; } ?>></option>
                <?php foreach ($events as $e): ?>
                    <option value="<?php echo h($e['id']); ?>"<?php if ($event == $e['id']) { echo ' selected="selected"'; } ?>>
                        <?php echo h($e['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

</fieldset>