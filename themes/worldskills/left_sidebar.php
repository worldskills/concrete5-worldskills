<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php $this->inc('elements/header.php'); ?>

<?php
$a = new Area('Page Header');
$a->enableGridContainer();
$a->setCustomTemplate('image', 'worldskills_hero.php');
$a->setCustomTemplate('feature', 'worldskills_hero_purple.php');
$a->display($c);
?>

<div class="container">

    <div class="row">

        <div class="col-md-9 order-md-2">

            <?php
            $a = new GlobalArea('Breadcrumb');
            $a->disableControls();
            $a->setCustomTemplate('autonav', 'worldskills_breadcrumb.php');
            $a->display($c);
            ?>

            <?php
            $a = new Area('Main');
            $a->setAreaGridMaximumColumns(12);
            $a->display($c);
            ?>
        </div>

        <hr class="visible-xs visible-sm" />

        <div class="col-md-3 order-md-1 hidden-print" role="navigation">
            <?php
            $a = new GlobalArea('Sidebar');
            $a->display($c);
            ?>
        </div>

    </div>

</div>

<?php $this->inc('elements/footer.php'); ?>
