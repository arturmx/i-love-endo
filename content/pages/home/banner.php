<section class="home--banner">
    <div class="container">
        <div class="content">
            <?php the_content(); ?>
            
            <?php $buttons = get_field('home_banner_buttons'); if ($buttons) : ?>
            <div class="buttons">
                <?php foreach ($buttons as $button) : ?>
                    <a class="button-default <?php echo $button['color']; ?>" href="<?php echo $button['link']; ?>">
                        <?php echo $button['text']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>