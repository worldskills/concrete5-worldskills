<?php foreach ($result['competitors'] as $competitor):  ?>
    <div class="row">
        <div class="col-sm-4">
            <p>
                <?php if (isset($competitor['image']) && $competitor['image']): ?>
                    <img class="img-responsive" src="<?php echo h($competitor['image']['thumbnail']); ?>_portrait" alt="">  
                <?php else: ?>
                    <img src="https://people.worldskills.org/images/user_portrait.png">
                <?php endif; ?>
            </p>
        </div>
        <div class="col-sm-8">
            <p>
                <?php echo h($competitor['first_name']); ?> <?php echo h($competitor['last_name']); ?><br/>
                <span class="text-muted"><?php echo h($result['member']['name']['text']); ?></span>
            </p>
        </div>
    </div>
<?php endforeach; ?>
