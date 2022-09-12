<?php if (!$event): ?>

    <?php foreach($resources as $resource): ?>
        <?php
        $download = '';
        foreach ($resource['versions'] as $version) {
            foreach ($version['translations'] as $translation) {
                foreach ($translation['links'] as $link) {
                    if ($link['rel'] == 'web_download'){
                        $download = $link['href'];
                        break;
                    }
                }
                break;
            }
            break;
        }
        ?>

        <?php if ($download): ?>
            <p><a href="<?php echo h($download); ?>" target="_blank" rel="noopener" class="d-inline-block w-100 text-truncate"><?php echo h($resource['name']['text']); ?></a></p>
        <?php endif; ?>

    <?php endforeach; ?>

<?php else: ?>

    <?php foreach ($skills as $skill): ?>
        <?php if ($lastSector != $skill['sector']['id']): ?>
            <h2><?php echo h($skill['sector']['name']['text']); ?></h2>
        <?php endif; ?>
        <?php
        $lastSector = $skill['sector']['id'];
        ?>

        <div class="row">
            <div class="col-md-6">
                <p>
                    <?php echo h($skill['name']['text']); ?>
                </p>
            </div>

            <?php
            $skillTag = 'Skill ' . $skill['number'];
            ?>

            <div class="col-md-6">
                <?php foreach($resources as $resource): ?>
                    <?php
                    $found = false;
                    foreach ($resource['tags'] as $tag) {
                        if ($tag == $skillTag) {
                            $found = true;
                            break;
                        }
                    }
                    ?>
                    <?php if ($found): ?>
                        <?php
                        $download = '';
                        foreach ($resource['versions'] as $version) {
                            foreach ($version['translations'] as $translation) {
                                foreach ($translation['links'] as $link) {
                                    if ($link['rel'] == 'web_download'){
                                        $download = $link['href'];
                                        break;
                                    }
                                }
                            }
                        }
                        ?>

                        <?php if ($download): ?>
                            <p><a href="<?php echo h($download); ?>" target="_blank" rel="noopener" class="d-inline-block w-100 text-truncate"><?php echo h($resource['name']['text']); ?></a></p>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

<?php if (count($resources) == 0): ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Resources block.')?></div>
<?php endif; ?>
