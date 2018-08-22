<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

    </main>

    <footer class="ws-page-footer">
        <div class="container">
            <div class="ws-page-footer-row">
                <aside class="ws-page-footer-col-sm">
                    <?php
                    $a = new GlobalArea('Footer Site Title');
                    $a->display();
                    ?>
                </aside>
                <aside class="ws-page-footer-col-sm">
                    <?php
                    $a = new GlobalArea('Footer Navigation');
                    $a->display();
                    ?>
                </aside>
                <aside class="ws-page-footer-col-sm">
                    <?php
                    $a = new GlobalArea('Footer Contact');
                    $a->display();
                    ?>
                </aside>
                <aside class="ws-page-footer-col-sm">
                    <?php
                    $a = new GlobalArea('Footer Social');
                    $a->display();
                    ?>
                </aside>
                <aside class="ws-page-footer-col-md">
                    <?php
                    $a = new GlobalArea('Footer Search');
                    $a->setCustomTemplate('search', 'worldskills_footer.php');
                    $a->display();
                    ?>
                </aside>
            </div>
            <div class="ws-page-footer-row">
                <div class="ws-page-footer-col-lg">
                    <?php
                    $a = new GlobalArea('Footer Copyright');
                    $a->display();
                    ?>
                </div>
                <div class="ws-page-footer-col-lg">
                    <p class="text-md-right">
                        <?php echo Core::make('helper/navigation')->getLogInOutLink(); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</div>

<?php Loader::element('footer_required'); ?>

<?php echo $html->javascript($this->getThemePath() . '/js/popper.js/popper.min.js'); ?>
<?php echo $html->javascript($this->getThemePath() . '/js/bootstrap/bootstrap.min.js'); ?>

</body>
</html>
