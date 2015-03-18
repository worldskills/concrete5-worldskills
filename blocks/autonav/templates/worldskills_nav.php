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

echo '<ul class="nav navbar-nav">'; //opens the top-level menu

foreach ($navItems as $ni) {

    echo '<li class="' . $ni->classes . '">'; //opens a nav item
    $name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
    echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">';
    echo $name;
    if ($ni->hasSubmenu) {
        echo '<span class="caret"></span>';
    }
    echo '</a>';

    if ($ni->hasSubmenu) {
        echo '<ul class="dropdown-menu multi-level">'; //opens a dropdown sub-menu
    } else {
        echo '</li>'; //closes a nav item
        echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
    }
}

echo '</ul></nav>'; //closes the top-level menu
