<?php

/**
 * Homepay.pl Woocommerce payment module
 *
 * @author Homepay.pl
 *
 * Plugin Name: Homepay.pl Woocommerce payment module
 * Plugin URI: http://www.homepay.pl
 * Description: Brama płatności Homepay.pl do WooCommerce.
 * Author: Homepay.pl
 * Author URI: http://www.Homepay.pl
 * Version: 1.0 
 */

// ładuje plugin
add_action ( 'plugins_loaded', 'init_homepay_gateway' );
function init_homepay_gateway() {
	if (! class_exists ( 'WC_Payment_Gateway' ))
		return;
	
	include_once ('includes/class-woocommerce-homepay.php');
	
	add_filter ( 'woocommerce_payment_gateways', 'woocommerce_homepay_add_gateway' );
}
function woocommerce_homepay_add_gateway($methods) {
	$methods [] = 'WC_Gateway_Homepay';
	
	return $methods;
}

?>
