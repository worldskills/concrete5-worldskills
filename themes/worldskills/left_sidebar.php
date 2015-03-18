<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php', array('pageBannerClass' => 'page-small-banner'));
?>

<div id="main">
	<div class="wrap">
    	<div class="container">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <?php
                    $a = new GlobalArea('Breadcrumb');
                    $a->display();
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 col-sm-push-3 col-md-9 col-md-push-3">
                    <?php
                    $a = new Area('Main');
                    $a->setAreaGridMaximumColumns(9);
                    $a->display($c);
                    ?>
                </div>
                <div class="col-sm-3 col-sm-pull-9 col-md-3 sidebar" role="navigation">
                    <?php
                    $a = new GlobalArea('Sidebar');
                    $a->display();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  $this->inc('elements/footer.php'); ?>
