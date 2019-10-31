<?php

class Project_list
{
    private $post_type     = 'forbes_projects';
    private $filter_tax_1  = 'project_sector';
    private $filter_tax_2  = 'delivery_model';
    private $filter_post_1 = 'forbes_branches';
    private $post_per_page = '3';

    public function __construct()
    {
        // wp_enqueue_style('select2-css');
        // wp_enqueue_script('select2-js');

        add_shortcode('forbes_projects', [$this, 'render_shortcode']);
        add_action('wp_ajax_load_more_project_list', [$this, 'ajax_load_more_project_list']);
        add_action('wp_ajax_nopriv_load_more_project_list', [$this, 'ajax_load_more_project_list']);
    }

    public function render_shortcode($atts, $content = null)
    {
        extract(shortcode_atts([
            'type' => 'list',
        ], $atts));

        $type = strtolower($type);

        $output = '<div class="project-list-container project-list-type-' . $type . '" >';

        if ($type == 'related') {
            $output .= $this->get_filters(['type' => 'related']);
        } else {
            $output .= $this->get_filters(['type' => 'related']);
        }

        $output .= '<div class="project-list-holder" >';

        if ($type == 'related') {
            $output .= '<h4>Related Projects</h4>';
        } else {
            $output .= '<h4>Results</h4>';
        }

        $output .= $this->get_results(['type' => 'related']);
        $output .= '</div>';
        $output .= $this->get_script();
        $output .= '</div>';

        return $output;
    }

    public function get_filters($args = [])
    {
        $type = isset($args['type']) ? $args['type'] : 'list';

        if ($type == 'related' && is_singular($this->post_type)) {
            $current_post_id = get_the_ID();

            $terms_1              = wp_get_post_terms($current_post_id, $this->filter_tax_1, ['fields' => 'ids']);
            $current_filter_tax_1 = !is_wp_error($terms_1) ? current($terms_1) : '';

            $terms_2              = wp_get_post_terms($current_post_id, $this->filter_tax_2, ['fields' => 'ids']);
            $current_filter_tax_2 = !is_wp_error($terms_2) ? current($terms_2) : '';

            $post_1                = get_field('branch', $current_post_id);
            $current_filter_post_1 = $post_1 ? $post_1->ID : '';
        } else {
            $current_filter_tax_1  = isset($_REQUEST['f_' . $this->filter_tax_1]) ? esc_html($_REQUEST['f_' . $this->filter_tax_1]) : '';
            $current_filter_tax_2  = isset($_REQUEST['f_' . $this->filter_tax_2]) ? esc_html($_REQUEST['f_' . $this->filter_tax_2]) : '';
            $current_filter_post_1 = isset($_REQUEST['f_' . $this->filter_post_1]) ? esc_html($_REQUEST['f_' . $this->filter_post_1]) : '';
        }

        $select_1 = '<select name="f_' . $this->filter_tax_1 . '" class="form-control" >';
        $select_1 .= '<option value="" >All Sectors</option>';
        $terms_1 = get_terms(['taxonomy' => $this->filter_tax_1]);
        // $current_filter_tax_1 = isset($_REQUEST['f_' . $this->filter_tax_1]) ? esc_html($_REQUEST['f_' . $this->filter_tax_1]) : '';
        if (!is_wp_error($terms_1) && !empty($terms_1)) {
            foreach ($terms_1 as $key => $value) {
                $select_1 .= '<option value="' . $value->term_id . '" ' . selected($current_filter_tax_1, $value->term_id, false) . ' >' . $value->name . '</option>';
            }
        }
        $select_1 .= '</select>';

        $select_2 = '<select name="f_' . $this->filter_tax_2 . '" class="form-control" >';
        $select_2 .= '<option value="" >All Delivery Models</option>';
        $terms_2 = get_terms(['taxonomy' => $this->filter_tax_2]);
        // $current_filter_tax_2 = isset($_REQUEST['f_' . $this->filter_tax_2]) ? esc_html($_REQUEST['f_' . $this->filter_tax_2]) : '';
        if (!is_wp_error($terms_2) && !empty($terms_2)) {
            foreach ($terms_2 as $key => $value) {
                $select_2 .= '<option value="' . $value->term_id . '" ' . selected($current_filter_tax_2, $value->term_id, false) . ' >' . $value->name . '</option>';
            }
        }
        $select_2 .= '</select>';

        $select_3 = '<select name="f_' . $this->filter_post_1 . '" class="form-control" >';
        $select_3 .= '<option value="" >All Branches</option>';
        $posts_1 = get_posts(['post_type' => $this->filter_post_1, 'posts_per_page' => -1, 'post_status' => 'publish']);
        // $current_filter_post_1 = isset($_REQUEST['f_' . $this->filter_post_1]) ? esc_html($_REQUEST['f_' . $this->filter_post_1]) : '';
        if (!empty($posts_1)) {
            foreach ($posts_1 as $key => $value) {
                $select_3 .= '<option value="' . $value->ID . '" ' . selected($current_filter_post_1, $value->ID, false) . ' >' . $value->post_title . '</option>';
            }
        }
        $select_3 .= '</select>';

        $is_related_to = '';
        if ($type == 'related') {
            $is_related_to .= '<input type="hidden" name="related_to" value="' . get_the_ID() . '" >';
        }

        $html = '<div class="project-list-filter ' . ($type == 'related' && is_singular($this->post_type) ? 'hide' : '') . '" >
        <h4>Filter Results</h4>
        <form class="form-filter" method="GET" data-ajax_url="' . admin_url('admin-ajax.php') . '"  >
        <input type="hidden" name="current_page" value="1" >
        <input type="hidden" name="f" value="' . (isset($_REQUEST['f_' . $this->filter_tax_1]) ? 1 : 0) . '" >
        <div class="form-group row">
        <div class="col-md-4">
        ' . $select_1 . '
        </div>
        <div class="col-md-4">
        ' . $select_2 . '
        </div>
        <div class="col-md-4">
        ' . $select_3 . '
        </div>
        </div>
        <button type="submit" class="btn btn-primary hide" >Filter</button>
        <form >
        </div>';
        return $html;
    }

