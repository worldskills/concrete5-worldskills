<?php
defined('C5_EXECUTE') or die("Access Denied.");

// Displays 3 images.
// One big one in the left, wide column.
// And two smaller ones, one above the other, in the right, narrow column.
// Probably only works if they're all the same aspect ratio.

$c = Page::getCurrentPage();

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('landscape');

?>

<div class="ccm-image-slider-container ccm-block-image-slider-<?=$navigationTypeText; ?> mb-4">
    <div class="ccm-image-slider">
        <div class="ccm-image-slider-inner">

            <?php if (count($rows) > 0): ?>
                <div class="row">


                    <?php $i = 0; ?>
                    <?php foreach ($rows as $row): ?>
                        <?php
                        $f = File::getByID($row['fID']);
                        ?>
                        <?php if ($i == 0): ?>
                            <div class="col-sm-8">
                        <?php elseif ($i == 1): ?>
                            </div> <!-- .col-sm-8 -->
                            <div class="col-sm-4">
                        <?php endif; ?>

                        <figure>
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
                                $row_class = "";
                                if ($i == 1) {
                                    // Top-right small image.
                                    // Remove bottom margin except at narrowest-width:
                                    $row_class = "mb-sm-0";
                                }
                                ?>
                                <img src="<?php echo h($src); ?>" class="figure-img img-fluid <?=$row_class?>" alt="<?php echo strip_tags($row['description']); ?>">
                            <?php endif; ?>
                            <?php if ($row['linkURL']): ?>
                                </a>
                            <?php endif; ?>
                            <?php
                            if ($row['title']) {
                                $caption_class = "";

                                if ($i > 0) {
                                    // For the 2 small images, only show captions at narrowest width:
                                    $caption_class = "d-block d-sm-none";
                                }
                                ?>
                                <figcaption class="figure-caption <?=$caption_class?>"><?php echo h($row['title']); ?></figcaption>
                            <?php
                            }
                            ?>
                        </figure>

                        <?php if ($i == 2): ?>
                            </div> <!-- .col-sm-4 -->
                        <?php endif; ?>

                        <?php $i++; ?>
                    <?php endforeach; ?>


                </div> <!-- .row -->
            <?php else: ?>
                <div class="ccm-image-slider-placeholder">
                    <p><?php echo t('No Slides Entered.'); ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>
