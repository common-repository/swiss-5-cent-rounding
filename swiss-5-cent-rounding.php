<?php
/*
Plugin Name: Swiss 5-cent Rounding
Description: Rounding of WooCommerce discounts and VAT amounts to 5 cents (0.05)
Author: swissplugins
Version: 1.1.0
Text Domain: swiss-5-cent-rounding
Domain Path: /languages
WC requires at least: 2.6
WC tested up to: 4.7.0
*/

if ( !defined('ABSPATH') ) {
    exit();
}

if ( !defined('SWISS_ROUNDING_FILE') ) {
    define('SWISS_ROUNDING_FILE', __FILE__);
}

require_once plugin_dir_path(__FILE__) . 'includes/class-swiss-5-cent-rounding.php';

/**
 * Instantiate the main class
 */
if ( class_exists('Swiss_Rounding') ) {
    Swiss_Rounding::instance();
}
