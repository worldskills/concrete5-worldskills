<?php defined('C5_EXECUTE') or die('Access Denied.');
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();

if (is_object($f) && $f->getFileID()) {
    if ($f->getTypeObject()->isSVG()) {
        $tag = new \HtmlObject\Image();
        $tag->src($f->getRelativePath());
        $tag->addClass('ccm-svg');
    } elseif ($maxWidth > 0 || $maxHeight > 0) {
        $im = $app->make('helper/image');
        $thumb = $im->getThumbnail($f, $maxWidth, $maxHeight, $cropImage);

        $tag = new \HtmlObject\Image();
        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
    } else {
        $thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');
        if (is_object($thumbnailType)) {
            $src = $f->getThumbnailURL($thumbnailType->getBaseVersion());
        } else {
            $src = $f->getRelativePath();
            if (!$src) {
                $src = $f->getURL();
            }
        }
        $tag = new \HtmlObject\Image();
        $tag->src($src);
    }

    $tag->addClass('ccm-image-block figure-img img-fluid bID-' . $bID);

    if ($altText) {
        $tag->alt(h($altText));
    } else {
        $tag->alt('');
    }

    if ($title) {
        $tag->title(h($title));
    }

    echo '<figure>';

    if ($linkURL) {
        echo '<a href="' . $linkURL . '" '. ($openLinkInNewWindow ? 'target="_blank"' : '') .'>';
    }

    // add data attributes for hover effect
    if (is_object($f) && is_object($foS)) {
        if (($maxWidth > 0 || $maxHeight > 0) && !$f->getTypeObject()->isSVG() && !$foS->getTypeObject()->isSVG()) {
            $tag->addClass('ccm-image-block-hover');
            $tag->setAttribute('data-default-src', $imgPaths['default']);
            $tag->setAttribute('data-hover-src', $imgPaths['hover']);
        }
    }

    echo $tag;

    if ($linkURL) {
        echo '</a>';
    }

    if ($title) {
        echo '<figcaption class="figure-caption">' . h($title) . '</figcaption>';
    }

    echo '</figure>';

} elseif ($c->isEditMode()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Image Block.'); ?></div>
<?php
}