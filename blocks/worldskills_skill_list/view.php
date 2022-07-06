<?php
$nh = \Loader::helper('navigation');
?>

<?php if (count($skills) > 0): ?>
    <ul class="row list-unstyled mt-4" id="js-tag-filter-list">
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

            <li class="col-sm-6 col-md-3 ws-imglink">
                <?php if ($url): ?>
                    <a href="<?php echo h($url); ?>">
                <?php endif; ?>
                <?php foreach ($skill['photos'] as $photo): ?>
                    <img src="<?php echo h($photo['thumbnail']); ?>_landscape_small" class="ws-imglink-img" alt="">
                    <?php break; ?>
                <?php endforeach; ?>
                <h1 class="ws-imglink-title">
                    <?php echo h($skill['name']['text']); ?>
                </h1>
                <?php if ($url): ?>
                    </a>
                <?php endif; ?>
                <p class="ws-imglink-desc">
                    <?php if (is_array($skill['sector'])): ?>
                        <?php foreach ($skill['sector'] as $sector): ?>
                            <?php echo h($skill['sector']['name']['text']); ?>
                            <?php break; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </p>
            </li>

        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty skill list block.')?></div>
<?php endif; ?>
