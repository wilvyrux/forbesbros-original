<?php

function render_service_related_projects($atts, $content = '')
{
    extract(shortcode_atts(array(
        'branch' => 0,
        'count'  => 2,
        'title'  => null,
        'desc_limit'  => 25,
        'image_size'  => 'medium',
    ), $atts));

    //No for other post type!
    if (!is_singular('forbes_services')) {
        return;
    }

    $current_post_id = get_the_ID();
    $args = array(
        'post_type'      => 'forbes_projects',
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        'meta_query'     => array(
            array(
                'key'     => 'related_to_service',
                'value'   => sprintf(':"%s";', $current_post_id),
                'compare' => 'LIKE',
            ),
        ),
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {

    	if(!$title){
    		$title = get_the_title($branch) . ' Projects';
    	}

        $output = '<div class="service-projects-wrapper branches-projects-wrapper">';
        $output .= '<div class="title-holder">';
        $output .= '<h4>'.$title.'</h4>';
        $output .= '</div>';

        while ($query->have_posts()) {
            $query->the_post();

           /* $services = get_post_meta(get_the_ID(), 'related_to_service', true);
            if(	! ($services && is_array($services) && in_array( $current_post_id, $services )) ) contiue;*/

            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);


            $output .= '<div class="branch-projects col-md-6">';
            $output .= '<div class="col-sm-6">';
            $output .= '<div class="img-holder">';
            $output .= '<img data-toggle="tooltip" src="' . $img[0] . '" width="' . $img[1] . '" height="' . $img[2] . '" title="' . get_the_title() . '" alt="' . get_the_title() . '" >';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="col-sm-6">';
            $output .= '<div class="content-holder">';
            $output .= '<h4 class="project-title">' . get_the_title() . '</h4>';
            $output .= '<p data-toggle="tooltip" class="project-content" title="' . get_the_excerpt() . '" >' . strip_tags(wp_trim_words(get_the_excerpt(), $desc_limit)) . '</p>';
            $output .= '<a href="' . get_the_permalink() . '" class="project-link">Read More</a>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>'; 
        }
        wp_reset_postdata();

        $output .= '</div>';
    }

    return $output;
}
add_shortcode('service-projects', 'render_service_related_projects');
