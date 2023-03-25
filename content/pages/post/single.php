<section class="post--singe">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        
        <?php $mainImage = get_the_post_thumbnail($post, 'medium'); if ($mainImage) : ?>
            <div class="main-image">
                <?php echo $mainImage; ?>
            </div>
        <?php endif; ?>
        
        <div class="wp-content">
            <?php the_content(); ?>
        </div>
        
        <div class="author row">
            <div class="col">
                <b>Autor:</b>
                <span><?php the_author(); ?></span>
            </div>
        </div>
    </div>
</section>
