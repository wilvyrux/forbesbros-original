<?php
function render_shortcode_forbes_slide( $attribute )
{
    $DefaultImage  = get_template_directory_uri()."/custom-php/default-image.jpg";

    $args = array(
        "post_type"      => " forbes_services",
        "posts_per_page" => -1,
        "orderby"        => "menu_order",
        "order"          => "ASC"
//        "order"          => "DESC"
    );

    $loop = new WP_Query( $args );
    $html = '';


    $html .= '<div class="main-wrapper">';

    if ($loop->have_posts()) {
        
    $html .= '<div id="shortcode-slide" class="forbes-slide-services">';
        
        while ( $loop->have_posts() ) { 

            $loop->the_post();
            $post_id          = get_the_id();
            $post_object      = get_post( $post_id );
            $post_object_link  = get_permalink ($post_id);
            $post_image       = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), "medium");
            $post_title       = $post_object->post_title;
            $post_content     = $post_object->post_content;
            $post_content_trim = wp_trim_words( $post_content, 25 );
            // $post_excerpt     = $post_object->post_excerpt;
            
            $post_excerpt     = $post_object->post_excerpt;
            $post_excerpt_content_trim = wp_trim_words( $post_excerpt, 10 );
            
//            LIMIT TEXT 
            $post_shortcontent = get_post_meta($post_id,'short_descriptions',true);
            $post_shortcontent_trim = wp_trim_words( $post_shortcontent, 25 );
            
//            META WITH LINK
            $postbutton = get_post_meta($post_id,'button_url',true);
            $linkurl = get_permalink ($postbutton);

            $html .= '    
                   
                     
                                <div class="service-wrapper">
                                    <img src="'.( ( $post_image != NULL ) ? $post_image: $DefaultImage ).'" alt="'. $post_title .'" >
                                    
                                    <h2>'. $post_title .'</h2>  
                                    
                                    <div class="overlay-wrapper">
                                            <h3>'. $post_title .'</h3> 
                                            <div> '. $post_shortcontent_trim .' </div>
                                            <a href="'. $post_object_link.'" > View Services </a>
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
   
$script = '
        <script>
        jQuery(document).ready(function() {

            var owl = $("#shortcode-slide");
            owl.owlCarousel({
                    loop:true,
                    margin:10,
                    nav:true,
                    dots:false,
                    autoplayHoverPause:true,
                    autoplay:true,
                    autoplayTimeout:3000,
                    navText: ["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>", "<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"],
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        1000:{
                            items:2
                        },
                        1002:{
                            items:3
                        }
                    }
            });
            
         
        });
        </script>
        
';
    
return $html.$script;
      
}
add_shortcode( "forbes_services_slider" ,"render_shortcode_forbes_slide");
?>