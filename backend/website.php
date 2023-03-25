<?php

 // Classes autoload
 require_once __DIR__ . '/Classes/Front/Form.php';
 require_once __DIR__ . '/Classes/Front/DotPay.php';

/**
 * Add JS to footer
 *
 * @param array $options
 * @param bool $external
 */
function add_js_to_footer ($options, $external = false)
{
    if ($external) {
        $dir = '';
    } else {
        $dir = get_template_directory_uri();
    }

    foreach ($options as $key => $value) {
        wp_register_script ($key, $dir . $value, array(), null, true);
        wp_enqueue_script ($key);
    }
}


/**
 * Add CSS to header
 * 
 * @param array $options
 * @param bool $external
 */
function add_css_to_header ($options, $external = false)
{
    if ($external) {
        $dir = '';
    } else {
        $dir = get_template_directory_uri();
    }
    
    foreach ($options as $key => $value) {
        wp_register_style ($key, $dir . $value, array(), null);
        wp_enqueue_style ($key);
    }
}


/**
 * Create custom Meta tags
 * 
 * @param array $options
 */
function custom_meta_tags ($options)
{
    $custom_meta_tags = function  () use ($options) {
        foreach ($options as $key => $value) {
            echo '<meta name="'. $key .'" content="'. $value .'">';
        }
    };

    add_action('wp_head', $custom_meta_tags, 1);
}


/**
 * Website public URI
 * 
 * @return string
 */
function public_uri ()
{
    return get_template_directory_uri() . '/public';
}


/**
 * Set header custom status
 * 
 * @param int|string $status
 */
function set_header_custom_status ($status)
{
    define("HEADER_CUSTOM_STATUS", $status);
}


/**
 * Get header custom status
 */
function get_header_custom_status ()
{
    if (defined("HEADER_CUSTOM_STATUS")) {
        return HEADER_CUSTOM_STATUS;
    }
    
    return false;
}


/**
 * Include SVG to html
 * 
 * @param string $link
 */
function insertSvg ($link)
{
    echo file_get_contents(TEMPLATEPATH ."/public/". $link);
}


/**
 * Get posts by WP_Query
 * 
 * @param array $options
 * @return \WP_Query|null
 */
function get_post_wp_query ($options = false)
{
    $query = array(
        'post_type'         => isset($options['type'])      ? $options['type']      : 'post',
        'posts_per_page'    => isset($options['per_page'])  ? $options['per_page']  : 10,
        'orderby'           => isset($options['orderby'])   ? $options['orderby']   : 'id',
        'order'             => isset($options['order'])     ? $options['order']     : 'DESC',
    );

    if (isset($options['exclude']) && is_array($options['exclude'])) {
       $query['post__not_in'] = $options['exclude'];
    }

    $custom_query = new WP_Query($query);

    if (!empty($custom_query->posts)) {
        return $custom_query;
    }

    return null;
}


/**
 * Show post thumbnail image
 * 
 * @param type $post_id
 * @param string|array $size (string|array) 'thumbnail', 'medium', 'large', 'full'
 */
function show_post_thumbnail ($post_id, $size)
{
    echo get_the_post_thumbnail($post_id, $size);
}


/**
 * Text lenght exception
 * 
 * @param string $text
 * @param int $max_leng
 * @param string $after
 * @return string
 */
function text_length_exception ($text, $max_leng, $after = false)
{
    $output = trim($text);
    
    if (strlen($output) <= $max_leng) {
        return $output;
    }
    
    return preg_replace("/[^A-Za-z0-9?!]/", "", mb_substr($output, 0, $max_leng)) . $after;
}


/**
 * Slug generator
 * 
 * @param string $text
 * @return string
 */
function slugify ($text)
{
  // replace non letter or digits by -
  $text1 = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text2 = iconv('utf-8', 'us-ascii//TRANSLIT', $text1);

  // remove unwanted characters
  $text3 = preg_replace('~[^-\w]+~', '', $text2);

  // trim
  $text4 = trim($text3, '-');

  // remove duplicate -
  $text5 = preg_replace('~-+~', '-', $text4);

  // lowercase
  $text6 = strtolower($text5);

  if (empty($text6)) {
    return 'n-a';
  }

  return $text6;
}


/**
 * Custom POSTS paginator
 * 
 * @global object $wp_query
 */
