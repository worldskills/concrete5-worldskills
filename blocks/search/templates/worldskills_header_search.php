<?php defined('C5_EXECUTE') or die("Access Denied."); ?> 

<div class="form-group searchbox">

    <form action="<?=$view->url( $resultTargetURL )?>" method="get" class="ccm-search-block-form">

	    <?php if (strlen($query) == 0): ?>
            <input name="search_paths[]" type="hidden" value="<?php echo h($baseSearchPath); ?>" />
        <?php elseif (is_array($_REQUEST['search_paths'])): ?> 
            <?php foreach ($_REQUEST['search_paths'] as $search_path): ?>
                <input name="search_paths[]" type="hidden" value="<?php echo h($search_path); ?>" />
            <?php endforeach; ?>
        <?php endif; ?>

        <input name="query" type="text" value="<?=h($query)?>" class="form-control" placeholder="<?=h($title)?>" />

        <input type="submit" value="search" title="<?php echo h($buttonText); ?>">

	</form>

</div>
