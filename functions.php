<?php
function infinity_child_enqueue_scripts() {
  wp_register_style( 'infinity-child-style', get_stylesheet_directory_uri() . '/style.css'  );
  wp_enqueue_style( 'infinity-child-style' );
  wp_enqueue_script( 'custom-scipts', get_stylesheet_directory_uri() . '/js/custom-scripts.js' );
}
add_action( 'wp_enqueue_scripts', 'infinity_child_enqueue_scripts', 11);

require_once get_theme_file_path() . '/custom-php/custom-functions.php';
require_once get_theme_file_path() . '/custom-php/jaf_custom.php';
require_once get_theme_file_path() . '/custom-php/rty_custom.php';


function boom_modify_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', false, '1.8.1');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'boom_modify_jquery');

function register_my_menus() {
register_nav_menus(
array(
'projects-menu' => __( 'Projects Menu' )
)
);
}
add_action( 'init', 'register_my_menus' );
