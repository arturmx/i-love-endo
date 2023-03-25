<?php
// All packets
$packets = get_posts(['numberposts' => -1, 'post_type' => 'packet', 'order' => 'ASC']);

// premium
for ($i = 0; $i < count($packets); $i++) {
    if (get_field('premium', $packets[$i]->ID)) {
        $premiumPack = $packets[$i];
        break;
    }
}
?>

<section class="page--default">
    <div class="container">
        <h1><?php the_title(); ?></h1>

        <div class="premium--banner">
            <?php the_content(); ?>
            <h5><?php pll_e('Cena'); ?></h5>
            <h4><?php the_field('cena', $premiumPack->ID); ?> zł</h4>
        </div>
    </div>

    <div class="premium--grey-box">
        <h4><?php pll_e('Prowadzący'); ?>:</h4>
        <?php require(TEMPLATEPATH . '/content/pages/premium/lecturers.php'); ?>
    </div>

    <div class="container premium--section">
        <div class="wm872">
            <div class="text-center">
                <h2><?php the_field('section_title'); ?></h2>
                <p><?php the_field('section_sub_title'); ?></p>
            </div>

            <?php require(TEMPLATEPATH . '/content/pages/premium/squares.php'); ?>

            <div class="description">
                <?php the_field('section_description'); ?>
            </div>

            <div class="row">
                <div class="price">
                    <p>
                        <?php pll_e('Cena'); ?> <br>
                        <b><?php the_field('cena', $premiumPack->ID); ?> zł</b>
                    </p>
                </div>
                <div class="button-body">
                    <a class="button-default" href="<?php the_field('register_link', 14); ?>?pakiet=<?php echo $premiumPack->ID; ?>">
                        <?php pll_e('Zarejestruj się'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>