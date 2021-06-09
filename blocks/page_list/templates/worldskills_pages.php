<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');

$thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('landscape');
?>

<ul class="row list-unstyled">

    <?php foreach ($pages as $page): ?>

        <?php
        // Prepare data for each page being listed...
        $title = $th->entities($page->getCollectionName());

        $url = $nh->getLinkToCollection($page);
        $target = '_self';

        $description = $page->getCollectionDescription();

        $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;

        $description = $th->entities($description);

        $date = $page->getCollectionDatePublicObject()->format('j F Y');

        $src = null;
        $f = $page->getAttribute('thumbnail');
        if (is_object($f)) {
            if (is_object($thumbnailType)) {
                $src = $f->getThumbnailURL($thumbnailType->getBaseVersion());
            } else {
                $src = $f->getRelativePath();
                if (!$src) {
                    $src = $f->getURL();
                }
            }
        }

        $urlRedirect = $page->getAttribute('url_redirect');
        if ($urlRedirect) {
            $url = $urlRedirect;
            $target = '_blank';
        }
        ?>

        <li class="col-sm-6 col-md-3 ws-imglink">
            <a href="<?php echo $url ?>" target="<?php echo $target; ?>">
                <?php if ($src): ?>
                    <img class="ws-imglink-img" src="<?php echo $src ?>" alt="" />
                <?php endif; ?>
                <h1 class="ws-imglink-title">
                    <?php echo $title ?>
                </h1>
            </a>
            <?php if (isset($includeDescription) && $includeDescription): ?>
                <p class="ws-imglink-desc"><?php echo h($description); ?></p>
            <?php endif; ?>
            <?php if (isset($includeDate) && $includeDate): ?>
                <p class="ws-imglink-date"><?php echo h($date); ?></p>
            <?php endif; ?>
        </li>

    <?php endforeach; ?>

</ul>
