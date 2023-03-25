<?php $publicURI = public_uri(); ?>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="order-1 col-12 col-md-6 text-right">
                <a href="<?php echo site_url('/'); ?>">
                    <div class="logo">
                        <?php insertSvg('img/svg/logo.svg'); ?>
                    </div>
                </a>
            </div>

            <div class="order-3 order-md-0 col-12 col-md-6">
                <span>© Poldent sp. z .o.o. <?php pll_e('Wszelkie prawa zastrzeżone'); ?></span>
            </div>

            <?php $top_bar = get_field('header_top_bar', 2); ?>
            <?php if (isset($top_bar['social']) && !empty($top_bar['social'])) : ?>
                <div class="order-2 col-12 d-md-none">
                    <ul class="social-links">
                        <?php foreach ($top_bar['social'] as $social) : ?>
                            <li><a href="<?php echo $social['link']; ?>" target="_blank">
                                    <img src="<?php echo $social['icon']; ?>" alt="<?php echo $social['link']; ?>">
                                </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </div>
</footer>

<script src="<?php echo $publicURI; ?>/build/js/app.js"></script>

<?php wp_footer(); ?>
<?php require_once(TEMPLATEPATH . '/content/modules/cookies.php'); ?>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134364881-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-134364881-1');
</script>
</body>

</html>