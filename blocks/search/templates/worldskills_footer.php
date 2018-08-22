<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<form action="<?php echo $this->url($resultTargetURL); ?>" method="get" class="search-form" role="search">

    <?php if (strlen($query) == 0): ?>
        <input name="search_paths[]" type="hidden" value="<?php echo h($baseSearchPath); ?>" />
    <?php elseif (is_array($_REQUEST['search_paths'])): ?> 
        <?php foreach ($_REQUEST['search_paths'] as $search_path): ?>
            <input name="search_paths[]" type="hidden" value="<?php echo h($search_path); ?>" />
        <?php endforeach; ?>
    <?php endif; ?>

    <label class="sr-only" for="page-footer-search">Search</label>
    <input type="text" name="query" class="form-control" id="page-footer-search" placeholder="<?php echo h($title); ?>">
    <button type="submit" class="btn btn-primary"><?php echo h($buttonText); ?></button>
</form>
