<?php if (count($skills) > 0): ?>
    <?php foreach ($skills as $i => $skill): ?>
        <?php
        $hasGold = false;
        $hasSilver = false;
        $hasBronze = false;
        foreach ($results as $result) {
            if ($result['skill']['id'] == $skill['id']) {
                if ($result['medal']['code'] == 'GOLD') {
                    $hasGold = true;
                }
                if ($result['medal']['code'] == 'SILVER') {
                    $hasSilver = true;
                }
                if ($result['medal']['code'] == 'BRONZE') {
                    $hasBronze = true;
                }
            }
        }
        ?>
        <h2><?php echo h($skill['name']['text']); ?></h2>
        <div class="row">
            <div class="col-md-4">
                <?php if ($hasGold): ?>
                    <h3><?php echo t('Gold'); ?></h3>
                    <?php
                    foreach ($results as $result) {
                        if ($result['skill']['id'] == $skill['id'] && $result['medal']['code'] == 'GOLD') {
                            include __DIR__ . '/view_result.php';
                        }
                    }
                    ?>
               <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ($hasSilver): ?>
                    <h3><?php echo t('Silver'); ?></h3>
                    <?php
                    foreach ($results as $result) {
                        if ($result['skill']['id'] == $skill['id'] && $result['medal']['code'] == 'SILVER') {
                            include __DIR__ . '/view_result.php';
                        }
                    }
                    ?>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ($hasBronze): ?>
                    <h3><?php echo t('Bronze'); ?></h3>
                    <?php
                    foreach ($results as $result) {
                        if ($result['skill']['id'] == $skill['id'] && $result['medal']['code'] == 'BRONZE') {
                            include __DIR__ . '/view_result.php';
                        }
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
        <hr/>
    <?php endforeach; ?>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty results block.')?></div>
<?php endif; ?>
