<?php
// Image feature block.

// A blue 'feature' type block that has an image next to it (or around it).
// We use the image's title and alt text in the feature block.
// The image is used as a background image.

// Optionally expects:
// $block_shape like "3x1" or "2x2".
// $feature_color like 'blue-2' (default) or 'orange'.
// $feature_kind like 'has-intro' (changes order of text).

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('medium');

$classes = array();
$style = '';
if (is_object($f) && $f->getFileID()) {
    if (is_object($thumbnailType)) {
        $src = $f->getThumbnailURL($thumbnailType->getBaseVersion());
    } else {
        $src = $f->getRelativePath();
        if (!$src) {
            $src = $f->getURL();
        }
    }
    if ($src) {
        $style = 'style="background-image: url(' . h($src) . ')"';
    }
}

if ($block_shape) {
    array_push($classes, 'ws-block-'.$block_shape);
}

if ($feature_color) {
    array_push($classes, 'ws-feature-'.$feature_color);
} else {
    array_push($classes, 'ws-feature-blue-2');
}


if ($feature_kind && $feature_kind == "has-intro") {
    array_push($classes, 'ws-feature-has-intro');
}


$class = implode(' ', $classes);

?>
<article class="ws-block ws-feature ws-feature-image <?=$class?>">
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
        if ($altText) {
            ?>
            <p><?=$altText?></p>
        <?php
        }
        ?>
    </div>
    <?php if ($linkURL): ?>
        <a class="ws-feature-image-inner" <?=$style?> href="<?=$linkURL?>"></a>
    <?php else: ?>
        <div class="ws-feature-image-inner" <?=$style?>></div>
    <?php endif; ?>
</article>
