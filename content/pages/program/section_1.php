<div class="program--section-1">
    <div class="container">
        <h2><?php the_field('section_1_title'); ?></h2>
        <?php $sub = get_field('section_1_title_sub'); if ($sub) { echo '<p class="sub">'. $sub .'</p>'; } ?>
        
        <?php $boxes = get_field('section_1_boxes'); ?>
        <?php if (!empty($boxes)) : ?>
            <div class="row justify-content-center">
                <?php foreach ($boxes as $box) : ?>   
                <div class="col-12 col-lg-6 box">
                    <div class="body">
                        <?php echo $box['box']; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>