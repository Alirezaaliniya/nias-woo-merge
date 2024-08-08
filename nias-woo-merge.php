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

function my_plugin_override_woocommerce_templates( $template, $template_name, $template_path ) {
    $plugin_path = plugin_dir_path( __FILE__ ) . 'woocommerce/';

    // بررسی اینکه آیا تمپلیت درخواست شده با یکی از تمپلیت‌های پلاگین هم‌خوانی دارد
    if ( file_exists( $plugin_path . $template_name ) ) {
        $template = $plugin_path . $template_name;
    }

    return $template;
}

add_filter( 'woocommerce_locate_template', 'my_plugin_override_woocommerce_templates', 10, 3 );
