<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php');
?>

<div id="main">
	<div class="wrap">
    	<div class="container">
            <?php
            $a = new Area('Main');
            $a->setAreaGridMaximumColumns(12);
            $a->display($c);
            ?>
        </div>
    </div>
</div>

<?php $this->inc('elements/footer.php'); ?>
