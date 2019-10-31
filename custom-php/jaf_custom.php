<?php

require_once get_theme_file_path() . '/custom-php/shortcode_project_list.php';
require_once get_theme_file_path() . '/custom-php/shortcode_project_summary.php';
require_once get_theme_file_path() . '/custom-php/shortcode_service_related_project.php';
require_once get_theme_file_path() . '/custom-php/shortcode_post_list_ajax.php';

function jaf_scripts(){
	//wp_enqueue_style('select2-css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css');
	//wp_enqueue_script('select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js', ['jquery']);

	wp_enqueue_style('sumonselect-css', '//cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.0.2/sumoselect.min.css');
	wp_enqueue_script('sumonselect-js', '//cdnjs.cloudflare.com/ajax/libs/jquery.sumoselect/3.0.2/jquery.sumoselect.min.js', ['jquery']);
}
add_action('wp_enqueue_scripts', 'jaf_scripts');

if (!function_exists('register_project_sector_tax')) {

// Register Custom Taxonomy
    function register_project_sector_tax()
    {

        $labels = array(
            'name'                       => _x('Sectors', 'Taxonomy General Name', 'text_domain'),
            'singular_name'              => _x('Sector', 'Taxonomy Singular Name', 'text_domain'),
            'menu_name'                  => __('Sectors', 'text_domain'),
            'all_items'                  => __('All Sectors', 'text_domain'),
            'parent_item'                => __('Parent Sector', 'text_domain'),
            'parent_item_colon'          => __('Parent Item:', 'text_domain'),
            'new_item_name'              => __('New Item Name', 'text_domain'),
            'add_new_item'               => __('Add New Sector', 'text_domain'),
            'edit_item'                  => __('Edit Sector', 'text_domain'),
            'update_item'                => __('Update Sector', 'text_domain'),
            'view_item'                  => __('View Sector', 'text_domain'),
            'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
            'add_or_remove_items'        => __('Add or remove items', 'text_domain'),
            'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
            'popular_items'              => __('Popular Items', 'text_domain'),
            'search_items'               => __('Search Items', 'text_domain'),
            'not_found'                  => __('Not Found', 'text_domain'),
            'no_terms'                   => __('No items', 'text_domain'),
            'items_list'                 => __('Items list', 'text_domain'),
            'items_list_navigation'      => __('Items list navigation', 'text_domain'),
        );
        $rewrite = array(
            'slug'         => 'project-sectors',
            'with_front'   => true,
            'hierarchical' => false,
        );
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'rewrite'           => $rewrite,
        );
        register_taxonomy('project_sector', array('forbes_projects'), $args);

    }
    add_action('init', 'register_project_sector_tax', 0);

}

if (!function_exists('register_delivery_model_tax')) {

    // Register Custom Taxonomy
    function register_delivery_model_tax()
    {

        $labels = array(
            'name'                       => _x('Delivery Models', 'Taxonomy General Name', 'text_domain'),
            'singular_name'              => _x('Delivery Model', 'Taxonomy Singular Name', 'text_domain'),
            'menu_name'                  => __('Delivery Models', 'text_domain'),
            'all_items'                  => __('All Items', 'text_domain'),
            'parent_item'                => __('Parent Item', 'text_domain'),
            'parent_item_colon'          => __('Parent Item:', 'text_domain'),
            'new_item_name'              => __('New Item Delivery Model', 'text_domain'),
            'add_new_item'               => __('Add New Delivery Model', 'text_domain'),
            'edit_item'                  => __('Edit Delivery Model', 'text_domain'),
            'update_item'                => __('Update Delivery Model', 'text_domain'),
            'view_item'                  => __('View Delivery Model', 'text_domain'),
            'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
            'add_or_remove_items'        => __('Add or remove items', 'text_domain'),
            'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
            'popular_items'              => __('Popular Items', 'text_domain'),
            'search_items'               => __('Search Items', 'text_domain'),
            'not_found'                  => __('Not Found', 'text_domain'),
            'no_terms'                   => __('No items', 'text_domain'),
            'items_list'                 => __('Items list', 'text_domain'),
            'items_list_navigation'      => __('Items list navigation', 'text_domain'),
        );
        $rewrite = array(
            'slug'         => 'delivery-models',
            'with_front'   => true,
            'hierarchical' => false,
        );
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => true,
            'rewrite'           => $rewrite,
        );
        register_taxonomy('delivery_model', array('forbes_projects'), $args);

    }
    add_action('init', 'register_delivery_model_tax', 0);

}

