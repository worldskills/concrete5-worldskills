<?php defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php
$c = Page::getCurrentPage();
?>

<?php if (is_object($f)): ?>

    <?php
    if ($maxWidth > 0 || $maxHeight > 0) {
        $im = Core::make('helper/image');
        $thumb = $im->getThumbnail($f, $maxWidth, $maxHeight);
        $tag = new \HtmlObject\Image();
        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
    } else {
        $image = Core::make('html/image', array($f));
        $tag = $image->getTag();
    }
    $tag->addClass('ws-navbar-stripe');
    if ($altText) {
        $tag->alt($altText);
    }
    if ($title) {
        $tag->title($title);
    }
    ?>

    <?php echo $tag; ?>

<?php elseif ($c->isEditMode()): ?>

    <div class="ccm-edit-mode-disabled-item"><?=t('Empty Image Block.')?></div>

<?php endif; ?>
