<?php
/**
 * Simple Pleasures functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simple_Pleasures
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'simple_pleasures_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function simple_pleasures_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Simple Pleasures, use a find and replace
		 * to change 'simple-pleasures' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'simple-pleasures', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'simple-pleasures' ),
				'footer' => esc_html__( 'Footer Menu Location', 'simple-pleasures' ),
				'social' => esc_html__( 'Social Menu Location', 'simple-pleasures' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'simple_pleasures_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		
	}
endif;
add_action( 'after_setup_theme', 'simple_pleasures_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simple_pleasures_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simple_pleasures_content_width', 640 );
}
add_action( 'after_setup_theme', 'simple_pleasures_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simple_pleasures_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'simple-pleasures' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'simple-pleasures' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'simple_pleasures_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simple_pleasures_scripts() {
	wp_enqueue_style( 'simple-pleasures-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'simple-pleasures-style', 'rtl', 'replace' );
	wp_enqueue_script( 'simple-pleasures-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'simple-pleasures-map', get_template_directory_uri() . '/js/GoogleMap.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'filter-menu', get_template_directory_uri() . '/js/FilterMenu.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simple_pleasures_scripts' );


function all_products_query( $q ){
    $q->set( 'posts_per_page', -1 );
}
add_action( 'woocommerce_product_query', 'all_products_query' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

// google map
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDXU6_wZx41DZOvkdj43kMwKXIvX-4XyvU';
	return $api;
	}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//Disable block editor on Home Page
function sp_post_filter( $use_block_editor, $post ) {
    $page_ids = array( 85 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'sp_post_filter', 10, 2 );

//https://learnwoo.com/easily-remove-sale-badge-on-your-woocommerce-store/
add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
	function lw_hide_sale_flash(){
	return false;
}

remove_action( 'woocommerce__main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


function my_login_logo() {
	?>
	<style>
		.admin-login{
			transform: scale(2.5);
			position: absolute;
			top: 10vh;
			right:49%;
			left:auto;
			@media only screen and (min-width: 800px) {
			transform: scale(3.5);
			}
		}
		#login h1{
			display: none;
		}
		#loginform{
			margin-top:140px;
		}
		#wp-submit{
			background-color:#cb7a00;
		}
		.cls-1{fill:none;}
		.cls-2{clip-path:url(#clip-path);}
		.cls-3{fill:#cb7a00;}
		.cls-4{clip-path:url(#clip-path-2);}
		.cls-5{fill:#828800;}
		.cls-6{fill:#dc6700;}
		.site-url-name{
			text-align: center;
		}
		a{
			text-decoration: none;
			position: relative;
			top: 150px;
			font-size: 1.25rem;
		}
	</style>

		<div class='site-url-name' >
			<a href="<?php echo get_home_url(); ?>">Simple Pleasures</a>
		</div>

			<svg class='admin-login'id="Layer_1" data-name="Layer 1" height='18px' width='25px' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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

	<?php
}
add_action('login_enqueue_scripts','my_login_logo');