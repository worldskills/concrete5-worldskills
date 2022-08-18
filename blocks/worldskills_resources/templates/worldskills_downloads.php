<ul class="row ws-blockgrid">
    <?php foreach ($resources as $resource): ?>

        <?php
        $download = '';
        $thumbnail = '';
        foreach ($resource['versions'] as $version) {
            foreach ($version['translations'] as $translation) {
                foreach ($translation['links'] as $link) {
                    if ($link['rel'] == 'web_download'){
                        $download = $link['href'];
                        break;
                    }
                }
                $thumbnail = $translation['thumbnail']['link'];
                break;
            }
            break;
        }
        ?>

        <li class="ws-blockgrid-item col-6 col-sm-3">
            <div class="ws-blockgrid-block">
                <div class="ws-blockgrid-block-content">
                    <a href="<?php echo h($download); ?>" target="_blank" rel="noopener" class="ws-blockgrid-block-link ws-blockgrid-block-thumbnail">
                        <img src="<?php echo $thumbnail; ?>" alt="">
                    </a>
                </div>
            </div>
            <p class="h5">
                <a href="<?php echo h($download); ?>" target="_blank" rel="noopener">
                    <?php echo h($resource['name']['text']); ?>
                </a>
            </p>
        </li>

    <?php endforeach; ?>
</ul>
