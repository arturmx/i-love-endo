<section class="home--red">
    <div class="container">
        <div class="row boxes justify-content-center">
            <?php foreach(get_field('home_red_boxes') as $box) : ?>
            <div class="col-12 col-lg-4 box-parent">
                <div class="box">
                    <img src="<?php echo $box['image']; ?>" alt="<?php echo $box['title']; ?>">
                    <h5><?php echo $box['title']; ?></h5>
                    <?php echo $box['text']; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <?php echo get_field('home_red_center_title') ? '<h4>'. get_field('home_red_center_title') .'</h4>' : ''; ?>
        
        <?php $lecturers = get_field('lecturers_list', get_field('home_red_lecturers')); if ($lecturers) : ?>
        <div class="row lecturers">
            
            <?php foreach ($lecturers as $lector) : ?>
            <div class="col-12 col-md-6 col-xl-3 real">
                <article>
                    <?php $photo = $lector['photo'] ? $lector['photo']['sizes']['thumbnail'] : public_uri().'/img/photo-default.jpg'; ?>
                    <img src="<?php echo $photo; ?>" alt="<?php echo $lector['name']; ?>">
                    <p class="status"><?php echo $lector['status']; ?></p>
                    <h3><?php echo $lector['name']; ?></h3>
                    <div class="desc">
                       <?php echo $lector['short_description']; ?> ...
                    </div>
                    <a class="link" href="<?php the_permalink(get_field('home_red_lecturers')); ?>#<?php echo slugify($lector['name']); ?>">Dowiedz się więcej »</a>
                </article>
            </div>
            <?php endforeach; ?>
            
            
            
        </div>
        <?php endif; ?>
    </div>
</section>