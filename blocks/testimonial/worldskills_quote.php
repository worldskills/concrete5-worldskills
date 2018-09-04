<?php
// Quote block.

// This optionally accepts:
// $feature_color, like 'orange' or 'purple'.

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('medium');

$classes = array();

if ($feature_color) {
    array_push($classes, 'ws-feature-'.$feature_color);
}

$f = \File::getByID($fID);

if (is_object($f) && $f->getFileID()) {
    array_push($classes, 'ws-feature-quote-2');
} else {
    array_push($classes, 'ws-feature-quote-1');
}

$class = implode(' ', $classes);

$author = array();
if ($name) {
    $author[] = h($name);
}
if ($position) {
    $author[] = h($position);
}
if ($company) {
    $author[] = h($company);
}
?>

<section class="ws-block ws-feature ws-feature-quote <?=$class?>">
    <figure class="ws-feature-inner">
        <?php if ($paragraph): ?>
            <blockquote class="ws-feature-title">
                <?php if ($companyURL): ?>
                    <a href="<?php echo h($companyURL); ?>"><?php echo h($paragraph); ?></a>
                <?php else: ?>
                    <?php echo h($paragraph); ?>
                <?php endif; ?>
            </blockquote>
        <?php endif; ?>
        <figcaption>
            — <?php echo implode(', ', $author); ?>
            <?php if (is_object($f) && $f->getFileID()): ?>
                <?php
                if (is_object($thumbnailType)) {
                    $src = $f->getThumbnailURL($thumbnailType->getBaseVersion());
                } else {
                    $src = $f->getRelativePath();
                    if (!$src) {
                        $src = $f->getURL();
                    }
                }
                ?>
                <img src="<?php echo h($src); ?>" alt="" role="presentation">
            <?php endif; ?>
        </figcaption>
    </figure>
</section>
