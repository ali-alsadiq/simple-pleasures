<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Simple_Pleasures
 */

?>

	<!-- <footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'simple-pleasures' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'simple-pleasures' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'simple-pleasures' ), 'simple-pleasures', '<a href="https://simplepreasures.bcitwebdeveloper.ca">FWD27</a>' );
				?>
		</div>
		
	</footer> -->
</div><!-- #page -->
<footer class="site-footer">
		<div class="footer-menus">
			<nav id="footer-navigation"	class="footer-navigation">
			<?php wp_nav_menu( array('theme_location'=>'footer'))?>
			</nav>
			<nav id = "social-navigation" class = "social-navigation">
				<?php wp_nav_menu (array('theme_location' => 'social') ); ?>
			</nav>
		</div><!-- .footer-menus -->
		<div class="site-info">
			<?php the_privacy_policy_link(); ?><br>
			
			<?php esc_html_e( 'Created by ', 'simple-pleasures'); ?><a href="https://ilsadali.com/">Ali Alsadiq</a>, <a href="https://fengxu.ca/">Feng Xu</a>, <a href="https://sarahmanandhar.design/">Sarah Manandhar</a>
		</div><!-- .site-info -->
</footer>
<?php wp_footer(); ?>

</body>
</html>
