<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php $this->inc('elements/header.php'); ?>

<div class="container">
    <div class="ws-hero-logo w-25">
        <?php
        $a = new GlobalArea('Header Hero Logo');
        $a->setCustomTemplate('image', 'worldskills_hero_logo.php');
        $a->display($c);
        ?>
    </div>
</div>

<?php
$a = new Area('Page Header');
$a->enableGridContainer();
$a->setCustomTemplate('image', 'worldskills_hero_overlay.php');
$a->display($c);
?>

<?php
$a = new GlobalArea('Header Breadcrumb');
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