if( !function_exists( 'register_branch_region' ) ) {

    //register custom taxonomy
    function register_branch_region() {
        $labels = array(
            'name'                      => _x( 'Regions', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'             => _x( 'Region', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                 => __( 'Region', 'text_domain' ),
            'all_items'                 => __( 'All Items', 'text_domain' ),
            'parent_item'               => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'         => __( 'Parent Item', 'text_domain' ),
            'new_item_name'             => __( 'New Item Region', 'text_domain' ),
            'add_new_item'              => __( 'Add New Region', 'text_domain' ),
            'edit_item'                 => __( 'Edit Region', 'text_domain' ),
            'update_item'               => __( 'Update Region', 'text_domain' ),
            'view_item'                 => __( 'View Region', 'text_domain' ),
            'separate_items_with_commas'=> __( 'Separate item with commas', 'text_domain' ),
            'add_or_remove_items'       => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'     => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'             => __( 'Popular Items', 'text_domain' ),
            'search_items'              => __( 'Search Items', 'text_domain' ),
            'not_found'                 => __( 'Not Found', 'text_domain' ),
            'no_terms'                  => __( 'No items', 'text_domain' ),
            'item_list'                 => __( 'Items list', 'text_domain' ),
            'item_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $rewrite = array(
            'slug'          =>  'region',
            'with_front'    =>  true,
            'hierarchical'  =>  false,
        );
        $args = array(
            'labels'                =>  $labels,
            'hierarchical'          =>  true,
            'public'                =>  true,
            'show_ui'               =>  true,
            'show_admin_column'     =>  true,
            'show_in_nav_menus'     =>  true,
            'show_tagcloud'         =>  true,
            'rewrite'               =>  $rewrite,
        );
        register_taxonomy( 'forbes_region', array( 'forbes_branches', 'forbes_careers' ), $args );
    }
    add_action( 'init', 'register_branch_region' );

}

if( !function_exists( 'register_career_category' ) ) {

    //register custom taxonomy
    function register_career_category() {
        $labels = array(
            'name'                      => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'             => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                 => __( 'Category', 'text_domain' ),
            'all_items'                 => __( 'All Items', 'text_domain' ),
            'parent_item'               => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'         => __( 'Parent Item', 'text_domain' ),
            'new_item_name'             => __( 'New Item Category', 'text_domain' ),
            'add_new_item'              => __( 'Add New Category', 'text_domain' ),
            'edit_item'                 => __( 'Edit Category', 'text_domain' ),
            'update_item'               => __( 'Update Category', 'text_domain' ),
            'view_item'                 => __( 'View Category', 'text_domain' ),
            'separate_items_with_commas'=> __( 'Separate item with commas', 'text_domain' ),
            'add_or_remove_items'       => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'     => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'             => __( 'Popular Items', 'text_domain' ),
            'search_items'              => __( 'Search Items', 'text_domain' ),
            'not_found'                 => __( 'Not Found', 'text_domain' ),
            'no_terms'                  => __( 'No items', 'text_domain' ),
            'item_list'                 => __( 'Items list', 'text_domain' ),
            'item_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $rewrite = array(
            'slug'          =>  'career-category',
            'with_front'    =>  true,
            'hierarchical'  =>  false,
        );
        $args = array(
            'labels'                =>  $labels,
            'hierarchical'          =>  true,
            'public'                =>  true,
            'show_ui'               =>  true,
            'show_admin_column'     =>  true,
            'show_in_nav_menus'     =>  true,
            'show_tagcloud'         =>  true,
            'rewrite'               =>  $rewrite,
        );
        register_taxonomy( 'forbes_career_category', array( 'forbes_careers' ), $args );
    }
    add_action( 'init', 'register_career_category' );

}