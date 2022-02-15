<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Simple_Pleasures
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'simple-pleasures' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
				?>
				<h1 max-height='30px' class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<svg id="Layer_1" data-name="Layer 1" height='18px' width='25px' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<defs>
								<clipPath id="clip-path" transform="translate(-123.58 -216.21)">
									<rect class="cls-1" x="131.79" y="221.09" width="4.48" height="20.74" transform="translate(-97.75 364.94) rotate(-89.86)"/>
								</clipPath>
								<clipPath id="clip-path-2" transform="translate(-123.58 -216.21)">
									<rect class="cls-1" x="131.73" y="208.06" width="4.48" height="20.74" transform="translate(-84.78 351.88) rotate(-89.86)"/>
								</clipPath>
							</defs>
							<g class="cls-2">
								<path class="cls-3" d="M134,233.68c5.72,0,10.37-2,10.38-4.41H140c0,1.41-2.7,2.56-6,2.55s-6-1.16-6-2.58h-4.36C123.66,231.66,128.31,233.67,134,233.68Z" transform="translate(-123.58 -216.21)"/>
							</g>
							<g class="cls-4">
								<path class="cls-3" d="M134,216.21c-5.71,0-10.37,2-10.37,4.41l4.36,0c0-1.42,2.7-2.57,6-2.56s6,1.17,6,2.59h4.36C144.35,218.23,139.71,216.23,134,216.21Z" transform="translate(-123.58 -216.21)"/>
							</g>
							<path class="cls-5" d="M127,224.93c-.23,0-.45,0-.67,0a4.44,4.44,0,0,0-.65.08,5.27,5.27,0,0,0-.6.14,4,4,0,0,0-.52.18,2.5,2.5,0,0,0-.43.23,2.09,2.09,0,0,0-.32.25,1.22,1.22,0,0,0-.2.28.75.75,0,0,0-.06.29.72.72,0,0,0,.06.29,1,1,0,0,0,.2.28,1.72,1.72,0,0,0,.32.26,2.86,2.86,0,0,0,.43.23,4.41,4.41,0,0,0,.52.19,4.68,4.68,0,0,0,.59.13c.21,0,.43.07.65.09s.45,0,.67,0,.45,0,.67,0a4.44,4.44,0,0,0,.65-.08,5.27,5.27,0,0,0,.6-.14,3.52,3.52,0,0,0,.52-.18,3.45,3.45,0,0,0,.43-.22,3,3,0,0,0,.32-.26,1,1,0,0,0,.2-.28.75.75,0,0,0,.06-.29.72.72,0,0,0-.06-.29,1,1,0,0,0-.2-.28,1.72,1.72,0,0,0-.32-.26,2.73,2.73,0,0,0-.42-.23,3.66,3.66,0,0,0-.53-.18,3.4,3.4,0,0,0-.59-.14c-.21,0-.43-.07-.65-.09S127.26,224.93,127,224.93Z" transform="translate(-123.58 -216.21)"/>
							<path class="cls-5" d="M140.89,225c-.23,0-.45,0-.68,0l-.64.08-.6.14a5.24,5.24,0,0,0-.52.18,2.86,2.86,0,0,0-.43.23,1.72,1.72,0,0,0-.32.26,1,1,0,0,0-.2.28.72.72,0,0,0-.06.29.79.79,0,0,0,.06.29,1,1,0,0,0,.2.28,2.12,2.12,0,0,0,.31.26,3.45,3.45,0,0,0,.43.22c.16.07.34.13.52.19l.6.14c.21,0,.43.07.65.09l.67,0c.23,0,.45,0,.67,0s.44,0,.65-.09a5.29,5.29,0,0,0,.6-.13c.18-.06.36-.12.52-.19a2.48,2.48,0,0,0,.43-.22,2.13,2.13,0,0,0,.32-.26,1,1,0,0,0,.19-.28.59.59,0,0,0,.07-.29.62.62,0,0,0-.07-.29.93.93,0,0,0-.19-.28,1.72,1.72,0,0,0-.32-.26,2.87,2.87,0,0,0-.43-.22,3.52,3.52,0,0,0-.52-.19,5.27,5.27,0,0,0-.6-.14,6.17,6.17,0,0,0-.64-.09C141.34,225,141.11,225,140.89,225Z" transform="translate(-123.58 -216.21)"/>
							<path class="cls-6" d="M123.59,221.6l20.76.05v2.16l-20.75-.05Z" transform="translate(-123.58 -216.21)"/>
						</svg>
					</a>
				</h1>
				<?php
			$simple_pleasures_description = get_bloginfo( 'description', 'display' );
			if ( $simple_pleasures_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $simple_pleasures_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'simple-pleasures' ); ?></span>
				<div class="nav-icon">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
