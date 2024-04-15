<?php
/**
 * Plugin Name:     eQual - Menu
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Plugin for handling menu item
 * Author:          AlexisVS
 * Author URI:      https://github.com/AlexisVS
 * Text Domain:     eq-menu
 * Domain Path:     /
 * Version:         0.1.0
 * Requires at least: 0.1.0
 * Requires: eq-run
 *
 * @package         Eq_Menu
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

add_action( 'init', function () {
    if ( is_admin() ) {
        // Enqueue styles and scripts
        add_action( 'admin_enqueue_scripts', 'eq_menu_enqueue_styles_and_scripts' );

        // Add admin menu
        add_action( 'admin_menu', function () {
            eq_add_menu( 'menu', 'eQual', 'eQual Menu', 'edit_posts', 'dashicons-menu' );
            eq_add_menu( 'menu1', 'eQual', 'Test', 'edit_posts', 'dashicons-menu' );
            eq_add_menu(
                [
                    [
                        "id"          => "settings.settings.settings_values",
                        "type"        => "entry",
                        "label"       => "Settings values",
                        "description" => "",
                        "context"     => [
                            "entity" => "core\setting\SettingValue",
                            "view"   => "list.default"
                        ]
                    ],
                    [
                        "id"          => "settings.settings.settings_choices",
                        "type"        => "entry",
                        "label"       => "Settings choices",
                        "description" => "",
                        "context"     => [
                            "entity" => "core\setting\SettingChoice",
                            "view"   => "list.default"
                        ]
                    ],
                    [
                        "id"          => "settings.settings.settings",
                        "type"        => "entry",
                        "label"       => "Available Settings",
                        "description" => "",
                        "context"     => [
                            "entity" => "core\setting\Setting",
                            "view"   => "list.default"
                        ]
                    ]
                ], 'eQual', 'Test2', 'edit_posts', 'dashicons-menu' );
        } );


    }
} );


/**
 * Enqueue styles and scripts.
 *
 * @return void
 */
function eq_menu_enqueue_styles_and_scripts() {
    wp_enqueue_style( 'eq_menu_fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'eq_menu_material.fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,400italic|Roboto+Mono:400,500|Material+Icons|Google+Material+Icons' );
    wp_enqueue_style( 'eq_menu_material', 'https://unpkg.com/material-components-web@12.0.0/dist/material-components-web.min.css' );
    wp_enqueue_style( 'eq_menu_jquery.ui', 'https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'eq_menu_jquery.daterange', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );
    wp_enqueue_script( 'eq_menu_eq_lib', plugin_dir_url( __FILE__ ) . '/admin/assets/js/equal.bundle.js' );
    wp_enqueue_script( 'eq_menu_eq_frame', plugin_dir_url( __FILE__ ) . '/admin/assets/js/menu.js' );
}


/**
 * Add admin menu.
 *
 * Todo: change $menu_id avec soit un array ( menu ) soit un path plugin_dir . './..' ...
 *
 * @return void
 */
function eq_add_menu( $menu_id, $page_title, $menu_title, $capability, $icon_url = '' ) {
    $load_page = function () {
        echo '<div id="sb-menu" style="height: 30px;"></div>';
        echo '<div id="sb-container" style="margin-top: 20px;"></div>';
    };

    $menu_slug = str_replace( [ ' ', '-' ], [ '' ], strtolower( $menu_title ) );

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $load_page, $icon_url );

    if ( gettype( $menu_id ) == 'string' ) {
        $data = file_get_contents( plugin_dir_path( __FILE__ ) . '/admin/assets/' . $menu_id . '.json' );
        $json = json_decode( $data, true );
        $menu = $json['menu'];
    } elseif ( gettype( $menu_id ) == 'array' ) {
        $menu = $menu_id;
    }

    foreach ( $menu as $item ) {
        if ( isset( $item['context'] ) ) {
            $item_slug = $menu_slug . '&context=' . urlencode( json_encode( $item['context'] ) );
            add_submenu_page( $menu_slug, $page_title, $item['label'], $capability, $item_slug, $load_page );
        }
    }
}

