<?php /* Template Name: Partners */ ?>

<?php get_header('type2'); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/partners/index.php');
    endif; ?>
</main>

<?php get_footer(); // footer