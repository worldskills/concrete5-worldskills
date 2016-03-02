<?php
$nh = \Loader::helper('navigation');
?>

<?php if (count($members) > 0): ?>
    <div class="row">
        <?php foreach ($members as $i => $member): ?>

            <?php if ($i % 6 == 0): ?>
               <div class="clearfix">
                    <p>&nbsp;</p>
               </div>
            <?php endif; ?>

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

            <div class="col-sm-2">
                <?php if ($url): ?>
                    <a href="<?php echo h($url); ?>" class="thumbnail">
                <?php else: ?>
                    <div class="thumbnail">
                <?php endif; ?>
                <?php if (isset($member['flag']) && $member['flag']): ?>
                    <img src="<?php echo h($member['flag']['thumbnail']); ?>_small" class="img-responsive" alt="" style="border: 1px solid #ddd; max-height: 84px;">
                <?php endif; ?>
                <div class="caption">
                    <h5><?php echo h($member['name']['text']); ?></h5>
                </div>
                <?php if ($url): ?>
                    </a>
                <?php else: ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Member list block.')?></div>
<?php endif; ?>
