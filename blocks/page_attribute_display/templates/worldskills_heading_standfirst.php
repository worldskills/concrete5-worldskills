<?php
defined('C5_EXECUTE') or die('Access Denied.');
?>

<div class="ws-content">

    <?php
    if (strlen($controller->displayTag)) {
        echo "<" . $controller->displayTag . " class=\"ws-heading-standfirst\">";
    } else {
        echo '<h2 class="ws-heading-standfirst">';
    }
    if ($controller->getTitle()) {
        echo $controller->getTitle();
    }
    echo $controller->getContent();
    if (strlen($controller->displayTag)) {
        echo "</" . $controller->displayTag . ">";
    } else {
        echo '</h2>';
    }
    ?>

</div>
