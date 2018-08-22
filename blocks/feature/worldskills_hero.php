<?php
// This optionally accepts:
// $feature_kind, like 'quote' or 'standfirst'.
// $feature_color, like 'orange' or 'purple'.
// $feature_size, like 'sm'.

$style = "";
$classes = array();
// Some colors/styles have different button colors:
$button_class = "btn-outline-white";

if ($feature_kind) {
    array_push($classes, "ws-hero-".$feature_kind);

    if ($feature_kind == "standfirst") {
        $button_class = "btn-outline-dark";
    }
}

if ($feature_color) {
    array_push($classes, "ws-hero-".$feature_color);

    if ($feature_color == "purple") {
        $button_class = "btn-primary";
    }
}

if ($feature_size) {
    array_push($classes, 'ws-hero-'.$feature_size);
}

$class = implode(' ', $classes);

if ($feature_kind == "quote") {
    ?>
    <figure class="ws-hero <?=$class?>">
        <?php
        if ($title) {
        ?>
            <blockquote class="ws-hero-title"><?=$title?></blockquote>
        <?php
        }
        ?>
        <figcaption>
            <?php
            if ($paragraph) {
                ?>
                <div class="ws-hero-desc">
                    <?=$paragraph?>
                </div>
            <?php
            }
            if ($linkURL) {
            ?>
                <a class="btn btn-more <?=$button_class?>" href="<?=$linkURL?>">Find out more</a>
            <?php
            }
            ?>
        </figcaption>
    </figure>
<?php
} else {
    ?>
    <section class="ws-hero <?=$class?>">
        <?php
        if ($title) {
        ?>
            <h1 class="ws-hero-title"><?=$title?></h1>
        <?php
        }
        if ($paragraph) {
            ?>
            <div class="ws-hero-desc">
                <?=$paragraph?>
            </div>
        <?php
        }
        if ($linkURL) {
        ?>
            <a class="btn btn-more <?=$button_class?>" href="<?=$linkURL?>">Find out more</a>
        <?php
        }
        ?>
    </section>
<?php
}
