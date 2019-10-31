<?php
function render_shortcode_forbes_latestnews( $attribute )
{
    $DefaultImage  = get_template_directory_uri()."/custom-php/default-image.jpg";

    $args = array(
        "post_type"      => " forbes_news",
        "posts_per_page" => 3,
        "orderby"        => "post_date",
        "order"          => "ASC"
//        "order"          => "DESC"
    );

    $loop = new WP_Query( $args );
    $html = '';


    $html .= '<div class="main-wrapper">';

    if ($loop->have_posts()) {
        
    $html .= '<div class="forbes-latestnews">';
        
        while ( $loop->have_posts() ) { 

            $loop->the_post();
            $post_id          = get_the_id();
            $post_object      = get_post( $post_id );
            $post_object_link  = get_permalink ($post_id);
            $post_image       = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), "thumbnail");
            $post_title       = $post_object->post_title;
            $post_content     = $post_object->post_content;
            $post_content_trim = wp_trim_words( $post_content, 12 );
            $post_excerpt     = $post_object->post_excerpt;
            
//            LIMIT TEXT 
            $post_shortcontent = get_post_meta($post_id,'short_descriptions',true);
            $post_shortcontent_trim = wp_trim_words( $post_shortcontent, 12 );
            
//            META WITH LINK
            $postbutton = get_post_meta($post_id,'button_url',true);
            $linkurl = get_permalink ($postbutton);

            $html .= '    
                   
                        <div>
                        
                                <div class="footer-display-post latestnews-wrapper">
                                  
                                    <div class="content-holder">
                                        <h4>'. $post_title .'</h3> 
                                        <div title="'.$post_shortcontent.'"> '. $post_shortcontent_trim .' </div>
                                        <a href="'. $post_object_link.'" > <i class="fa fa-angle-double-right" aria-hidden="true"></i> Readmore </a>
                                    </div>
                                   
                                </div>
                                <div class="clearfix"></div>
                                
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

add_shortcode( "forbes_latestnews" ,"render_shortcode_forbes_latestnews");
?>