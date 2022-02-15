<?php
/**
 * The template for displaying 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Simple_Pleasures
 */

get_header();
?>

	<main id="primary" class="site-main">
	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-location', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
			<?php while(have_rows('address')): the_row();
				$image = get_sub_field('image');
				$picture = $image['sizes']['medium'];
				?>
				<div class="location-wrapper">
					<div class="location">
						<img src="<?php echo $picture;?>" class="location-img">
						<h1><?php the_sub_field('address_name');?></h1>
						<?php the_sub_field('address_detail');?></br>
						<p>Hours: <?php the_sub_field('hours');?></p>
						<?php the_sub_field('service');?></br>
						<button><a href="<?php the_sub_field('button');?>">Reserve Your Table</a></button>
					</div>
					
					<div class="acf-map"  data-zoom="16">
						<?php 
							$addresslocation = get_sub_field('map');
							if( $addresslocation ): ?>
							<div class="marker" data-lat="<?php echo esc_attr($addresslocation['lat']); ?>" data-lng="<?php echo esc_attr($addresslocation['lng']); ?>"><h3><?php the_sub_field('address_detail')?></h3>
					</div>
							<?php endif; ?>
					</div>
				</div>
				<?php endwhile;?>

	</main>

<?php
get_footer();