<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/packets/index.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer