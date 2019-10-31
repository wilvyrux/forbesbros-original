<?php
/****
**
**This is a custom function
**
*****/

// branches shortcode
function render_branches_list( $atts ) {
  extract( shortcode_atts( array( 'title' => '' ), $atts ) );
  $output = '<div class="branches-list-wrapper">';

  $terms = get_terms( array( 'taxonomy' => 'forbes_region', 'hide_empty' => true ) );
  if( $terms && !empty( $terms ) ) {
    sort( $terms );
    $output .= '<h4 class="branch-list-title">'.$title.'</h4>';
    $output .= '<ul class="branches-region">';
    foreach( $terms as $term ) {
      $term_link = get_term_link( $term );
      $output .= '<li>';
        $output .= '<a href="'.esc_url( $term_link ).'" class="region-link">'.$term->name.'</a>';
        $args = array( 
          'post_type' => 'forbes_branches', 
          'post_status' => 'publish', 
          'posts_per_page' => -1, 
          'orderby' => 'name', 
          'order' => 'ASC',
          'tax_query' => array(
            array(
              'taxonomy' => 'forbes_region',
              'field' => 'term_id',
              'terms' => $term->term_id,
            )
          )
        );
        $query = new WP_Query( $args );
        if( $query->have_posts() ) {
          $output .= '<ul class="branches-list">';
          while( $query->have_posts() ) {
              $query->the_post();
              $output .= '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
          }
          $output .= '</ul>';
          wp_reset_postdata();
        }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }

  $output .= '</div>';
  return $output;
}
add_shortcode( 'branches_list', 'render_branches_list' );

function render_branches_projects( $atts ) {
  extract( shortcode_atts(  array( 'branch' => 0 ), $atts ) );
  $output = '<div class="branches-projects-wrapper">';
    $output .= '<div class="title-holder">';
      $output .= '<h4>'.get_the_title( $branch ).' Projects</h4>';
    $output .= '</div>';

    $args = array( 
      'post_type' => 'forbes_projects', 
      'post_status' => 'publish', 
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key' => 'branch',
          'value' => $branch,
          'compare' => '='
        )
      )
    );
    $query = new WP_Query( $args );
    if( $query->have_posts() ) {
      while( $query->have_posts() ) {
        $query->the_post();
        $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        $output .= '<div class="branch-projects col-sm-6">';
          $output .= '<div class="col-sm-6">';
            $output .= '<div class="img-holder">';
              $output .= '<img src="'.$img[0].'">';
            $output .= '</div>';
          $output .= '</div>';
          $output .= '<div class="col-sm-6">';
            $output .= '<div class="content-holder">';
              $output .= '<h4 class="project-title">'.get_the_title().'</h4>';
              $output .= '<p class="project-content">'.strip_tags( wp_trim_words( do_shortcode( get_the_content() ), 25 ) ).'</p>';
              $output .= '<a href="'.get_the_permalink().'" class="project-link">Read More</a>';
            $output .= '</div>';
          $output .= '</div>';
        $output .= '</div>';
      }
      wp_reset_postdata();
    }

  $output .= '</div>';
  return $output;
}
add_shortcode( 'branch-projects', 'render_branches_projects' );

/*function render_career_lists() {
  $output .= '<div class="career-lists-wrapper">';
  $args = array( 'post_type' => 'forbes_careers', 'post_status' => 'publish', 'posts_per_page' => -1 );
  $query = new WP_Query( $args );
  if( $query->have_posts() ) {
    $output .= '<div id="career-accordion" class="panel-group">';
    while( $query->have_posts() ) {
      $query->the_post();
      $output .= '<div class="panel panel-default">';
        $output .= '<div class="panel-heading">';
          $output .= '<h4 class="panel-title">';
            $output .= '<a href="#panel-career-'.get_the_ID().'" data-toggle="collapse" data-parent="#career-accordion" aria-expanded="false" class="collapsed">';
              $output .= get_the_title().' <span class="icon"><i class="fa fa-angle-right"></i></span>';
            $output .= '</a>';
          $output .= '</h4>';
        $output .= '</div>';
        $output .= '<div id="panel-career-'.get_the_ID().'" class="panel-collapse collapse" aria-expanded="false">';
          $output .= '<div class="panel-body">';
            $output .= do_shortcode( get_the_content() );
            $output .= do_shortcode( '[gravityform id="2" title="false" description="false" ajax="true"]' );
          $output .= '</div>';
        $output .= '</div>';
      $output .= '</div>';
    }
    wp_reset_postdata();
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode( 'career-lists', 'render_career_lists' );*/

