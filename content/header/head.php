<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(" | "); ?></title>

<?php remove_header_actions(); $publicURI = public_uri (); ?>

<!-- Favicons -->
<link href="<?php echo $publicURI; ?>/img/favicon.png" rel="icon">
<link href="<?php echo $publicURI; ?>/img/favicon.png" rel="apple-touch-icon">

<!-- Pingback -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Styles -->
<link href="<?php echo $publicURI; ?>/build/css/app.css" rel="stylesheet">
<link href="<?php echo $publicURI; ?>/build/css/gallery.css" rel="stylesheet">
<link href="<?php echo $publicURI; ?>/build/css/more.css" rel="stylesheet">

<?php wp_head();