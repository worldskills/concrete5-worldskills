<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php

$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
    $classes = array();

    if ($ni->isCurrent || $ni->inPath) {
        //class for the page currently being viewed
        $classes[] = 'active';
    }

    if ($ni->hasSubmenu) {
        //class for items that have dropdown sub-menus
        $classes[] = 'dropdown';
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
            <h3 class="sidebar-title"><?php echo $name; ?></h3>
            <ul class="list-unstyled subnavigation">
        <?php endif; ?>

    <?php else:?>

        <?php echo '<li class="' . $ni->classes . '">'; ?>
            <?php echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">'; ?>
                <?php echo $name; ?>
            </a>
        </li>

    <?php endif;?>

<?php endforeach; ?>

</ul>