    public function get_results($args = [])
    {
        $type = isset($args['type']) ? $args['type'] : 'list';

        $current_page = isset($_REQUEST['current_page']) ? esc_html($_REQUEST['current_page']) : 1;

        if ($type == 'related' && is_singular($this->post_type)) {
            $current_post_id = get_the_ID();

            $terms_1              = wp_get_post_terms($current_post_id, $this->filter_tax_1, ['fields' => 'ids']);
            $current_filter_tax_1 = !is_wp_error($terms_1) ? $terms_1 : '';

            $terms_2              = wp_get_post_terms($current_post_id, $this->filter_tax_2, ['fields' => 'ids']);
            $current_filter_tax_2 = !is_wp_error($terms_2) ? $terms_2 : '';

            $post_1                = get_field('branch', $current_post_id);
            $current_filter_post_1 = $post_1 ? $post_1->ID : '';
        } else {
            $current_filter_tax_1  = isset($_REQUEST['f_' . $this->filter_tax_1]) ? esc_html($_REQUEST['f_' . $this->filter_tax_1]) : '';
            $current_filter_tax_2  = isset($_REQUEST['f_' . $this->filter_tax_2]) ? esc_html($_REQUEST['f_' . $this->filter_tax_2]) : '';
            $current_filter_post_1 = isset($_REQUEST['f_' . $this->filter_post_1]) ? esc_html($_REQUEST['f_' . $this->filter_post_1]) : '';
        }

        $args = [
            'post_type'      => $this->post_type,
            'paged'          => $current_page,
            'posts_per_page' => $this->post_per_page,
        ];

        if ($type == 'related' && is_singular($this->post_type)) {
            $args['post__not_in'] = [get_the_ID()];
        }

        $tax_args = [];
        if ($current_filter_tax_1) {
            $tax_args[] = [
                'taxonomy' => $this->filter_tax_1,
                'terms'    => $current_filter_tax_1,
            ];
        }
        if ($current_filter_tax_2) {
            $tax_args[] = [
                'taxonomy' => $this->filter_tax_2,
                'terms'    => $current_filter_tax_2,
            ];
        }

        $meta_args = [];
        if ($current_filter_post_1) {
            $meta_args[] = [
                'key'   => 'branch',
                'value' => $current_filter_post_1,
            ];
        }

        $args['tax_query']  = $tax_args;
        $args['meta_query'] = $meta_args;

        $projects = new WP_Query($args);

        $html = '';
        if ($projects->have_posts()) {
            while ($projects->have_posts()) {
                $projects->the_post();
                $p_id = get_the_ID();

                $branch = get_the_title(get_field('branch'));

                $thumb = get_the_post_thumbnail($p_id, 'full');
                $link  = get_the_permalink($p_id);

                $html .= '<div class="project-list-item row fadeInRight animated" data-id="' . $p_id . '" >';

                $html .= '<div class="col-md-4" >' . $thumb . '</div>';
                $html .= '<div class="col-md-8" >
                <h4>' . get_the_title() . '</h4>
                <h5>' . $branch . '</h5>
                <p>' . get_the_excerpt() . '</p>
                <a href="' . $link . '" >More about this project</a>
                </div>';
                $html .= '</div>';
            }

            if ($projects->max_num_pages > $current_page) {
                $html .= '<div class="text-center load-more-projects" ><a href="#" data-current_page="' . $current_page . '" data-next_page="' . ($current_page + 1) . '" class="btn btn-default"><i class="fa fa-refresh fa-spin hide" aria-hidden="true"></i> Load More</a></div>';
            }
        } else {
            $html .= '<div class="alert alert-info" >
            <p>Sorry, no results found based on your criteria.</p>
            </div>';

            if ($type == 'related' && is_singular($this->post_type)) {
                $html .= '<script type="text/javascript">jQuery(".project-list-container.project-list-type-related").hide();</script>';
            }
        }
        wp_reset_postdata();

        return $html;
    }

