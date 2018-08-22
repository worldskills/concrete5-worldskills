<?php if (count($skills) > 0): ?>
    <?php foreach ($skills as $i => $skill): ?>
        <h2><?php echo h($skill['name']['text']); ?></h2>

        <ul class="ws-imglist row">
            <?php foreach ($results as $result): ?>
                <?php if ($result['skill']['id'] == $skill['id'] && $result['medal']): ?>
                    <?php foreach ($result['competitors'] as $competitor):  ?>
                        <li class="ws-imglist-item col-sm-3 col-6">
                            <span class="ws-imglist-img-wrapper" style="background-image: url(<?=$result['member']['flag']['thumbnail']?>)">
                                <?php if (isset($competitor['image']) && $competitor['image']): ?>
                                    <img class="ws-imglist-img" src="<?php echo h($competitor['image']['thumbnail']); ?>_portrait" alt="Photo of <?=h($competitor['first_name'])?> <?=h($competitor['last_name'])?>">
                                <?php else: ?>
                                    <img class="ws-imglist-img" src="https://people.worldskills.org/images/user_portrait.png" alt="">
                                <?php endif; ?>
                            </span>
                            <h2 class="ws-imglist-title">
                                <?=h($competitor['first_name'])?> <?=h($competitor['last_name'])?>
                            </h2>
                            <p class="ws-imglist-desc">
                                <?php
                                if ($result['medal']) {
                                    echo h($result['member']['name']['text']);
                                    echo "<br>" . h($result['medal']['name']['text']);
                                }
                                ?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

        <hr/>

    <?php endforeach; ?>
<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty results block.')?></div>
<?php endif; ?>
