<?php

class forbes_branch_list_widget extends WP_Widget {
	/**
	* Create a widget for branches
	**/

	public function __construct() {
		$widget_options = array(
			'classname' => 'forbes_branch_widget',
			'description' => 'This is a list of all Forbes branches'
		);
		parent::__construct( 'forbes_branch_widget', 'Forbes Branch List', $widget_options );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$blog_title = get_bloginfo( 'name' );
		$tagline = get_bloginfo( 'description' );

		echo do_shortcode( '[branches_list title="'.$blog_title.'"]' );
	}

	public function form( $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : '';
		echo '<p>';
			echo '<label for="'.$this->get_field_id( 'title' ).'">Title:</label>';
			echo '<input type="text" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_id( 'title' ).'" value="'.esc_attr( $title ).'">';
		echo '</p>';
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
}



/*
* Enqueue script for the admin
*/
function forbes_admin_scripts() {
	wp_enqueue_script( 'admin-scripts', get_stylesheet_directory_uri() . '/js/admin-scripts.js' );
}
add_action( 'admin_enqueue_scripts', 'forbes_admin_scripts' );

//adding the widget
class forbes_banner_img extends WP_Widget {
	/*
	* Create the widget for the media upload
	*/
	public function __construct() {
		$widget_options = array(
			'classname' => 'forbes_banner_img_widget',
			'description' => 'This is a image uploader for the banner image'
		);
		parent::__construct( 'forbes_banner_img_widget', 'Forbes Banner Image', $widget_options );
	}

	public function widget( $args, $instance ) {
		extract( $args );

		echo '<div class="epc hidden-xs">';
			echo '<img src="'.esc_url( $instance['image_uri'] ).'" />';
		echo '</div>';
	}

	public function form( $instance ) {
		$image = !empty( $instance['image_uri'] ) ? $instance['image_uri'] : '';
		echo '<p>';
			echo '<label for="'.$this->get_field_id( 'image_uri' ).'">Image</label><br />';
			//if( $image != '' ) {
				echo '<img class="custom_media_image" src="'.$image.'" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
			//}
			echo '<input type="text" class="widefat custom_media_url" name="'.$this->get_field_name( 'image_uri' ).'" id="'.$this->get_field_id( 'image_uri' ).'" value="'.$image.'" style="margin-top:5px">';
			echo '<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="'.$this->get_field_name( 'image_uri' ).'" value="Upload Image" style="margin-top:5px;">';
		echo '</p>';
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		return $instance;
	}
}