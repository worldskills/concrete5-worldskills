
<?php if ($people->getTotalCount() > 0): ?>
    
    <ul class="ws-imglist row">
        <?php foreach ($people as $i => $person): ?>
            <?php

            // Get the member
            $position = null;

            foreach ($person['positions'] as $pos) {
                if ($typeFilter == 'competitors' && $pos['position']['base_position']['short_name'] == $basePositionCompetitor && $pos['invalid'] == false) {
                    $position = $pos;
                    break;
                }
                if ($typeFilter == 'experts' && $pos['position']['base_position']['short_name'] == $basePositionExpert && $pos['invalid'] == false) {
                    $position = $pos;
                    break;
                }
            }

            // Get their member country for the flag.
            $member = null;
            $flag = null;

            if ($position) {
                $member = $position['member'];
            }
            if ($member) {
                $flag = $member['flag']['thumbnail'] . '_small';
            }

            ?>
            <li class="ws-imglist-item col-sm-3 col-6">
                <span class="ws-imglist-img-wrapper"<?php if ($flag) { echo ' style="background-image: url(' . h($flag) . ')"'; } ?>>
                    <?php if (isset($person['images'][0])): ?>
                        <img src="<?php echo h($person['images'][0]['thumbnail']); ?>_portrait" class="ws-imglist-img" alt="Photo of <?=h($person['first_name'])?> <?=h($person['last_name'])?>">
                    <?php else: ?>
                        <img src="https://people.worldskills.org/images/user_portrait.png" class="ws-imglist-img" alt="">
                    <?php endif; ?>
                </span>
                <h2 class="ws-imglist-title">
                    <?=h($person['first_name'])?> <?=h($person['last_name'])?>
                </h2>
                <p class="ws-imglist-desc">
                    <?php if ($position): ?>
                        <?php echo h($position['member']['name']['text']); ?>
                        <?php echo "<br>" . h($position['skill']['name']['text']); ?>
                    <?php endif; ?>
                </p>
            </li>

        <?php endforeach; ?>
    </ul>

<?php else: ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty people block.')?></div>
<?php endif; ?>
