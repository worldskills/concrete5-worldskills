<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php $this->inc('elements/header.php'); ?>

<?php
$a = new Area('Page Header');
$a->enableGridContainer();
$a->setCustomTemplate('image', 'worldskills_hero.php');
$a->setCustomTemplate('feature', 'worldskills_hero_purple.php');
$a->display($c);
?>

<?php
$a = new Area('Main');
$a->enableGridContainer();
$a->setCustomTemplate('content', 'worldskills_content_narrow.php');
$a->setCustomTemplate('page_title', 'worldskills_heading_title_narrow.php');
$a->setCustomTemplate('page_attribute_display', 'worldskills_content_narrow.php');
$a->setCustomTemplate('image', 'worldskills_fluid_narrow.php');
$a->setCustomTemplate('testimonial', 'worldskills_pullquote_narrow.php');
$a->setCustomTemplate('youtube', 'worldskills_embed_narrow.php');
$a->display($c);
?>

<?php
$a = new GlobalArea('Breadcrumb');
$a->disableControls();
$a->enableGridContainer();
$a->setCustomTemplate('autonav', 'worldskills_breadcrumb_narrow.php');
$a->display($c);
?>

<?php $this->inc('elements/footer.php'); ?>
