<?php
$portfolio_website       = get_post_meta( get_the_ID(), "portfolio_website", true );
$portfolio_client        = get_post_meta( get_the_ID(), "portfolio_client", true );
$portfolio_gallery_image = get_post_meta( get_the_ID(), "portfolio_gallery_image", true );

$portfolio_visit_button_enable = Kirki::get_option( 'tm-dione', 'portfolio_visit_button_enable' );
$portfolio_client_enable = Kirki::get_option( 'tm-dione', 'portfolio_client_enable' );
$portfolio_share_enable = Kirki::get_option( 'tm-dione', 'portfolio_share_enable' );
?>

<div class="container">
	<div class="row padding-top-100 padding-bottom-70">
		<div class="col-sm-12 margin-bottom-30">
			<?php $contact = get_post( 3422 ); ?>
			<?php echo do_shortcode( $contact->post_content ); ?>
		</div>
	</div>
	<div class="branch-main-focus"></div>
	<div class="row padding-bottom-70">
		<div class="col-sm-12">
			<div class="entry-content">
				<h2 class="branch-title"><?php echo get_the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
			<div class="related-projects">
				<?php echo do_shortcode( '[branch-projects branch="'.get_the_ID().'"]' ); ?>
			</div>
		</div>
	</div>
</div>

<?php if(isset($portfolio_gallery_image) && !empty($portfolio_gallery_image)): ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 padding-x-0">
			<?php if(count($portfolio_gallery_image) > 0): ?>
				<div class="folio-gallery clearfix">
					<?php
						$key = key($portfolio_gallery_image);
						$image = $portfolio_gallery_image[$key];
						unset($portfolio_gallery_image[$key]);
					 ?>
					<a class="folio-item flui ndSvgFill" href="<?php echo esc_url($image) ?>">
						<img src="<?php echo esc_attr($image) ?>" alt="portfolio">
						<svg viewBox="0 0 30 30"  version="1.1"
							 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
							 xml:space="preserve"
							 x="0px" y="0px" width="30px" height="30px">
							<g>
								<rect x="13" y="0" width="4" height="30"/>
								<rect x="0" y="13" width="30" height="4"/>
							</g>
						</svg>
					</a>
				</div>
			<?php endif; ?>
			<div class="folio-gallery grid-masonry clearfix">
				<?php
				foreach ( $portfolio_gallery_image as $key => $image ):
				?>
						<a class="folio-item col-3 ndSvgFill grid-item" href="<?php echo esc_url($image) ?>">
							<img src="<?php echo esc_attr($image) ?>" alt="portfolio">
							<svg viewBox="0 0 30 30" version="1.1"
								 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								 xml:space="preserve"
								 x="0px" y="0px" width="30px" height="30px">
							<g>
								<rect x="13" y="0" width="4" height="30"/>
								<rect x="0" y="13" width="30" height="4"/>
							</g>
						</svg>
						</a>

						<?php
				endforeach;
				?>

			</div>

		</div>
	</div>
</div>
<?php endif; ?>
