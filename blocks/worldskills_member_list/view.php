<?php
$nh = \Loader::helper('navigation');
?>

<?php if (count($members) > 0): ?>
    <ol class="row ws-blockgrid">
        <?php foreach ($members as $i => $member): ?>

            <?php
            $url = '';
            $page = Page::getCurrentPage();
            $pageList = new PageList();
            $pageList->filterByParentID($page->getCollectionId());
            $pageList->filterByAttribute('worldskills_member_id', $member['id']);
            $pages = $pageList->get(1);
            if (is_array($pages) && isset($pages[0])) {
                $url = $nh->getLinkToCollection($pages[0]);
            }
            ?>

            <li class="col-6 col-sm-4 col-md-3 ws-blockgrid-item">
                <div class="ws-blockgrid-block" aria-hidden="true">
                    <div class="ws-blockgrid-block-content">
                        <?php if (isset($member['flag']) && $member['flag']): ?>
                            <a class="ws-blockgrid-block-link" href="<?php echo h($url) ?>"><img src="<?php echo h($member["flag"]["thumbnail"]); ?>_small" alt="<?php echo h($member["name"]["text"]); ?> flag"></a>
                        <?php endif; ?>
                    </div>
                </div>

                <a class="js-filter-item-text" href="<?php echo $url ?>"><?php echo h($member["name"]["text"]); ?></a>
            </li>

        <?php endforeach; ?>
    </ol>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Member list block.')?></div>
<?php endif; ?>
