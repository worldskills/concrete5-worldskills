<?php
// Subheading.
// Creates an <h2> and an optional <a>.

if ($paragraph) {
    $link_text = strip_tags($paragraph);
} else {
    $link_text = "More";
}

?>

<header class="ws-heading-sub">
    <h2 class="ws-heading-sub-title ws-h-icon"><?=$title?></h2>
    <?php
        if ($linkURL) {
            ?>
            <a class="ws-heading-link" href="<?=$linkURL?>"><?=$link_text?></a>
        <?php
        }
        ?>
</header>
