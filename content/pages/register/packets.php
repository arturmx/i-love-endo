<?php $packets = get_posts(['numberposts' => -1, 'post_type' => 'packet', 'order' => 'ASC']); ?>
<?php $options = get_categories(['taxonomy' => 'option', 'hide_empty' => 0, 'orderby' => 'term_order', 'order' => 'ASC']); ?>

<?php
// Remove Premium in List
for ($i = 0; $i < count($packets); $i++) {
    if (get_field('premium', $packets[$i]->ID)) {
        unset($packets[$i]);
    }
}
?>

<?php if (!empty($packets) && !empty($options)) : ?>
    <div class="register--packets">
        <div class="container">

            <!-- PC -->
            <div class="d-none d-lg-block">
                <?php
                    // Include data for PC
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/titles.php');
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/options.php');
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/trenings.php');
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/accommodation.php');
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/grey.php');
                    require_once(TEMPLATEPATH . '/content/pages/register/pc/price.php');
                    ?>
            </div>
            <!-- PC END -->

            <!-- Buttons -->
            <?php if (pll_current_language() == 'pl') : ?>
            <div class="row buttons-body">
                <div class="col-12 col-lg-3"> &nbsp; </div>
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <?php foreach ($packets as $packet) : ?>
                            <div class="col-12 col-lg">
                                <!-- Mobile -->
                                <div class="d-lg-none">
                                    <?php
                                        // Include data for Mobile
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/title.php');
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/options.php');
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/trenings.php');
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/accommodation.php');
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/grey.php');
                                        require(TEMPLATEPATH . '/content/pages/register/mobile/price.php');
                                        ?>
                                </div>
                                <!-- Mobile END -->

                                <form action="<?php the_field('register_link'); ?>" method="GET" 
									data-id="<?php echo $packet->ID; ?>" 
									data-noclegi="<?php echo get_field('noclegi', $packet->ID) ? 'yes' : 'no'; ?>"
								>
                                    <input type="hidden" name="warsztat" value="0">
                                    <input type="hidden" name="noclegi" value="0">
                                    <input type="hidden" name="pakiet" value="<?php echo $packet->ID; ?>">
                                    <input type="submit" value="Wybieram" class="button-default">
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php else : ?>
                <p>&nbsp;</p>
            <?php endif; ?>
            <!-- Buttons END -->

        </div>
    </div>
<?php endif;
