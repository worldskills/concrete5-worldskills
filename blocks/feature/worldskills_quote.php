<?php
// Feature Quote block.
// Very similar to standard Feature block, but a different semantic HTML structure.

// This optionally accepts:
// $feature_color, like 'orange' or 'purple'.


$classes = array();

if ($feature_color) {
    array_push($classes, 'ws-feature-'.$feature_color);
}

$class = implode(' ', $classes);
?>

<section class="ws-block ws-feature ws-feature-quote ws-feature-quote-1 <?=$class?>">
    <figure class="ws-feature-inner">
        <?php
        if ($title) {
        ?>
            <blockquote class="ws-feature-title">
                <?php if ($linkURL): ?>
                    <a href="<?=$linkURL?>"><?=$title?></a>
                <?php else: ?>
                    <?=$title?>
                <?php endif; ?>
            </blockquote>
        <?php
        }
        ?>
        <figcaption>
            <?php
            if ($paragraph) {
                ?>
                <?=$paragraph?>
            <?php
            }
            ?>
        </figcaption>
    </figure>
</section>
