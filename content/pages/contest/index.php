<section class="page--default">
    <?php require (TEMPLATEPATH . '/content/pages/contest/banner.php'); ?>

    <div class="contest--description">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 offset-xl-1">

                    <div class="main-text">
                        <?php the_field('description'); ?>
                    </div>

                    <?php require (TEMPLATEPATH . '/content/pages/contest/awards.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php require (TEMPLATEPATH . '/content/pages/contest/sponsors.php'); ?>

    <div class="contest--bottom-description">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 offset-xl-1">
                    <?php the_field('bottom_description'); ?>

                    <div class="grey-box">
                        <?php the_field('grey_box'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>