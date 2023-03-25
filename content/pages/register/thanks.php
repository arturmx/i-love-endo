<section class="page--default page--thanks">
    <div class="container">

        <?php if ($paymentStatus === 'OK') : ?>
            <h1><?php the_field('ok_title'); ?></h1>
            <div class="wp-content">
                <?php the_content(); ?>
            </div>

        <?php elseif ($paymentStatus === 'FAIL') : ?>
            <h1><?php the_field('fail_title'); ?></h1>
            <div class="wp-content">
                <?php the_field('fail'); ?>
            </div>

        <?php elseif ($paymentStatus === 'TRANSFER') : ?>
            <h1><?php the_field('transfer_title'); ?></h1>
            <div class="wp-content">
                <?php the_field('transfer'); ?>
            </div>

        <?php endif; ?>

    </div>
</section>
