<?php $squares = get_field('home_squares_list'); if ($squares) : ?>
<section class="home--squares">
    <div class="container">
        <h4><?php the_field('home_squares_title'); ?></h4>
        
        <div class="row justify-content-center">
        <?php foreach ($squares as $item) : ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 box">
                <div class="body">
                    <img src="<?php echo $item['image']; ?>" alt="box-image">
                    <p><?php echo $item['text']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif;