<?php /* Template Name: Register */ 

// Register page JS
add_js_to_footer(['register-page' => '/public/build/js/register.js']);
?>

<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/register/index.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer