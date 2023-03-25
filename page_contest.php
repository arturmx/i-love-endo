<?php /* Template Name: Contest */ ?>

<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/contest/index.php');
    endif; ?>
</main>

<?php get_footer(); // footer