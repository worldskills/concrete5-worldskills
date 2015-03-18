<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php', array('pageBannerClass' => 'page-small-banner'));
?>

<div id="main">
	<div class="wrap">
    	<div class="container">
    	   <div>
                <?php
                $a = new GlobalArea('Breadcrumb');
                $a->display();
                ?>
            </div>
            <div>
                <?php
                $a = new Area('Main');
                $a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->inc('elements/footer.php'); ?>
