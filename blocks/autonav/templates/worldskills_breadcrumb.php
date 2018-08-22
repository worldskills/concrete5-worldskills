<?php
$navItems = $controller->getNavItems(true);
?>

<?php if (count($navItems) > 1): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($navItems as $ni): ?>
                <?php if (!$ni->isCurrent): ?>
                    <li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo $ni->url; ?>" target="<?php echo $ni->target; ?>" itemprop="url">
                            <span itemprop="title"><?php echo $ni->name; ?></span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item active" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" aria-current="page">
                        <span itemprop="title"><?php echo $ni->name; ?></span>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </nav>
<?php endif; ?>