    public function ajax_load_more_project_list()
    {
        echo $this->get_results();
        exit;
    }

    public function get_script()
    {
        $script = '<script type="text/javascript">
        jQuery(function($){
          $(".project-list-container").each(function(){
             var _cont = $(this);
             if( _cont.find("input[name=\'f\']").val() == "1" ){
                $("html,body").animate({scrollTop: _cont.offset().top - ($(".header").outerHeight() * 2) }, 250, function() {} );
            }

    			//_cont.find("select").select2();
            _cont.find("select").SumoSelect();

            _cont.find(".form-filter").on("change", function(){
                $(this).submit();
                });

                _cont.on("click", ".load-more-projects > a", function(e){
                    e.preventDefault();
                    var load_more_btn = $(this);

                    _cont.addClass("loading-more-projects");
                    load_more_btn.find(".fa").removeClass("hide");

                    data = _cont.find(".form-filter").serializeArray();
                    data = _cont.find(".form-filter").serializeArray();
					//modify page
                    for(i in data){
                      if(data[i].name == "current_page" ){
                         data[i].value = load_more_btn.attr("data-next_page");
                     }
                 }
                 data.push({ "name": "action", "value": "load_more_project_list" });

                 $.post(
                 _cont.find(".form-filter").attr("data-ajax_url"),
                 data,
                 function(res){
                     _cont.find(".project-list-holder").append(res);
                     load_more_btn.remove();
                     _cont.removeClass("loading-more-projects");
                 }
                 );


                 });
                 });
                 });
                 </script>';

        return $script;
    }

}

new Project_List;
