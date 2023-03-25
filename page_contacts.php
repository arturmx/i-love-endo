<?php /* Template Name: Contacts */ ?>

<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/contacts/index.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer