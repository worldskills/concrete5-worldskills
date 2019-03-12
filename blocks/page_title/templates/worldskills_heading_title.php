<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ws-content">

    <?php
    if ($useFilterTitle) {
        if (is_object($currentTopic) && $useFilterTopic) {
            $title = $controller->formatPageTitle($currentTopic->getTreeNodeDisplayName(), $topicTextFormat);
        }
        if ($tag && $useFilterTag) {
            $title = $controller->formatPageTitle($tag, $tagTextFormat);
        }
        if ($year && $month && $useFilterDate) {
            $srv = Core::make('helper/date');
            $date = strtotime("$year-$month-01");
            $title = $srv->date($filterDateFormat ? $filterDateFormat : 'F Y', $date);

            $title = $controller->formatPageTitle($title, $dateTextFormat);
        }
    }

    if ($title) {
        echo "<$formatting  class=\"ws-heading-title\">" . h($title) . "</$formatting>";
    }
    ?>

</div>
