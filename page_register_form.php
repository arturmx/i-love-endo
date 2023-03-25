<?php /* Template Name: Register Form */ 

// get form data
$form_data = init_register_form ();

// custom meta
custom_meta_tags(['ajax-url' => admin_url("admin-ajax.php")]);

// Register page JS
add_js_to_footer([
    'register-form' => '/public/build/js/form.js',
    'form-js-validator' => '/public/build/js/qwerty_form_validator.js',
    'register-form-valid' => '/public/build/js/form_valid.js'
]);
?>

<?php get_header('type2'); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/register/form.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer