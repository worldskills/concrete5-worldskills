<?php
// Image Hero block.

// Expects:
// hero_kind, optional, could be "overlay" (used for first hero on home page).

// Like a standard Hero block (in blocks/feature/base_templates/) but has an
// image in the background.

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');

$classes = array();
$button_class = "btn-outline-white";
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

if ($hero_kind) {
    array_push($classes, "ws-hero-".$hero_kind);

    if ($hero_kind == "overlay") {
        $button_class = "btn-white";
    }
}

$class = implode(' ', $classes);


?>
<section class="ws-hero ws-hero-image <?=$class?>" <?=$style?>>
    <?php
    if ($title) {
    ?>
        <h1 class="ws-hero-title"><?=$title?></h1>
    <?php
    }
    if ($altText) {
        ?>
        <div class="ws-hero-desc">
            <p><?=$altText?></p>
        </div>
    <?php
    }
    if ($linkURL) {
    ?>
        <a class="btn btn-more <?=$button_class?>" title="<?php echo h($title); ?>" href="<?=$linkURL?>"<?php echo ($openLinkInNewWindow ? ' target="_blank"' : ''); ?>>Learn more</a>
    <?php
    }
    ?>
</section>
