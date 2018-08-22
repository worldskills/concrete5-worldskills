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
$a = new GlobalArea('Breadcrumb');
$a->disableControls();
$a->enableGridContainer();
$a->setCustomTemplate('autonav', 'worldskills_breadcrumb.php');
$a->display($c);
?>

<?php
$a = new Area('Main');
$a->enableGridContainer();
$a->display($c);
?>

<?php $this->inc('elements/footer.php'); ?>
