<section class="post--list">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-10 mx-auto">
                <div class="row">
                    <?php if (have_posts()) : ?>
                    
                        <!-- articles -->
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <article class="wow animation-FadeInUp" data-wow-offset="90" data-wow-duration="1s">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="content">
                                            <?php show_post_thumbnail($post->ID, 'thumbnail'); ?>
                                            <div class="categories">
                                                <?php 
                                                    $post_categories = wp_get_post_categories($post->ID);
                                                    $cat_count = 0;
                                                    foreach ($post_categories as $c) {
                                                        $cat = get_category( $c );
                                                        if ($cat_count++ > 0) { echo ' <span> / </span> '; }
                                                        echo '<span>'. $cat->name. '</span>';
                                                    }
                                                ?>
                                            </div>
                                            <h3><?php echo text_length_exception (get_the_title(), 80, ' ...'); ?></h3>
                                        </div>
                                    </a>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    
                        <!-- pagination -->
                        <div class="col-12"><?php articles_pagination_render(); ?></div>
                        
                    <?php else: ?>  
                        <div class="empty">
                            <h2>Przepraszamy, brak aktualnośći w tej kategorii</h2>
                            <p>Proszę sprawdz inną kategorię</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>       
</section>