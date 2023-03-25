<?php /* Template Name: Homepage */

    // Homepage custom JS
    add_js_to_footer(['homepage' => '/public/build/js/home.js']);
?>

<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/home/banner.php');
        require (TEMPLATEPATH . '/content/pages/home/red.php');
        require (TEMPLATEPATH . '/content/pages/home/squares.php');
        require (TEMPLATEPATH . '/content/pages/home/contacts.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer