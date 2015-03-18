<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

	<footer id="footer">
    	<div class="wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                        <?php
                        $a = new GlobalArea('Footer Site Title');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 footernavblock">
                        <?php
                        $a = new GlobalArea('Footer Navigation');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 footernavblock">
                        <?php
                        $a = new GlobalArea('Footer Contact');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 footernavblock">
                        <?php
                        $a = new GlobalArea('Footer Social');
                        $a->display();
                        ?>
                    </div>
                </div>
                <div class="row copyright">
                    <hr>
                    <div class="col-lg-9 col-md-12">
                        <?php
                        $a = new GlobalArea('Footer Legal');
                        $a->display();
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <a href="#" class="backtotop sp-after">Back to top</a>
                    </div>
                </div>
            </div>
        </div>
	</footer>
</div>

<script src="<?=$this->getThemePath()?>/js/bootstrap.min.js"></script>
<script src="<?=$this->getThemePath()?>/js/general.js"></script>

<?php Loader::element('footer_required'); ?>

</body>
</html>
