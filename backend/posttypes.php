<?php

// Services --------------------------------------------------------------------
/**
 * Packets post type
 */
function create_packets_post() {
    register_post_type('packet',
        [
            'labels' => array(
                'name'                  => 'Pakiety',
                'singular_name'         => 'Pakiet',
                'add_new'               => 'Dodaj Pakiet',
                'add_new_item'          => 'Dodaj nowy',
                'edit'                  => 'Edytuj',
                'edit_item'             => 'Edytuj',
                'new_item'              => 'Nowy',
                'view'                  => 'Widok',
                'view_item'             => 'Widok',
                'search_items'          => 'Wyszukiwanie',
                'not_found'             => 'Nie znaleziono',
                'not_found_in_trash'    => 'Nie znaleziono w koszu',
                'parent'                => 'Rodzic'
            ),
            'supports'              => array('title'),
            'menu_icon'             => 'dashicons-cart',
            'public'                => true,   // it's not public, it shouldn't have it's own permalink, and so on
            'exclude_from_search'   => true,    // you should exclude it from search results
            'show_in_nav_menus'     => false,   // you shouldn't be able to add it to menus
            'has_archive'           => false,   // it shouldn't have archive page
            'rewrite'               => false,   // it shouldn't have rewrite rules
            'publicly_queriable'    => true,    // you should be able to query it
            'show_ui'               => true,    // you should be able to edit it in wp-admin
            'query_var'             => true,
        ]
    );
    
    register_taxonomy('option', 'packet', [
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'public' => true,
        'supports' => array('title'),
        'labels' => [
            'name' => 'Opcji pakietów',
            'singular_name' => 'Opcja pakieta',
            'add_new' => 'Dodaj Opcje',
            'add_new_item' => 'Dodaj nowy',
        ]
    ]);
} 
add_action('init', 'create_packets_post');