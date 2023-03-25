<?php /* Template Name: Register Thanks */

$paymentStatus = check_payment_status();
?>

<?php get_header(); // header ?>

<main>
    <?php if (have_posts()) :
        the_post(); // init post
    
        require (TEMPLATEPATH . '/content/pages/register/thanks.php');
        require (TEMPLATEPATH . '/content/modules/partners_line.php');
    endif; ?>
</main>

<?php get_footer(); // footer