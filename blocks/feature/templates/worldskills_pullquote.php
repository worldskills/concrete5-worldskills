<?php
// Feature Pullquote block.
?>

<figure class="ws-pullquote">
    <blockquote><?=$title?></blockquote>
    <figcaption>
        <?php if ($paragraph): ?>
            <?=$paragraph?>
        <?php endif; ?>
    </figcaption>
</figure>
