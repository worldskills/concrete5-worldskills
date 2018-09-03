<?php
defined('C5_EXECUTE') or die("Access Denied.");

$a = $b->getBlockAreaObject();
$container = $formatter->getLayoutContainerHtmlObject();
?>

<div class="ws-layout-gray">
    <div class="container">
        <?php
        foreach ($columns as $column) {
            $html = $column->getColumnHtmlObject();
            if (!empty($container)) {
                $container->appendChild($html);
            } else {
                print $html;
            }
        }

        echo $container;
        ?>
    </div>
</div>
