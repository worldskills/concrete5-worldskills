<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage(); ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="origin">

    <?php echo $html->css($this->getThemePath() . '/css/bootstrap/bootstrap.min.css'); ?>
    <?php echo $html->css($view->getStylesheet('main.less')); ?>

    <?php Loader::element('header_required', array('pageTitle' => $pageTitle)); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

    <div class="<?php echo $c->getPageWrapperClass()?>">

        <?php
        $a = new GlobalArea('Header Stripe');
        $a->setCustomTemplate('image', 'worldskills_navbar_stripe.php');
        $a->display();
        ?>

        <nav class="navbar navbar-expand-md ws-navbar-main">
            <div class="container">
                <?php
                $a = new GlobalArea('Header Site Title');
                $a->setCustomTemplate('image', 'worldskills_navbar_brand.php');
                $a->display();
                ?>
                <?php
                $a = new GlobalArea('Header Navigation');
                $a->setCustomTemplate('autonav', 'worldskills_nav.php');
                $a->display();
                ?>
            </div>
        </nav>

        <main id="content">
