<?php
defined('C5_EXECUTE') or die("Access Denied.");

$url = parse_url($videoURL);
$pathParts = explode('/', rtrim($url['path'], '/'));
$videoID  = end($pathParts);

if (isset($url['query'])) {
    parse_str($url['query'], $query);
    $videoID = (isset($query['v'])) ? $query['v'] : $videoID;
}

$vWidth  = ($vWidth)  ? $vWidth  : 425;
$vHeight = ($vHeight) ? $vHeight : 344;

$responsiveClass = 'embed-responsive-16by9';
if ($sizing == '4:3') {
    $responsiveClass = 'embed-responsive-4by3';
}

?>

<?php if (Page::getCurrentPage()->isEditMode()) { ?>

    <div class="ccm-edit-mode-disabled-item" style="width: <?= $vWidth; ?>px; height: <?= $vHeight; ?>px;">
        <div style="padding:8px 0px; padding-top: <?= round($vHeight/2)-10; ?>px;"><?= t('YouTube Video disabled in edit mode.'); ?></div>
    </div>

<?php } else { ?>

    <div class="embed-responsive <?php echo $responsiveClass; ?> my-4">
        <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?= $videoID; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
    </div>

<?php } ?>
