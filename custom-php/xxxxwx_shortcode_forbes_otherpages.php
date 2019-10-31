<?php
function render_shortcode_forbes_otherpages( $attribute )
{
    $DefaultImage  = get_template_directory_uri()."/custom-php/default-image.jpg";

    $args = array(
        "post_type"      => " other_pages",
        "posts_per_page" => 3,
        "orderby"        => "post_date",
        "order"          => "ASC"
//        "order"          => "DESC"
    );

    $loop = new WP_Query( $args );
    $html = '';


    $html .= '<div class="main-wrapper">';

    if ($loop->have_posts()) {
        
    $html .= '<div class="forbes-otherpages">';
        
        while ( $loop->have_posts() ) { 

            $loop->the_post();
            $post_id          = get_the_id();
            $post_object      = get_post( $post_id );
            $post_object_link  = get_permalink ($post_id);
            $post_image       = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), "medium");
            $post_title       = $post_object->post_title;
            $post_content     = $post_object->post_content;
            $post_content_trim = wp_trim_words( $post_content, 25 );
            $post_excerpt     = $post_object->post_excerpt;
            
//            LIMIT TEXT 
            $post_shortcontent = get_post_meta($post_id,'short_descriptions',true);
            $post_shortcontent = wp_trim_words( $post_shortcontent, 25 );
            
//            META WITH LINK
            $postbutton = get_post_meta($post_id,'button_url',true);
            $linkurl = get_permalink ($postbutton);

            $html .= '    
                   
                        <div class="col-md-4 col-sm-4">
                        
                                <div class="otherpages-wrapper">
                                
                                        <div class="featured-holder">
                                             <img src="'.( ( $post_image != NULL ) ? $post_image: $DefaultImage ).'" alt="'. $post_title .'" >
                                            <h4>'. $post_title .'</h3> 
                                        </div>
                                        <div class="overlay-wrapper">
                                              <div> '. $post_content_trim .' </div>
                                              <a href="'. $post_object_link.'" > View Projects </a>
                                        </div>
                                        
                                </div>
                                   
                        </div>

                    ';

        }
    
    $html .= '</div>';  
        
    } else {
        $html .=' <p> No Available Posts </p> ';
    }
    
    wp_reset_postdata();
    $html .= '</div>';
   
return $html.$script;
    
}

add_shortcode( "forbes_otherpages" ,"render_shortcode_forbes_otherpages");
?>