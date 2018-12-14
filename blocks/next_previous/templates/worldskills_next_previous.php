<?php
defined('C5_EXECUTE') or die("Access Denied.");

if (!$previousLinkURL && !$nextLinkURL && !$parentLabel) {
    return false;
}
?>

<div class="row justify-content-between">

    <div class="col-md-auto">
        <?php if ($previousLinkURL && $previousLinkText): ?>
            <?php if ($previousLabel): ?>
                <h5><?php echo $previousLabel ?></h5>
            <?php endif; ?>
            <p>
                <a class="btn btn-primary btn-back" href="<?php echo h($previousLinkURL); ?>"><?php echo h($previousLinkText); ?></a>
            </p>
        <?php endif; ?>
    </div>

    <?php if ($parentLabel && $parentLinkURL): ?>
        <div class="col-md-auto">
            <h5>&nbsp;</h5>
            <p>
                <a class="btn btn-primary" href="<?php echo h($parentLinkURL); ?>"><?php echo h($parentLabel); ?></a>
            </p>
        </div>
    <?php endif; ?>

    <div class="col-md-auto">
        <?php if ($nextLinkURL && $nextLinkText): ?>
            <?php if ($nextLabel): ?>
                <h5><?php echo $nextLabel ?></h5>
            <?php endif; ?>
            <p>
                <a class="btn btn-primary btn-more" href="<?php echo h($nextLinkURL); ?>"><?php echo h($nextLinkText); ?></a>
            </p>
        <?php endif; ?>
    </div>

</div>
