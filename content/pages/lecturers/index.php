<section class="page--red lecturers--page">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        
        <?php $lecturers = get_field('lecturers_list', get_field('home_red_lecturers')); if ($lecturers) : ?>
            <div class="row">
            <?php foreach ($lecturers as $lector) : ?>
                <div class="col-12 col-lg-6 lecturer" id="<?php echo slugify($lector['name']); ?>">
                    <article>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <?php $photo = $lector['photo'] ? $lector['photo']['sizes']['thumbnail'] : public_uri().'/img/photo-default.jpg'; ?>
                                <img src="<?php echo $photo; ?>" alt="<?php echo $lector['name']; ?>">
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="title">
                                    <p class="status"><?php echo $lector['status']; ?></p>
                                    <h3><?php echo $lector['name']; ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="desc">
                           <?php echo $lector['description']; ?>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>