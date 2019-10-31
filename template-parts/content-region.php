<?php
/**
 * Template part for displaying posts.
 *
 * @package Infinity
 */
$contact = get_post( 3422 );
$category = get_queried_object();
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
			'terms' => $category->term_id,
		)
	),
);
$qry = new WP_Query( $args );
?>

<div class="container">
	<div class="row padding-top-100 padding-bottom-70">

		<div class="col-sm-12 margin-bottom-30">
			<?php echo do_shortcode( $contact->post_content ); ?>
		</div>
		
		<div class="col-sm-12">
			<h2 class="region-title"><?php echo $category->name ?></h2>
			<div class="region-content">
				<?php if( $qry->have_posts() ) : ?>
					<?php while( $qry->have_posts() ) : ?>
						<?php $qry->the_post(); ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );?>
						<?php if( $image ) { $img = $image[0]; } else { $img = site_url("/wp-content/uploads/2016/06/about-object-1.png"); } ?>
						<div class="col-md-4 region-branches-wrapper">
							<article id="post-<?php get_the_ID(); ?>" <?php post_class(); ?>>
								<div class="entry-header">
									<img src="<?php echo $img ?>" class="branch-image">
								</div>
								<!-- .entry-header -->

								<div class="entry-content">
									<h4 class="entry-title"><?php echo get_the_title(); ?></h4>
									<p class="branch-content"><?php echo  strip_tags( wp_trim_words( do_shortcode( get_the_content() ), 30 ) ); ?></p>
								</div>
								<!-- .entry-content -->

								<footer class="entry-footer">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="branch-link">Read More</a>
								</footer>
								<!-- .entry-footer -->
							</article><!-- #post-## -->
						</div>
					<?php endwhile;?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>