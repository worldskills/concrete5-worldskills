<?php defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php
$c = Page::getCurrentPage();
?>

<?php if (is_object($f)): ?>

    <?php
    if ($maxWidth > 0 || $maxHeight > 0) {
        $im = Core::make('helper/image');
        $thumb = $im->getThumbnail(
            $f,
            $maxWidth,
            $maxHeight
        ); //<-- set these 2 numbers to max width and height of thumbnails
        $tag = new \HtmlObject\Image();
        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
    } else {
        $image = Core::make('html/image', array($f));
        $tag = $image->getTag();
    }
    $tag->addClass('ccm-image-block img-responsive bID-'.$bID);
    if ($altText) {
        $tag->alt($altText);
    }
    if ($title) {
        $tag->title($title);
    }
    if ($linkURL):
        print '<a href="' . $linkURL . '">';
    endif;
    ?>

    <div class="promobox <?php echo $promoClass; ?>">
    	<a href="<?php echo $linkURL; ?>">
        	<figure>
            	<?php echo $tag; ?>
                <figcaption>Promotion one</figcaption>
            </figure>
        </a>
    </div>

<?php elseif ($c->isEditMode()): ?>

    <div class="ccm-edit-mode-disabled-item"><?=t('Empty Image Block.')?></div>

<? endif; ?>
