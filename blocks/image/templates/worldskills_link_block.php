<?php
// An image above a title and paragraph, with optional link.

$src = '';
if (is_object($f) && $f->getFileID()) {
    if ($f->getTypeObject()->isSVG()) {
        $src = $f->getRelativePath();
    } else {
        $thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('medium');
        if (is_object($thumbnailType)) {
            $src = $f->getThumbnailURL($thumbnailType->getBaseVersion());
        } else {
            $src = $f->getRelativePath();
            if (!$src) {
                $src = $f->getURL();
            }
        }
    }
}
?>
<article class="ws-block ws-imglink">
    <?php if ($linkURL) { ?>
        <a href="<?=$linkURL?>"<?php echo ($openLinkInNewWindow ? ' target="_blank"' : ''); ?>>
    <?php } ?>
        <img class="ws-imglink-img" src="<?php echo h($src); ?>" alt="" role="presentation">
        <h1 class="ws-imglink-title"><?=$title?></h1>
    <?php if ($linkURL) { ?>
        </a>
    <?php }

    if ($altText) {
    ?>
        <p class="ws-imglink-desc"><?=$altText?></p>
    <?php
    }
    ?>
</article>
