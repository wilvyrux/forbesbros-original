<?php

function get_mata( $post_id, $meta_key )
{
    echo get_post_meta( $post_id, $meta_key, true ); 
}

/*<----// WX Basic Needs //---->*/


//wx cleanup functions extras
require_once get_theme_file_path() . '/custom-php/wx_custom-cleanups.php';

//wx login and admins scripts
require_once get_theme_file_path() . '/custom-php/wx_custom-login_admin.php';

//wx style and jquery scripts
require_once get_theme_file_path() . '/custom-php/wx_custom-style_scripts.php';
/*<----//  //---->*/



/*<----// WX EXTRA Shortcode posts //---->*/
require_once get_theme_file_path() . '/custom-php/wx_custom-shortcodes.php';



require_once get_theme_file_path() . '/custom-php/wx_shortcode_forbes_services_slider.php';
require_once get_theme_file_path() . '/custom-php/wx_shortcode_forbes_projects.php'; 
require_once get_theme_file_path() . '/custom-php/wx_shortcode_forbes_latestnews.php'; 
require_once get_theme_file_path() . '/custom-php/wx_shortcode_forbes_community.php'; 
require_once get_theme_file_path() . '/custom-php/shortcode_forbes_services_display.php'; 



require_once get_theme_file_path() . '/custom-php/class/class.widget.php'; 

/*<----//  //---->*/

/* Custom Function */
function branch_sidebar_widget() {
	register_sidebar(
		array(
			'name'			=>	__( 'Branch Sidebar', 'tm-dione' ),
			'id'			=>	'branch-sidebar-widget',
			'before_widget'	=>	'<li id="%1$s" class="widget-container %2$s">',
			'after_widget'	=>	'</li>',
			'before_title'	=>	'<h3 class="widget-title">',
			'after_title'	=>	'</h3>'
		)
	);
	register_sidebar(
		array(
			'name' => 'Banner Image',
			'id' => 'banner-image',
			'description' => 'Widget for the image in every banner',
			'before_widget'		=> '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'		=> '</li>',
			'before_title'		=> '<h3 class="widget-title">',
			'after_title'		=> '</h3>'
		)
	);
	register_widget( 'forbes_branch_list_widget' );
	register_widget( 'forbes_banner_img' );
}
add_action( 'widgets_init', 'branch_sidebar_widget' );

?>