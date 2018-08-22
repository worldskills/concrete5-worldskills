<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php

$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
    $classes = array('ws-linklist-desc-sm', 'flex-fill', 'py-2');

    if ($ni->isCurrent || $ni->inPath) {
        //class for the page currently being viewed
        $classes[] = 'active';
    }

    //Put all classes together into one space-separated string
    $ni->classes = implode(" ", $classes);
}

?>

<?php foreach ($navItems as $ni): ?>

    <?php
    $name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
    ?>

    <?php if ($ni->level == 1): ?>

        <?php if ($ni->inPath): ?>
            <h4 class="mr-4"><?php echo $name; ?></h4>
            <ul class="ws-linklist mr-4">
        <?php endif; ?>

    <?php else:?>

        <li class="ws-linklist-item d-flex py-0">
            <?php echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">'; ?>
                <?php echo $name; ?>
            </a>
        </li>

    <?php endif;?>

<?php endforeach; ?>

</ul>

