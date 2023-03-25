<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/default/index.php'); // Single page
    endif; ?>
</main>

<?php get_footer(); // footer