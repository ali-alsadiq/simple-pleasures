<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Simple_Pleasures
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function simple_pleasures_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'simple_pleasures_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function simple_pleasures_woocommerce_scripts() {
	wp_enqueue_style( 'simple-pleasures-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'simple-pleasures-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'simple_pleasures_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function simple_pleasures_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'simple_pleasures_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function simple_pleasures_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'simple_pleasures_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'simple_pleasures_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function simple_pleasures_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'simple_pleasures_woocommerce_wrapper_before' );

if ( ! function_exists( 'simple_pleasures_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function simple_pleasures_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'simple_pleasures_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'simple_pleasures_woocommerce_header_cart' ) ) {
			simple_pleasures_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'simple_pleasures_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function simple_pleasures_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		simple_pleasures_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'simple_pleasures_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'simple_pleasures_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function simple_pleasures_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'simple-pleasures' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'simple-pleasures' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'simple_pleasures_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function simple_pleasures_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php simple_pleasures_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Will make the Bookings calender default to the month with the first available booking.
 */
add_filter( 'wc_bookings_calendar_default_to_current_date', '__return_false' );


/**
 * Will change the minutes it takes an In Cart booking to expire.
 * This example reduces the number from 60 to 30.
 * 
 * @param  int $minutes 60 is the default passed
 * @return int          The amount of minutes you'd like to have In Cart bookings expire on. 
 */
function change_incart_bookings_expiry_minutes_20170825( $minutes ) {
	return 30;
}
add_filter( 'woocommerce_bookings_remove_inactive_cart_time', 'change_incart_bookings_expiry_minutes_20170825' );

/**
 * Will put bookings into a Confirmed status if they were paid for via COD.
 * 
 * @param int $order_id The order id
 */
function set_cod_bookings_confirmed_20170825( $order_id ) {
	
	// Get the order, then make sure its payment method is COD.
	$order = wc_get_order( $order_id );
	if ( 'cod' !== $order->get_payment_method() ) {
		return;
	}
	// Call the data store class so we can get bookings from the order.
	$booking_data = new WC_Booking_Data_Store();
	$booking_ids  = $booking_data->get_booking_ids_from_order_id( $order_id );
	// If we have bookings go through each and update the status.
	if ( is_array( $booking_ids ) && count( $booking_ids ) > 0 ) {
		foreach ( $booking_ids as $booking_id ) {
			$booking = get_wc_booking( $booking_id );
			$booking->update_status( 'confirmed' );
		}
	}
}
add_action( 'woocommerce_order_status_processing', 'set_cod_bookings_confirmed_20170825', 20 );

/**
 * Will make it so the Dependencies tab shows on a Bookable product. 
 * 
 * @param array $tabs The list of tabs in a product's settings.
 */
function add_bookable_product_to_dependencies( $tabs ) {
	// Check to see if the class exists and if the tab is set.
	if ( class_exists( 'WC_Product_Dependencies' ) && isset( $tabs['dependencies'] ) ) {
		// If so, add our class for the JS hooks.
		$tabs['dependencies']['class'][] = 'show_if_booking';
	}
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'add_bookable_product_to_dependencies', 999 );


/**
 * Will make it so that the date format when the calendar is not used is DD/MM/YYYY on a Bookable product. 
 */
add_filter( 'woocommerce_bookings_mdy_format' , '__return_false' );


/* WooCommerce - extends woocommerce checkout field editor */
/* adds additional display areas (Admin edit user screen and WooCommerce WebHooks */
/**
* add custom checkout fields to user profile on admin edit screen
*
* @param mixed $payload
*/
function filter_woocommerce_admin_profile__custom_checkout_fields( $payload ) {
    if ( class_exists( 'WC_Checkout_Field_Editor' ) ) {
        $fieldgroups = array( 'billing'=>'billing', 'shipping'=>'shipping', 'additional'=>'additional' );
        foreach ($fieldgroups as $fieldgroup => $payload_group) {
            $fakeorder = new WC_Order();
            foreach (wc_get_custom_checkout_fields($fakeorder , array( $fieldgroup ) ) as $field_name => $field_options )  {
                //basic validation, is the field enabled
                if ( !isset($field_options['enabled'] ) || ( $field_options['enabled'] != true ) )
                    continue;
                //is the field for profile
                if ( (!isset($field_options['display_options']) ) || ( !is_array($field_options['display_options'])) || ( !in_array('profile', $field_options['display_options'])) )
                    continue;
                //passed all checks, add to payload
                /*'fields' => array(
                        'billing_first_name' => array(
                            'label'       => __( 'First name', 'woocommerce' ),
                            'description' => ''
                        ),*/
                $payload_value = array(
                    'label'       => $field_options['label'],
                    'description' => ''
                );
                if ($field_options['type'] == 'select') {
                   $payload_value['type'] = 'select';
                   $payload_value['options'] = $field_options['options'];
                }
                $payload[$payload_group]['fields'][$field_name] = $payload_value;
            }
        }
        return $payload;
    }
};
/**
* filter add for above function
*/
add_filter( 'woocommerce_customer_meta_fields', 'filter_woocommerce_admin_profile__custom_checkout_fields', 10, 1 );
/**
* filter action to add custom checkout fields to the webhook payload
*
* @param mixed $payload
* @param mixed $resource
* @param mixed $resource_id
* @param mixed $this_id
*/
function filter_woocommerce_webhook_payload__custom_checkout_fields( $payload, $resource, $resource_id, $this_id ) {
    if ( class_exists( 'WC_Checkout_Field_Editor' ) ) {
        $fieldgroups = array( 'billing'=>'billing_address', 'shipping'=>'shipping_address', 'additional'=>'additional' );
        if ($resource != 'order' || empty($resource_id)) {
            return $payload;
        }
        $order = wc_get_order( $resource_id );
        foreach ($fieldgroups as $fieldgroup => $payload_group) {
            foreach (wc_get_custom_checkout_fields($order , array( $fieldgroup ) ) as $field_name => $field_options )  {
                //basic validation, is the field enabled
                if ( !isset($field_options['enabled'] ) || ( $field_options['enabled'] != true ) )
                    continue;
                //is the field for webhooks
                if ( (!isset($field_options['display_options']) ) || ( !is_array($field_options['display_options'])) || ( !in_array('webhook', $field_options['display_options'])) )
                    continue;
                //passed all checks, add to payload
                $payload_value = get_post_meta( $resource_id, $field_name, true );
                $payload['order'][$payload_group][$field_name] = $payload_value;
                if ( is_array($payload['order']) ) {
                    $payload['order']['customer'][$payload_group][$field_name] = $payload_value;
                }
            }
        }
        return $payload;
    }
};
/**
* filter add for above function
*/
add_filter( 'woocommerce_webhook_payload', 'filter_woocommerce_webhook_payload__custom_checkout_fields', 10, 4 );
/**
* filter action to add "profile" and "webhook" to selectable display options in custom options editing screen
*
* @param mixed $options
*/
function filter_woocommerce_custom_checkout_display_options__customer_checkout_fields_profile($options) {
    $options['profile']  = __( 'Admin Profile', 'woocommerce-checkout-field-editor' );
    $options['webhook']  = __( 'Webhooks', 'woocommerce-checkout-field-editor' );
    return $options;
}
/**
* filter add for above function
*/
add_filter ('woocommerce_custom_checkout_display_options', 'filter_woocommerce_custom_checkout_display_options__customer_checkout_fields_profile', 10, 1);


/**
 * Product Bunddle Plugin Snippet
 * Description: Use this snippet to prevent Product Bundles from displaying bundle prices in range format.
 */ 
add_filter( 'woocommerce_bundle_force_old_style_price_html', '__return_true' );

/**
 * Product Bunddle Plugin Snippet
 * Description: Prevents Product Bundles from displaying aggregated item subtotals in cart/order templates. Requires v5.5+.
 */ 
add_filter( 'woocommerce_bundles_group_mode_options_data', 'sw_pb_group_mode_options_data' );

function sw_pb_group_mode_options_data( $data ) {
	$data[ 'parent' ][ 'features' ] = array( 'parent_item', 'child_item_indent' );
	return $data;
}

add_filter( 'woocommerce_bundles_optional_bundled_item_suffix', 'wc_pb_remove_optional_suffix', 10, 3 );