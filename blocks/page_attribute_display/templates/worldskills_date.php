<?php
defined('C5_EXECUTE') or die('Access Denied.');
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */

?>

<div class="ws-content">

    <?php
    if (strlen($controller->displayTag)) {
        echo "<" . $controller->displayTag . " class=\"mt-4 mb-0\">";
    } else {
        echo '<p class="mt-4 mb-0">';
    }
    if ($controller->getTitle()) {
        echo '<span class="ccm-block-page-attribute-display-title">' . $controller->getTitle() . '</span>';
    }
    try {
        if ($controller->dateFormat) {
            echo $dh->formatCustom($dateFormat, $controller->getContent());
        } else {
            echo $dh->formatDateTime($controller->getContent());
        }
    } catch (Exception $e) {
        echo $controller->getContent();
    }
    if (strlen($controller->displayTag)) {
        echo "</" . $controller->displayTag . ">";
    } else {
        echo '</p>';
    }
    ?>

</div>
