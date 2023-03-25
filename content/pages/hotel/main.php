<div class="hotel--main">
    <div class="container">
        
        <div class="banner">
            <img src="<?php the_field('banner'); ?>" alt="hotel banner">
            <?php $banner_content = get_field('banner_content'); if($banner_content) : ?>
                <div class="content"><?php echo $banner_content; ?></div>
            <?php endif; ?>
        </div>
        
        <?php $main_content = get_field('content'); if ($main_content['left'] || $main_content['right']) : ?>
            <div class="description row justify-content-center">
                <?php if ($main_content['left']) : ?>
                    <div class="col-12 col-lg-6 left">
                        <?php echo $main_content['left']; ?>
                    </div>
                <?php endif; ?>
                <?php if ($main_content['right']) : ?>
                    <div class="col-12 col-lg-6 right">
                        <?php echo $main_content['right']; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>