<?php
/*
Plugin Name: NIAS WooCommerce Merge
Description: Custom modifications for WooCommerce checkout process.
Version: 1.0
Author: Your Name
Text Domain: nias-woo-merge
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin path
define( 'NIAS_WOO_MERGE_PATH', plugin_dir_path( __FILE__ ) );

// Include custom files
include_once NIAS_WOO_MERGE_PATH . 'review-order.php';
include_once NIAS_WOO_MERGE_PATH . 'form-checkout.php';

// Hook to WooCommerce checkout process or any relevant hook
// For example, to override WooCommerce templates, you might need to use WooCommerce hooks
// Uncomment and adjust the following code as needed:

 add_filter( 'wc_get_template', 'nias_woo_merge_override_templates', 10, 2 );
 function nias_woo_merge_override_templates( $located, $template_name ) {
     if ( 'checkout/review-order.php' === $template_name ) {
         $located = NIAS_WOO_MERGE_PATH . 'review-order.php';
     } elseif ( 'checkout/form-checkout.php' === $template_name ) {
         $located = NIAS_WOO_MERGE_PATH . 'form-checkout.php';
     }
     return $located;
 }
?>
