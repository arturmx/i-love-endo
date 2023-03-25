<?php

// Classes autoload
require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );  // WP_List_Table class
require_once __DIR__ . '/Classes/Admin/AdminPages.php';                 // Admin pages
require_once __DIR__ . '/Classes/Admin/WpTableBuilder.php';             // Wp table builder


/**
 * ADMIN PANEL MENU & PAGES
 */
function admin_custom_menu_items()
{
    admin_menu_custom ();
}
add_action('admin_menu', 'admin_custom_menu_items', 1000);


/**
 * Custom admin menu
 *
 * @global array $menu
 */
function admin_menu_custom ()
{
    // REMOVE MENU ITEMS -------------------------------------------------------
    // remove_menu_page('index.php');                                              // Dashboard
    // remove_menu_page('jetpack');                                                // Jetpack
    // remove_menu_page('edit.php');                                               // Posts
    // remove_menu_page('upload.php');                                             // Media
    // remove_menu_page('edit.php?post_type=page');                                // Pages
    // remove_menu_page('plugins.php');                                            // Plugins
    // remove_menu_page('users.php');                                              // Users
    // remove_menu_page('options-general.php');                                    // Settings
    // remove_menu_page('themes.php');                                             // Appearance
    // remove_menu_page('tools.php');                                              // Tools
    // remove_menu_page('edit.php?post_type=acf-field-group');                     // ACF
    // remove_menu_page('edit-comments.php');                                      // Comments

    // REMOVE SUB MENU ITEMS ---------------------------------------------------
    // remove_submenu_page('themes.php',   'theme-editor.php');                    // Theme edit
    // remove_submenu_page('edit.php',     'edit-tags.php?taxonomy=category');     // Post categories
    // remove_submenu_page('edit.php',     'edit-tags.php?taxonomy=post_tag');     // Post tags

    // Form page add to menu
	/*
    add_menu_page (
		__('Dane z formularzy', 'AppCore'),     // page title
		__('Dane z formularzy', 'AppCore'),     // menu title
		'manage_options',                       // The capability required for this menu to be displayed to the user
		'forms-data',                           // menu slug
		'formsDataMain',                        // function name
		'dashicons-list-view',                  // icon || icon url
		100                                     // position
	);

    add_submenu_page(
		'forms-data',
		__('Formularz kontaktowy', 'AppCore'),
		__('Formularz kontaktowy', 'AppCore' ),
		'manage_options',
		'form-data-contacts',
		'formsDataContacts'
    );
	*/
}


/**
 * Forms data: main page action
 */
function formsDataMain ()
{
    $adminPages = new \Classes\Admin\AdminPages();
    $adminPages->formDataMain();
}
