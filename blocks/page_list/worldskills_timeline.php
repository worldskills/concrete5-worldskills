<?php
defined('C5_EXECUTE') or die("Access Denied.");

// Expects:
// $timeline_orientation, one of "horizontal" or "vertical"

$c = Page::getCurrentPage();

$th = Loader::helper('text');
$ih = Loader::helper('image');

$num_pages = count($pages);

if ($timeline_orientation == "horizontal" && $num_pages < 6) {
    $timeline_classes = "ws-timeline ws-timeline-horizontal";
} else {
    // Either we want it vertical, or there are too many pages for horizontal.
    $timeline_classes = "ws-timeline";
}

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('extra_small');
?>

<div class="<?=$timeline_classes?>">

    <?php foreach ($pages as $page): ?>

        <?php
        // Prepare data for each page being listed...
        $title = $th->entities($page->getCollectionName());
        $url = $nh->getLinkToCollection($page);

        if ($timeline_orientation == "vertical") {
            $description = $page->getCollectionDescription();
            $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
            $description = $th->entities($description);

            $file = $page->getAttribute('thumbnail');
            $thumbnail = null;
            if (is_object($file)) {
                if (is_object($thumbnailType)) {
                    $thumbnail = $file->getThumbnailURL($thumbnailType->getBaseVersion());
                } else {
                    $thumbnail = $file->getRelativePath();
                    if (!$thumbnail) {
                        $thumbnail = $file->getURL();
                    }
                }
            }
        }

        $isActive = False;
        if ($page->getAttribute('is_featured') || $page->getCollectionID() == $c->getCollectionID()) {
            $isActive = True;
        }
        ?>

        <div class="ws-timeline-event<?php if ($isActive) { echo ' active'; } ?>">
            <h2 class="ws-timeline-title">
                <?php if ($isActive && $timeline_orientation == "horizontal"): ?>
                    <span><?=$title?></span>
                <?php else: ?>
                    <a href="<?=$url?>" target="<?php echo $target ?>"><?=$title?></a>
                <?php endif; ?>
            </h2>
            <p class="ws-timeline-date"><?php echo h($page->getAttributeValue('worldskills_dates')); ?></p>
            <?php if ($timeline_orientation == "vertical"): ?>
                <?php if ($thumbnail or $description): ?>
                    <div class="ws-timeline-about">
                        <?php if ($thumbnail): ?>
                            <?php if ($isActive && $timeline_orientation == "horizontal"): ?>
                                <span class="ws-timeline-thumb">
                                    <img src="<?=$thumbnail?>" alt="" />
                                </span>
                            <?php else: ?>
                                <a class="ws-timeline-thumb" href="<?=$url?>">
                                    <img src="<?=$thumbnail?>" alt="<?php echo h($title); ?>" />
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($description): ?>
                            <p class="ws-timeline-desc"><?=$description?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

</div>