function render_career_lists() {
  $output .= '<div class="career-lists-wrapper">';
  $terms = get_terms( array( 'taxonomy' => 'forbes_region', 'hide_empty' => true ) );
  if( $terms ) {
    $output .= '<div id="career-accordion" class="panel-group">';
    foreach( $terms as $term ) {
      $output .= '<div class="panel panel-default">';
        $output .= '<div class="panel-heading">';
          $output .= '<h4 class="panel-title">';
            $output .= '<a href="#panel-career-'.$term->slug.'" data-toggle="collapse" data-parent="#career-accordion" aria-expanded="false" class="collapsed">';
              $output .= $term->name.' <span class="icon"><i class="fa fa-angle-right"></i></span>';
            $output .= '</a>';
          $output .= '</h4>';
        $output .= '</div>';
        $output .= '<div id="panel-career-'.$term->slug.'" class="panel-collapse collapse" aria-expanded="false">';
          $output .= '<div class="panel-body">';

            $args = array( 
              'post_type' => 'forbes_careers', 
              'post_status' => 'publish', 
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => 'forbes_region',
                  'field' => 'term_id',
                  'terms' => $term->term_id,
                )
              )
            );
            $query = new WP_Query( $args );
            if( $query->have_posts() ) {
              $output .= '<div class="career-lists">';
                $output .= '<table class="table table-stripped">';
                  $output .= '<thead>';
                    $output .= '<tr>';
                      $output .= '<th>Category</th>';
                      $output .= '<th>Position</th>';
                      $output .= '<th>Location</th>';
                      $output .= '<th>Date Posted</th>';
                    $output .= '</tr>';
                  $output .= '</thead>';
                  $output .= '<tbody>';
                    while( $query->have_posts() ) {
                      $query->the_post();
                      $categories = get_the_terms( $query->id, 'forbes_career_category' );
                      foreach( $categories as $cat ) {
                        $category = $cat->name;
                      }
                      $output .= '<tr>';
                        $output .= '<td class="category-column">';
                          $output .= '<p>'.$category.'</p>';
                        $output .= '</td>';
                        $output .= '<td class="position-column">';
                          $output .= '<a href="'.esc_url( get_the_permalink() ).'">'.get_the_title().'</a>';
                        $output .= '</td>';
                        $output .= '<td class="location-column">';
                          $output .= '<p>'.get_post_meta( get_the_ID(), 'location', true ).'</p>';
                        $output .= '</td>';
                        $output .= '<td class="date-column">';
                          $output .= '<p>'.get_the_date( 'M j, Y' ).'</p>';
                        $output .= '</td>';
                      $output .= '</tr>';
                    }
                    wp_reset_postdata(); 
                  $output .= '</tbody>';
                $output .= '</table>';
              $output .= '</div>';
            } else {
              $output .= '<div class="no-job-opening">';
                $output .= '<span>No current job opening.</span>';
              $output .= '</div>';
            }

          $output .= '</div>';
        $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }

  
  $output .= '</div>';
  return $output;
}
add_shortcode( 'career-lists', 'render_career_lists' );

