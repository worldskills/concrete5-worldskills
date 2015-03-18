<?php
$navItems = $controller->getNavItems();
?>

<?php if (count($navItems)): ?>
    <ol class="breadcrumb">
        <?php foreach ($navItems as $ni): ?>
            <?php $name = $ni->name; ?>
            <?php if ($ni->isCurrent && empty($page->isCustomPage)): ?>
                <li class="active"><?php echo !empty($page->pageTitle) ? $page->pageTitle : $name; ?></li>
            <?php else: ?>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="<?php echo $ni->url; ?>" target="<?php echo $ni->target; ?>" itemprop="url">
                        <span itemprop="title"><?php echo $name; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>
