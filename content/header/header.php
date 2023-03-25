<div class="container">
    <!-- logo -->
    <span class="logo">
        <a href="<?php echo pll_home_url(); ?>">
            <?php insertSvg('img/svg/logo.svg'); ?>

            <?php if (get_locale() == 'en_GB') {
                insertSvg('img/svg/sub-logo-eng.svg');
            } else {
                insertSvg('img/svg/sub-logo.svg');
            }
             ?>
        </a>
    </span>
        
    <!-- menu -->
    <nav class="main-menu">
        <div class="body">
            <?php wp_nav_menu(array(
                'theme_location' => 'header',
                'menu_class' => false,
                'menu_id' => 'main-menu-ul',
                'container' => false
            )); ?>
            <?php require (TEMPLATEPATH . '/content/header/top_bar.php'); ?>
        </div>
        <span class="mobile-button"><span></span></span>
    </nav>
</div>