function render_contact_info( $atts ) {
  extract( shortcode_atts( 
    array(
      'telephone' => '',
      'fax' => '',
      'email' => '',
      'email2' => '',
      'address' => ''
    ), $atts 
  ));
  $output .= '<div class="contact-info-wrapper">';
    $output .= '<table>';
      if( !empty( $address ) ) {
        $output .= '<tr>';
          $output .= '<th>Address:</th>';
          $output .= '<td>'.$address.'</td>';
        $output .= '</tr>';
      }
      if( !empty( $telephone ) ) {
        $output .= '<tr>';
          $output .= '<th>Telephone:</th>';
          $output .= '<td>'.$telephone.'</td>';
        $output .= '</tr>';
      }
      if( !empty( $fax ) ) {
        $output .= '<tr>';
          $output .= '<th>Fax Number:</th>';
          $output .= '<td>'.$fax.'</td>';
        $output .= '</tr>';
      }
      if( !empty( $email ) ) {
        $output .= '<tr>';
          $output .= '<th>Email Address:</th>';
          $output .= '<td>'.$email.'</td>';
        $output .= '</tr>';
      }
      if( !empty( $email2 ) ) {
        $output .= '<tr>';
          $output .= '<th>Email Address:</th>';
          $output .= '<td>'.$email.'</td>';
        $output .= '</tr>';
      }
    $output .= '</table>';
  $output .= '</div>';
  return $output;
}
add_shortcode( 'contact-info', 'render_contact_info' );

function render_region_branch() {
  $output = '<div class="region-branch-lists-wrapper">';
  $terms = get_terms( array( 'taxonomy' => 'forbes_region', 'hide_empty' => false ) );
  if( $terms ) {
    $output .= '<div id="branch-accordion" class="panel-group">';
    foreach( $terms as $term ) {
      $output .= '<div class="panel panel-default">';
        $output .= '<div class="panel-heading">';
          $output .= '<h4 class="panel-title">';
            $output .= '<a href="#panel-branch-'.$term->slug.'" data-toggle="collapse" data-parent="branch-accordion" aria-expanded="false" class="collapsed">'.$term->name.' <span class="icon"><i class="fa fa-angle-right"></i></span></a>';
          $output .= '</h4>';
        $output .= '</div>';
        $output .= '<div id="panel-branch-'.$term->slug.'" class="panel-collapse collapse" aria-expanded="false">';
          $output .= '<div class="panel-body">';

          $args = array(
            'post_type' => 'forbes_branches',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                'taxonomy' => 'forbes_region',
                'field' => 'term_id',
                'terms' => $term->term_id,
              )
            )
          );
          $query = new WP_Query( $args );
          if( $query->have_posts() ) {
            while( $query->have_posts() ) {
              $query->the_post();
              $address = get_post_meta( get_the_ID(), 'address', true );
              $email = get_post_meta( get_the_ID(), 'email', true );
              $telephone = get_post_meta( get_the_ID(), 'telephone', true );
              $fax_number = get_post_meta( get_the_ID(), 'fax_number', true );
              $output .= '<div class="branch-info-wrapper col-md-6">';
                $output .= '<div class="heading-holder">';
                  $output .= '<h2 class="primary-heading">'.get_the_title().'</h2>';
                $output .= '</div>';
                $output .= '<div class="contact-info-wrapper">';
                  $output .= '<table>';
                    if( !empty( $address ) ) {
                      $output .= '<tr>';
                        $output .= '<th>Address:</th>';
                        $output .= '<td>'.$address.'</td>';
                      $output .= '</tr>';
                    }
                    if( !empty( $email ) ) {
                      $output .= '<tr>';
                        $output .= '<th>Email:</th>';
                        $output .= '<td>'.$email.'</td>';
                      $output .= '</tr>';
                    }
                    if( !empty( $telephone ) ) {
                      $output .= '<tr>';
                        $output .= '<th>Telephone:</th>';
                        $output .= '<td>'.$telephone.'</td>';
                      $output .= '</tr>';
                    }
                    if( !empty( $fax_number ) ) {
                      $output .= '<tr>';
                        $output .= '<th>Fax Number:</th>';
                        $output .= '<td>'.$fax_number.'</td>';
                      $output .= '</tr>';
                    }
                  $output .= '</table>';
                $output .= '</div>';
              $output .= '</div>';
            }
            wp_reset_postdata();
          } else {
            $output .= '<div class="no-branch-found">';
              $output .= '<span>No branch found!</span>';
            $output .= '</div>';
          }

          $output .= '</div>';
        $output .= '</div>';
      $output .= '</div>';
    }
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode( 'branch-lists', 'render_region_branch' );