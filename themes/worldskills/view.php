<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php', array('pageBannerClass' => 'page-small-banner'));
?>

<div id="main">
	<div class="wrap">
    	<div class="container">
            <? print $innerContent; ?>
        </div>
    </div>
</div>

<?php $this->inc('elements/footer.php'); ?>
