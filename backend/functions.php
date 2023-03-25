<?php

/**
 * Thumbnails & menu support
 */
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    // add_theme_support('post-thumbnails');
}


/**
 * Get rid of tags on posts.
 */
function admin_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'admin_unregister_tags');


/**
 * Menu support
 */
function registerMenu()
{
    register_nav_menus(array(
        'header' => 'header',
        'footer' => 'footer'
    ));
}
add_action('init', 'registerMenu');


/**
 * Ping-back
 */
if (function_exists('add_filter')) { 
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('xmlrpc_methods', function( $methods ) {
        unset( $methods['pingback.ping'] );
        return $methods;
    });
}


/**
 * Remove wp info in header
 */
function remove_header_actions()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}


/**
 * Remove admin bar in to website
 *
 * @return bool
 */
function removeAdminBar()
{ 
    return false; 
}
add_filter('show_admin_bar' , 'removeAdminBar');


/**
 * WP Iframe wrapper
 * 
 * @param type $content
 * @return type
 */
function iframe_wrapper ($content) {
    // match any iframes
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
    $matches = array();
    
    preg_match_all($pattern, $content, $matches);

    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="video-box per-16x9">' . $match . '</div>';

        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }

    return $content;
}
add_filter('the_content', 'iframe_wrapper', 0);


/**
 * Create custom post gallery
 * 
 * @global object $post
 * @param string $output
 * @param array $attr
 * @return string
 */
function custom_post_gallery($output, $attr) 
{
    static $instance = 0;

    // get attachments
    $_attachments = get_posts(array(
        'post_status'       => 'inherit', 
        'post_type'         => 'attachment', 
        'post_mime_type'    => 'image',
        'posts_per_page'    => -1,
        'orderby'           => $attr['orderby'],
        'include'           => $attr['include']
    ));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
        $attachments[$val->ID] = $_attachments[$key];
    }

    // return empty
    if (empty($attachments)){ return ''; }
        
    $selector = "modal-gallery-".$instance++;
    
    $output .= '<div class="row magnific-gallery" data-id="gallery-'. $selector .'"  data-zoom="true">';
    foreach ($attachments as $file) {
        $large = wp_get_attachment_image_src($file->ID, 'large');
        $thumbnail = wp_get_attachment_image_src($file->ID, 'thumbnail');
        $title = $file->post_title ? '<h4>'. $file->post_title .'</h4>' : '';
        $description = $file->post_caption ? $file->post_caption : '';
        
        $output .= '<div class="col-6 col-md-4 col-xl-3">';
        $output .= '<a href="'. $large[0] .'" data-title="'. $title . $description .'">';
        $output .= '<img src="'. $thumbnail[0] .'" alt="'. $file->post_title .'">';
        $output .= '</a>';
        $output .= '</div>';
    }
    $output .= '</div>';
    return $output;
}
add_filter('post_gallery', 'custom_post_gallery', 10, 2);

// String translations
add_action('init', function () {
    pll_register_string('appcore', 'Cena');
    pll_register_string('appcore', 'Zarejestruj się');
    pll_register_string('appcore', 'Prowadzący');
    pll_register_string('appcore', 'Wszelkie prawa zastrzeżone');
    pll_register_string('appcore', 'Partnerzy konferecji');
    pll_register_string('appcore', 'Patronat');
    pll_register_string('appcore', 'Patron medialny');
    pll_register_string('appcore', 'Sponsorzy nagród');
    pll_register_string('appcore', 'Wybierz warsztat');
    pll_register_string('appcore', 'Wybierz');
    pll_register_string('appcore', 'Dane do noclegu');
    pll_register_string('appcore', 'Brak');
    pll_register_string('appcore', 'Losowa osoba');
    pll_register_string('appcore', 'Wybrana osoba');
    pll_register_string('appcore', 'Pokój jednoosobowy');
    pll_register_string('appcore', 'dodatkowo platne');
    pll_register_string('appcore', 'Wpisz dane osoby do zameldowania w pokoju');
    pll_register_string('appcore', 'Data');
});