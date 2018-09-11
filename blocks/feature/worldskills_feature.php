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
<?php if ($linkURL): ?>
    <a class="ws-feature-inner" href="<?=$linkURL?>">
<?php else: ?>
    <div class="ws-feature-inner">
<?php endif; ?>
        <div class="ws-feature-content">
            <?php
            if ($title) {
            ?>
                <h1 class="ws-feature-title"><?=$title?></h1>
            <?php
            }
            if ($paragraph) {
                ?>
                <?=$paragraph?>
            <?php
            }
            ?>
        </div>
<?php if ($linkURL): ?>
    </a>
<?php else: ?>
    </div>
<?php endif; ?>
</article>
