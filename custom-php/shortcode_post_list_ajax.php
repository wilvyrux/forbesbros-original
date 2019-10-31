<?php

class Post_List_Ajax
{
    private $post_type = 'community_first';

    public function __construct()
    {
        add_shortcode('post-list', [$this, 'render']);
        add_action('wp_ajax_post_list_load_more', [$this, 'ajax_post_list_load_more']);
        add_action('wp_ajax_nopriv_post_list_load_more', [$this, 'ajax_post_list_load_more']);
    }

    public function render($atts, $content = null)
    {

        $atts = shortcode_atts([
            'type'      => $this->post_type,
            'count'     => 3,
            'page'      => 1,
            'link_text' => 'Read More',
        ], $atts);

        extract($atts);

        $wrapper = '';
        $wrapper .= '<div class="post-list-ajax-container" >';

        $wrapper .= '<div class="post-list-holder row" >';
        $wrapper .= $this->get_posts($atts);
        $wrapper .= '</div>';

        $wrapper .= '</div>';
        $wrapper .= $this->get_scripts();

        $wrapper .= '</div>';

        return $wrapper;
    }

    public function get_posts($atts)
    {

        $args = [
            'post_type'      => isset($_REQUEST['type']) ? $_REQUEST['type'] : $atts['type'],
            'post_status'    => 'publish',
            'posts_per_page' => isset($_REQUEST['count']) ? $_REQUEST['count'] : $atts['count'],
            'paged'          => isset($_REQUEST['next_page']) ? $_REQUEST['next_page'] : $atts['page'],
        ];

        $link_text = isset($_REQUEST['link_text']) ? $_REQUEST['link_text'] : $atts['link_text']; 

        $posts = new WP_Query($args);

        $html = '';
        if ($posts->have_posts()) {

            while ($posts->have_posts()) {
                $posts->the_post();
                $pid     = get_the_ID();
                $image   = get_the_post_thumbnail();
                $excerpt = get_field('short_descriptions');
                $link    = get_the_permalink();

                $html .= '<div class="post-item col-md-12 col-sm-6 fadeInRight animated "  >';
                $html .= '<div class="col-md-4 item-thumb" >' . $image . '</div>';
                $html .= '<div class="col-md-8 item-thumb" >
	            	<h4>' . get_the_title() . '</h4>
	            	<p>' . $excerpt . '</p>
	            	<a href="' . $link . '" >' . $link_text . '</a>
	            </div>';
                $html .= '</div>';

            }
                $html .= '<div class="clearfix" ></div>';

            if ($posts->max_num_pages > $args['paged']) {
                $html .= '<div class="col-xs-12 ajax-load-more text-center"><a href="#" data-current_page="' . $args['paged'] . '" data-type="'.$atts['type'].'" data-count="'.$atts['count'].'" data-link_text="'.$atts['link_text'].'" data-next_page="' . ++$args['paged'] . '" data-ajax_url="'.admin_url('admin-ajax.php').'" class="btn btn-default" ><i class="fa fa-refresh fa-spin hide" aria-hidden="true"></i> Load More</a></div>';
            }

        }else{
        	$html .= '<div class="alert alert-info no-posts"><p>Sorry, no content available yet.</p></div> ';
        }

        wp_reset_postdata();

        return $html;
    }

    function ajax_post_list_load_more(){
    	echo $this->get_posts();
    	exit;
    }

    function get_scripts(){
    	$script = '<script type="text/javascript">
    		jQuery(function($){
    			$(".post-list-ajax-container").each(function(){
    				var _cont = $(this);

    				_cont.on("click", ".ajax-load-more > a", function(e){
    					e.preventDefault();
    					var _a = $(this);

    					_a.find(".fa").removeClass("hide");
    					_cont.addClass("loading-posts");

    					$.post(_a.data("ajax_url"), {action: "post_list_load_more", next_page: _a.attr("data-next_page"), count: _a.attr("data-count"), type: _a.attr("data-type"), link_text: _a.attr("data-link_text")}, function(res){
    						_cont.find(".post-list-holder").append(res);
    						_a.parent().fadeOut().remove();
    						_cont.removeClass("loading-posts");
    					});
    				});
    			});
    		});
    	</script>';

    	return $script;
    }

}

new Post_List_Ajax;

?>
