=== Swiss 5-cent Rounding ===
Contributors: swissplugins
Donate link:
Tags: woocommerce, swiss, switzerland, rounding, 5 cents, vat, discount, discounts
Requires at least: 4.6
Tested up to: 5.5
Requires PHP: 5.6
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Swiss 5-cent Rounding allows you to easily apply rounding to the nearest 0.05 interval for discount and VAT amounts in your WooCommerce shop.

== Description ==

Switzerland is one of a few countries where 1- and 2-cent coins are not legal tender anymore. Therefore, all prices and totals must be rounded to the nearest interval of 0.05 Swiss Francs ("5-Rappen-Rundung", see also [Wikipedia](https://en.wikipedia.org/wiki/Cash_rounding#Rounding_with_0.05_or_5_intervals)).

When enabled, **Swiss 5-cent Rounding for WooCommerce** automatically rounds all calculated discount amounts from discount vouchers and VAT amounts in your online shop.

### REQUIREMENTS

This plugin requires a working installation of **WordPress** with everybody's favorite shop plugin **WooCommerce**.

### PLUGIN SETTINGS

The plugin offers two settings which you can edit by navigating to WooCommerce -> Settings -> Swiss Rounding:

* Round discount amounts (enable/disable)
* Round VAT amounts (enable/disable)

By default both options are enabled, and the plugin will quietly round all discount and VAT amounts in the cart, checkout and order emails correctly to the nearest interval of 0.05.

There are no restrictions, you can use this plugin in any country and with any currency.

The usage of this plugin is totally free.

== Installation ==

### MINIMUM REQUIREMENTS

* WordPress 4.6 or newer (latest version recommended)
* WooCommerce 2.6 or newer (latest version recommended)
* PHP 5.6 or newer (latest version recommended, the plugin supports PHP 7.4)

### AUTOMATIC INSTALLATION

We recommend installing and activating Swiss 5-cent Rounding through the WordPress backend. Please install WooCommerce before installing our plugin.

== Changelog ==
= 1.1.0 =
* Shipping tax rounding.
* WC 4.7.0 compatibility check.

= 1.0.1 =
* Recalculate TAX rounding fix.
= 1.0.0 =
* Initial push.
