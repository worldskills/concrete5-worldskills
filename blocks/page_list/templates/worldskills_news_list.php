<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('landscape');
?>

<ul class="ws-linklist">

    <?php foreach ($pages as $page): ?>

        <?php
        // Prepare data for each page being listed...
        $title = $th->entities($page->getCollectionName());

        $url = $nh->getLinkToCollection($page);

        $description = $page->getCollectionDescription();

        $date = $page->getCollectionDatePublicObject()->format('j F Y');

        $thumbnail = $page->getAttribute('thumbnail');
        ?>

        <li class="ws-linklist-item">
            <?php if (is_object($thumbnail)): ?>
                <?php
                if (is_object($thumbnailType)) {
                    $src = $thumbnail->getThumbnailURL($thumbnailType->getBaseVersion());
                } else {
                    $src = $thumbnail->getRelativePath();
                    if (!$src) {
                        $src = $thumbnail->getURL();
                    }
                }
                ?>
                <img class="ws-linklist-thumb" src="<?php echo $src ?>" alt="">
            <?php endif; ?>
            <div class="ws-linklist-body">
                <h2 class="ws-linklist-title">
                    <a href="<?php echo $url ?>">
                        <?=$title;?>
                    </a>
                </h2>
                <?php if ($description): ?>
                    <p class="ws-linklist-desc"><?php echo $description; ?></p>
                <?php endif; ?>
                <?php if ($date): ?>
                    <p class="ws-linklist-desc ws-linklist-desc-sm"><?php echo $date; ?></p>
                <?php endif; ?>
            </div>
        </li>

    <?php endforeach; ?>

</ul>

<?php if ($showPagination): ?>
    <?php echo $pagination; ?>
<?php endif; ?>
