<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?=Localization::activeLanguage()?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/css/site.css">
    <link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/css/responsive.css">
    <?=$html->css($view->getStylesheet('main.less'))?>
    <?php Loader::element('header_required', array('pageTitle' => $pageTitle)); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 10]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <link rel="stylesheet" href="<?=$this->getThemePath()?>/css/ie.css">
    <![endif]-->
    <?php 
    $canViewToolbar = false;
    if (is_object($c)) {
        $cp = new Permissions($c);
        if ($cp->canViewToolbar()) {
            $canViewToolbar = true;
        }
    }
    ?>
    <?php if ($canViewToolbar): ?>
    <style>
    .banner-slider .item {
        top: 49px;
    }
    </style>
    <?php endif; ?>
</head>
<body>

<div id="wrapper" class="<?=$c->getPageWrapperClass()?> <?=(isset($pageBannerClass) ? h($pageBannerClass) : '')?>">

    <div class="header-block">
        <div class="toprow">
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            $a = new GlobalArea('Header Member');
                            $a->display($c);
                            ?>
                        </div>
                        <div class="col-xs-6 language-nav">
                            <?php
                            $a = new GlobalArea('Header Language');
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header id="header">
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                            <div id="logo">
                                <?php
                                $a = new GlobalArea('Header Site Title');
                                $a->display();
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <?php
                                    $a = new GlobalArea('Header Search');
                                    $a->display();
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 navouterbox">
                                    <a href="#" class="searchicon sprites"></a>
                                    <button data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                        <span class="site-navbar-toggle-label">Menu</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <div id="navbar" class="navbar-collapse collapse">
                                        <?php
                                        $a = new GlobalArea('Header Navigation');
                                        $a->display();
                                        ?>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="main-banner">
        <div class="wrap">
            <div class="banner-slider">
                <div class="item">
                    <?php
                    $banner = null;
                    if (is_object($c)) {
                        $banner = $c->getCollectionAttributeValue('worldskills_banner');
                    }
                    ?>
                    <?php if ($banner): ?>
                        <?php
                        $maxWidth = 1450;
                        $maxHeight = 2000;
                        $im = Core::make('helper/image');
                        $thumb = $im->getThumbnail($banner, $maxWidth, $maxHeight);
                        $tag = new \HtmlObject\Image();
                        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
                        ?>
                        <?php echo $tag; ?>
                    <?php else: ?>
                        <img src="<?=$this->getThemePath()?>/images/banner-pic2.jpg" width="1450" height="942">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
