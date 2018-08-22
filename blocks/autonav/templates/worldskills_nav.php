<?php
$navItems = $controller->getNavItems();
$subNavItems = array();

$u = new \User();

/* @var Concrete\Core\Validation\CSRF\Token $token */
$token = \Core::make('helper/validation/token');

$c = \Page::getCurrentPage();
?>

<button class="navbar-toggler collapsed ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    Menu
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
        <?php foreach ($navItems as $ni) : ?>
            <?php if (!$ni->isHome): ?>
                <?php if ($ni->level < 2): ?>
                    <?php
                    $classes = array('nav-item');
                    $href = $ni->url;
                    if ($ni->isCurrent || $ni->inPath) {
                        $classes[] = 'active';
                    }
                    if ($ni->hasSubmenu) {
                        $classes[] = "has-subnav";
                    }
                    $classes = implode(" ", $classes);
                    ?>
                    <li class="<?php echo $classes; ?>">
                        <a class="nav-link" href="<?php echo $href; ?>" target="<?php echo $ni->target; ?>"><?php echo $ni->name; ?></a>
                    </li>
                <?php else: ?>
                    <?php
                    $subNavItems[] = $ni;
                    ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
