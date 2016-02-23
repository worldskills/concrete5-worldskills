<?php
$nh = \Loader::helper('navigation');
?>

<?php if (count($skills) > 0): ?>
    <div class="row">
        <?php foreach ($skills as $i => $skill): ?>
            <?php
            $url = '';
            $page = Page::getCurrentPage();
            $pageList = new PageList();
            $pageList->filterByParentID($page->getCollectionId());
            $pageList->filterByAttribute('worldskills_skill_id', $skill['id']);
            $pages = $pageList->get(1);
            if (is_array($pages) && isset($pages[0])) {
                $url = $nh->getLinkToCollection($pages[0]);
            }
            ?>
            <div class="col-md-3">
                <?php if ($url): ?>
                    <a href="<?php echo h($url); ?>" class="thumbnail">
                <?php else: ?>
                    <div class="thumbnail">
                <?php endif; ?>
                <?php foreach ($skill['photos'] as $photo): ?>
                    <img src="<?php echo h($photo['thumbnail']); ?>_small" class="img-responsive" alt="">
                    <?php break; ?>
                <?php endforeach; ?>
                <div class="caption">
                    <h5><?php echo h($skill['name']['text']); ?></h5>
                </div>
                <?php if ($url): ?>
                    </a>
                <?php else: ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($i % 4 == 3): ?>
               <div class="clearfix"></div>
            <?php endif; ?>

        <?php endforeach; ?>

    </div>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty skill list block.')?></div>
<?php endif; ?>
