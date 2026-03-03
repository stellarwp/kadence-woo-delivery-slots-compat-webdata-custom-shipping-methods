<?php
/**
 * Plugin Name:     WooCommerce Delivery Slots by Kadence [WebData Custom Shipping Methods for WooCommerce]
 * Plugin URI:      https://iconicwp.com/products/woocommerce-delivery-slots/
 * Description:     Compatibility between WooCommerce Delivery Slots by Kadence and Custom Shipping Methods for WooCommerce by WebData.
 * Author:          Kadence
 * Author URI:      https://www.kadencewp.com/
 * Text Domain:     iconic-woo-delivery-slots-compat-shipping-pro
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Iconic_Woo_Delivery_Slots_Compat_Custom_Shipping_Webdata
 */

/**
 * Is Custom Shipping Methods for WooCommerce active?
 *
 * @return bool
 */
function iconic_compat_wb_custom_shipping_is_active() {
	return function_exists( 'WB_Custom_WooCommerce_Shipping_Method_Init' );
}


/**
 * Change format of the shipping method ID.
 *
 * @return array
 */
function iconic_compat_wb_custom_shipping_update_shipping_method_id( $shipping_method_options ) {
	if ( ! iconic_compat_wb_custom_shipping_is_active() ) {
		return $shipping_method_options;
	}

	$updated_shipping_method = array();

	foreach ( $shipping_method_options as $method_key => $method_name ) {
		if ( false !== strpos( $method_key, 'wb_custom_woocommerce_shipping_method:' ) ) {
			$method_key = str_replace( 'wb_custom_woocommerce_shipping_method:', 'WB_Custom_WooCommerce_Shipping_Method', $method_key );
		}

		$updated_shipping_method[ $method_key ] = $method_name;
	}

	return $updated_shipping_method;
}

add_filter( 'iconic_wds_shipping_method_options', 'iconic_compat_wb_custom_shipping_update_shipping_method_id', 10 );
