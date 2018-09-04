<?php
// Feature Pullquote block.

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('medium');

$f = \File::getByID($fID);

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
    <figure class="row my-3">
        <div class="col-4 col-lg-2 offset-lg-1">
            <img class="img-fluid" src="<?php echo h($src); ?>" alt="" role="presentation">
        </div>
        <div class="col-8">
            <div class="ws-pullquote ws-pullquote-top my-0">
                <blockquote><?php echo h($paragraph); ?></blockquote>
                <figcaption>
                    — <?php echo implode(', ', $author); ?>
                </figcaption>
            </div>
        </div>
    </figure>
<?php else: ?>
    <figure class="ws-pullquote">
        <blockquote><?php echo h($paragraph); ?></blockquote>
        <figcaption>
            <?php if (count($author) > 0): ?>
                — <?php echo implode(', ', $author); ?>
            <?php endif; ?>
        </figcaption>
    </figure>
<?php endif; ?>
