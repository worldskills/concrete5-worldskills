<?php
defined('C5_EXECUTE') or die('Access Denied.');

$c = \Page::getCurrentPage();
$content = $c->getAttribute($attributeHandle);
?>

<div class="ws-content">

    <?php if (is_object($content) && $content instanceof \Concrete\Core\Entity\File\File): ?>
        <?php
        if ($content->getTypeObject()->isSVG()) {
            $src = $content->getRelativePath();
        } else {
            $thumbnailType = \Concrete\Core\File\Image\Thumbnail\Type\Type::getByHandle('large');
            if (is_object($thumbnailType)) {
                $src = $content->getThumbnailURL($thumbnailType->getBaseVersion());
            } else {
                $src = $content->getRelativePath();
            }
        }
        if (!$src) {
            $src = $content->getURL();
        }
        ?>
        <figure class="mb-4">
            <?php

            if ($linkURL) {
                echo '<a href="' . $linkURL . '" '. ($openLinkInNewWindow ? 'target="_blank"' : '') .'>';
            }

            echo '<img src="' . h($src) . '" alt="' . h($altText) . '" class="figure-img img-fluid" role="presentation">';

            if ($linkURL) {
                echo '</a>';
            }

            if ($title) {
                echo '<figcaption class="figure-caption">' . h($title) . '</figcaption>';
            }
            ?>
        </figure>
    <?php else: ?>
        <?php
        echo $controller->getOpenTag();
        if ($controller->getTitle()) {
            echo '<span class="ccm-block-page-attribute-display-title">' . $controller->getTitle() . '</span>';
        }
        echo $controller->getContent();
        echo $controller->getCloseTag();
        ?>
    <?php endif; ?>

</div>
