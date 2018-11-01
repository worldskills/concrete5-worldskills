<?php
defined('C5_EXECUTE') or die("Access Denied.");

$vWidth  = ($vWidth)  ? $vWidth  : 425;
$vHeight = ($vHeight) ? $vHeight : 344;

$responsiveClass = 'embed-responsive-16by9';
if ($sizing == '4:3') {
    $responsiveClass = 'embed-responsive-4by3';
}

$params = array();

if (isset($playlist)) {
    $params[] = 'playlist='. $playlist;
    $videoID = '';
}

if ($playListID) {
    $params[] = 'listType=playlist';
    $params[] = 'list=' . $playListID;
}

if (isset($autoplay) && $autoplay) {
    $params[] = 'autoplay=1';
}

if (isset($color) && $color) {
    $params[] = 'color=' . $color;
}

if (isset($controls) && $controls != '') {
    $params[] = 'controls=' . $controls;
}

$params[] = 'hl=' . Localization::activeLanguage();

if (isset($iv_load_policy) && $iv_load_policy > 0) {
    $params[] = 'iv_load_policy=' . $iv_load_policy;
}

if (isset($loopEnd) && $loopEnd) {
    $params[] = 'loop=1';
    if (!isset($playlist) && $videoID !== '') {
        $params[] = 'playlist='.$videoID;
    }
}

if (isset($modestbranding) && $modestbranding) {
    $params[] = 'modestbranding=1';
}

if (isset($rel) && $rel) {
    $params[] = 'rel=1';
} else {
    $params[] = 'rel=0';
}

if (isset($showinfo) && $showinfo) {
    $params[] = 'showinfo=1';
} else {
    $params[] = 'showinfo=0';
}

if (!empty($startSeconds)) {
    $params[] = 'start=' . $startSeconds;
}

$paramstring = '?' . implode('&', $params);

?>

<?php if (Page::getCurrentPage()->isEditMode()) { ?>

    <div class="ccm-edit-mode-disabled-item" style="width: <?= $vWidth; ?>px; height: <?= $vHeight; ?>px;">
        <div style="padding:8px 0px; padding-top: <?= round($vHeight/2)-10; ?>px;"><?= t('YouTube Video disabled in edit mode.'); ?></div>
    </div>

<?php } else { ?>

    <div class="embed-responsive <?php echo $responsiveClass; ?>">
        <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?= $videoID; ?><?= $paramstring; ?>" frameborder="0" allowfullscreen></iframe>
    </div>

<?php } ?>
