<?php get_header(); // include header ?>

<main>
    <div class="page--default">
        <div class="container text-center">
            <br>
            <img src="<?php echo public_uri(); ?>/img/404.png" alt="page 404" style="max-width: 100%">

            <h1 style="color: #a88ae6; font-size: 5em;"><b>404</b></h1>
            <h5>Strona nie znaleziona!</h5>

            <br>
            <a class="button-default" href="<?php echo home_url('/'); ?>">Przejdź do strony głównej</a>
        </div>
    </div>
</main>
    
<?php get_footer(); // include footer