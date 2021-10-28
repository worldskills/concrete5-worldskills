<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
?>

<ul class="ws-linklist ws-block">

    <?php foreach ($pages as $page): ?>

        <?php
        // Prepare data for each page being listed...
        $title = $th->entities($page->getCollectionName());

        $url = $nh->getLinkToCollection($page);
        $target = '_self';

        $date = $page->getCollectionDatePublicObject()->format('j F Y');

        $urlRedirect = $page->getAttribute('url_redirect');
        if ($urlRedirect) {
            $url = $urlRedirect;
            $target = '_blank';
        }
        ?>

        <li class="ws-linklist-item">
            <h2 class="ws-linklist-title">
                <a href="<?php echo $url ?>" target="<?php echo $target; ?>">
                    <?=$title;?>
                </a>
            </h2>
            <?php if ($date): ?>
                <p class="ws-linklist-desc ws-linklist-desc-sm"><?php echo $date; ?></p>
            <?php endif; ?>
        </li>

    <?php endforeach; ?>
</ul>
