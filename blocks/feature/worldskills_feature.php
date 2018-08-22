<?php
// Feature block.

// This optionally accepts:
// $feature_color, like 'orange' or 'purple'.

$classes = array();

if ($feature_color) {
    array_push($classes, 'ws-feature-'.$feature_color);
}

$class = implode(' ', $classes);
?>

<article class="ws-block ws-feature <?=$class?>" <?=$style?>>
    <div class="ws-feature-inner">
        <?php
        if ($title) {
        ?>
            <h1 class="ws-feature-title">
                <?php if ($linkURL): ?>
                    <a href="<?=$linkURL?>"><?=$title?></a>
                <?php else: ?>
                    <?=$title?>
                <?php endif; ?>
            </h1>
        <?php
        }
        if ($paragraph) {
            ?>
            <?=$paragraph?>
        <?php
        }
        ?>
    </div>
</article>
