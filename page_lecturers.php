<?php /* Template Name: Lecturers */ ?>

<?php get_header('type2'); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/lecturers/index.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer