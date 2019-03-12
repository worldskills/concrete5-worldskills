<?php
defined('C5_EXECUTE') or die("Access Denied.");

$c = Page::getCurrentPage();

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('landscape');

?>

<div class="ccm-image-slider-container ccm-block-image-slider-<?=$navigationTypeText; ?> mb-4">
    <div class="ccm-image-slider">
        <div class="ccm-image-slider-inner">

            <?php if (count($rows) > 0): ?>
                <div class="row">
                    <?php foreach ($rows as $row): ?>
                        <?php
                        $f = File::getByID($row['fID']);
                        ?>
                        <figure class="col-sm">
                            <?php if ($row['linkURL']): ?>
                                <a href="<?php echo $row['linkURL']; ?>">
                            <?php endif; ?>
                            <?php if (is_object($f)): ?>
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
                                <img src="<?php echo h($src); ?>" class="figure-img img-fluid" alt="<?php echo strip_tags($row['description']); ?>">
                            <?php endif; ?>
                            <?php if ($row['linkURL']): ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($row['title']): ?>
                                <figcaption class="figure-caption"><?php echo h($row['title']); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="ccm-image-slider-placeholder">
                    <p><?php echo t('No Slides Entered.'); ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
