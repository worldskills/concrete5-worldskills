<?php
$navItems = $controller->getNavItems(true);
?>

<?php if (count($navItems) > 1): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            <?php foreach ($navItems as $i => $ni): ?>
                <?php if (!$ni->isCurrent): ?>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a href="<?php echo $ni->url; ?>" target="<?php echo $ni->target; ?>" itemprop="item">
                            <span itemprop="name"><?php echo $ni->name; ?></span>
                        </a>
                        <meta itemprop="position" content="<?php echo $i + 1; ?>">
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" aria-current="page">
                        <span itemprop="name"><?php echo $ni->name; ?></span>
                        <meta itemprop="position" content="<?php echo $i + 1; ?>">
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </nav>
<?php endif; ?>
