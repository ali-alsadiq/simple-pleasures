<?php

use MailPoetVendor\Symfony\Component\Validator\Constraints\Length;

get_header();
?>

	<main id="primary" class="site-main">

		<?php
			if ( function_exists( 'get_field' ) ) {
				$bannerImage = get_field('banner_image');
				if( !empty( $bannerImage ) ): ?>
					<div class="banner-image-cover"></div>
					<?php echo wp_get_attachment_image( $bannerImage, 'full', "", array( "class" => "banner-image" ) )?> 

				<?php endif; ?>
				
				<a class="reserve-table" href="<?php the_permalink(163); ?>"> Reserve Your Table</a>
				
				<?php
				$args = array(
					'page_id' => '12',
				);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
					global $product;
					$ID = $loop->post->ID ?>
					<a class="order-online" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
					Order Online
					</a>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>

				<?php
			}
				$aboutImage = get_field('about_us_image');
				$aboutText = get_field('about_us_text');
				if( !empty( $aboutImage ) && !empty( $aboutText ) ): ?>
					<section class="about-us-image-and-text">
						<h2 class="about-us-heading">About Us</h2>
					<?php echo wp_get_attachment_image( $aboutImage, 'full', "", array( "class" => "baout-us-image" ) )?>
						<p class="about-us-text"><?php echo $aboutText ?></p>
					</section>
				<?php endif; 
		?>	
			<section class="popular-dishes">
				<h2 class="popular-dishes-heading">Best Sellers</h2>
				<?php
				$featuredProducts = wc_get_featured_product_ids();
				if (count($featuredProducts) >= 3){

					foreach ($featuredProducts as $id ){ ?>
						<div class='image-container'>
							<a href="<?php the_permalink($id); ?>" id="-<?php $id ?>" title="<?php the_title($id); ?>">
								<?php echo get_the_post_thumbnail($id, 'large' ) ?>
							</a>
							<h3><?php echo get_the_title($id); ?></h3>
							<?php echo do_shortcode('[add_to_cart id='. $id .' class=" add-to-cart"  style=""]');?>
						</div><?php
					}
				}
			?></section>

			<section class="our-loactions">
				<h2 class="our-loactions-heading">Our Loactions</h2>

				<?php 
					$locations = get_field('locations_section');
					if( $locations ) {
							foreach( $locations as $location ) {

								$locationImage 		= $location['image'];
								$locationAddress 	= $location['address'];
								$locationHours 		= $location['hours'];
								echo '<div class="location-img-hours">';
									
									if( !empty( $locationImage ) ): ?>
										<?php echo wp_get_attachment_image( $locationImage, 'full', "", array( "class" => "location-mage" ) ) ?>
									<?php endif;?>
									
									<section class="location-card">

										<h3 class="location-address">
											<?php echo $locationAddress ?>
										</h3>

											<div class='hours-div'>
											<?php
											$i = 0;
											$get_the_day = array ('Monday', 'Tuesday', 'Wednesday','Thursday', 'Friday', 'Saturday', 'Sunday' );
											foreach ($locationHours as $day){
												?>	
												<?php date_default_timezone_set('America/Los_Angeles'); 
													$today =date('l');
													if ($today === $get_the_day[$i] ):?>
														<div class='todays-name'>Today's Hours</div>
														<span class ='openning-hours'><?php echo $day['opening'] ?> - </span>
														<span class= 'closing-hours'><?php echo $day['closing'] ?></span>
													<?php endif;?>	
												<?php 	$i++;
											}
										echo '</div>';
									echo '</section>';
								echo '</div>';
	
							}
					}
				?>
			</section>

			<section class="instagram-container">
				<h2 class="our-instagram-heading">Our Instagram</h2>
				<?php echo do_shortcode('[instagram-feed]'); ?>
			</section>
			
			<section class="footer-banner"><?php
				$footerImage = get_field('footer_banner');
				if( !empty( $footerImage) ): ?>
					<?php echo wp_get_attachment_image( $footerImage, 'full',"", array( "class" => "footer-image" )) ?>
				<?php endif; ?>
				<div class="footer-banner-cover">
					<!-- background transparent gradient -->
				</div>
				<?php
				if ( get_field( 'banner_cta' ) ) {
					$id = get_field( 'banner_cta' )
					?>
					<?php echo do_shortcode('[add_to_cart id='. $id.' class=" footer-cta"   style=""]'); ?>
					<h3 class='footer-image-title'><?php echo get_the_title($id); ?></h3>
					<?php 							
				}
				?>
				
			</section>
	</main><!-- #main -->

<?php
get_footer();
