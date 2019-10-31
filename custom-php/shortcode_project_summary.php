<?php
function render_project_summary($atts, $content = null)
{
    extract(shortcode_atts([
        'heading' => 'Project Summary',
    ], $atts));
    $output = '';

    //check if we are in single page
    if (!is_singular('forbes_projects')) {
        $output .= '<div class="alert alert-info" ><p>This shortcode is only use for Forbes Project page.</p></div>';
        return $output;
    }

    $pid = get_the_ID();

    //lets continue
    $cols = [];

    $metas = [
        'client'                => ['label' => 'Client'],
        'location'              => ['label' => 'Location'],
        'length'                => ['label' => 'Length'],
        'voltage'               => ['label' => 'Voltage'],
        'structure_type'        => ['label' => 'Structure Type'],
        'line_configuration'    => ['label' => 'Line Configuration'],
        'cable_configuration'   => ['label' => 'Cable Configuration'],
        'turbine_types'         => ['label' => 'Turbine Types'],
        'foundation_types'      => ['label' => 'Foundation Types'],
        'completion_period'     => ['label' => 'Completion Period'],
        'value_of_the_work'     => ['label' => 'Value of the Work'],
        'delivery_model'        => ['label' => 'Delivary Model', 'type' => 'tax'],
        'project_sector'        => ['label' => 'Project Sector', 'type' => 'tax'],
    ];


    $output .= '<div class="project-summary-container" >';
    foreach ($metas as $key => $value) {
        $type = isset($value['type']) ? $value['type'] : 'meta';

        $label = '';
        $text  = '';
        if ($type == 'meta') {
            $meta = get_field($key, $pid);

            if ($meta && $key == 'branch') {
                $label = $value['label'];
                $text  = $meta->post_title;
            } elseif ($meta) {
                $label = $value['label'];
                $text  = $meta;
            }

        } elseif ($type == 'tax') {

            $terms = wp_get_post_terms($pid, $key, ['fields' => 'names']);
            if (!is_wp_error($terms) && !empty($terms)) {
                $label = $value['label'];
                $text  = implode(', ', $terms);
            }
        }

        if ($text) {
            $cols[] = '<div class="inner-item" >
            <h4>' . $label . '</h4>
            <p>' . $text . '</p>
            </div>';
        }

    }

    if (empty($cols)) {
        return '';
    }

    $output .= '<div class="row" >';
    $featured_image = wp_get_attachment_image( get_post_thumbnail_id( $pid ), 'full' );
    $featured_url = wp_get_attachment_image_url( get_post_thumbnail_id( $pid ), 'full' );
    $output .= '<div class="col-md-4 summary-featured-image" style="'.($featured_url ? 'background-image: url('.$featured_url.');' : '').'"  ></div>';
    $output .= '<div class="col-md-4 visible-xs visible-sm summary-featured-image" >'.$featured_image.'</div>';

    $output .= '<div class="col-md-8" >';
    $output .= '<div class="summary-heading" ><h4>' . $heading . '</h4></div>';


    $output .= '<div class="row" >';
    $output .= '<div class="col-md-12 summary-desc" >'.$content.'</div>';
    foreach ($cols as $value) {
        $output .= '<div class="col-md-3" >
        ' . $value . '
        </div>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
}
add_shortcode('project_summary', 'render_project_summary');