function articles_pagination_render ()
{
    global $wp_query;
    
    $big = 999999999;
    $current = max(1, get_query_var('paged'));
    $total = $wp_query->max_num_pages;

    if ($current == 1 || $current == $total) { $mid_size = 2; } 
    else { $mid_size = 1; }

    $args = array(
        'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'    => '',
        'current'   => $current,
        'total'     => $total,
        'mid_size'  => $mid_size,
        'next_text' => __('Następna strona'),
        'prev_text' => __('Poprzednia strona')
    );

    $paginator = paginate_links($args);
    $result = str_replace('/page/1/', '', $paginator);

    if ($result) {
        echo '<div class="pagination">'. $result .'</div>';
    }
}


/**
 * Get cookies by name
 * 
 * @param string $name
 * @return mixin
 */
function get_cookies_by_name ($name)
{
    $cookie = $_COOKIE;
    return isset($cookie[$name]) ? $cookie[$name] : null; 
}


/**
 * Init register form and Get form data
 * 
 * @return array
 */
function init_register_form ()
{
    $form = new \Classes\Front\Form();
    $form->setRequest();
    $form->useGet();
    $form_data = $form->getFormData();
    
    if (!$form_data) {
        $rlink = get_post_permalink(14); // packets page
        if ($rlink) {
            wp_redirect($rlink);
        } else {
            wp_redirect('/');
        }
    }
    
    return $form_data;
}


/**
 * Get form data by aJax
 */
function get_form_data_ajax ()
{
    $form = new \Classes\Front\Form();
    $form->setRequest();
    $form->usePost();
    $form_data = $form->getFormData();

    if ($form_data) {
        wp_send_json(['result' => $form_data]);
    } else {
        wp_send_json(['error' => 'Ten pakiet nie istnieje! Skontaktuj się z administratorem strony.']);
    }
    die;
}
add_action('wp_ajax_formDataAjax', 'get_form_data_ajax');
add_action('wp_ajax_nopriv_formDataAjax', 'get_form_data_ajax');


/**
 * Get form data by aJax
 */
function startPaymentAjax ()
{
    $form = new \Classes\Front\Form();
    $form->setRequest();
    $form->usePost();

    // Validation
    $validErrors = $form->formValid('post');
    if ($validErrors) {
        wp_send_json(['error' => 'Błąd walidacji, sprawdz poprawność wypełnienia formularzu.']); die;
    }

    // payment settings
    $payment_settings = [
        'dotPay'    => get_field('dotpay_settings', 261),
        'url'       => get_field('status_page', 261)
    ];

    // Payment 
    if ($payment_settings['dotPay'] && $payment_settings['url']) {
        // Insert form data to database
        $save = $form->insertDataToDB($form->getPostData());
        if (!$save) { wp_send_json(['error' => 'Błąd zapisu do bazy danych. Skontaktuj się z nami!']); die; }

        // Go to payment
        if ($form->getPostData('payment-type') === 'transfer') {
            // Transfer Payment
            wp_send_json(['result' => $form->transferPaymentForm($payment_settings)]);
        } else {
            // DotPay payment
            wp_send_json(['result' => $form->dotPayRenderForm($payment_settings)]);
        }
    } else {
        wp_send_json(['error' => 'Zła konfiguracja płatnośći. Skontaktuj się z nami!']);
    }
    
    die;
}
add_action('wp_ajax_startPaymentAjax', 'startPaymentAjax');
add_action('wp_ajax_nopriv_startPaymentAjax', 'startPaymentAjax');


/**
 * Check Payment status
 */
function check_payment_status ()
{
    $form = new \Classes\Front\Form();
    $form->setRequest();
    $status = $form->checkPaymentStatus();

    if (!$status) {
        $rlink = get_post_permalink(14); // packets page
        if ($rlink) {
            wp_redirect($rlink);
        } else {
            wp_redirect('/');
        }
    }

    return $status;
}


/**
 * Get form data by aJax
 */
function check_sale_ajax ()
{
    $form = new \Classes\Front\Form();
    $form->setRequest();
    $form->usePost();
    $sale = $form->checkSaleAjax();

    if ($sale) {
        wp_send_json(['result' => $sale]);
    } else {
        wp_send_json(['error' => 'Niedziałający kod rabatowy']);
    }
    die;
}
add_action('wp_ajax_checkSaleAjax', 'check_sale_ajax');
add_action('wp_ajax_nopriv_checkSaleAjax', 'check_sale_ajax');