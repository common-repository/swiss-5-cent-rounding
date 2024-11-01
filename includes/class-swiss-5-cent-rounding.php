<?php
if ( !defined('ABSPATH') ) {
    exit();
}

/**
 * main class to handle the functionalities of the plugin
 * Class Swiss_Rounding
 */
class Swiss_Rounding {
    public static $_instance;

    public function __construct() {
        $this->init_settings();
        $this->init_hooks();
    }

    /**
     * function to return the instance class
     * @return Swiss_Rounding
     */
    public static function instance() {
        if ( is_null(self::$_instance) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Init settings
     */
    private function init_settings() {
        require_once plugin_dir_path(SWISS_ROUNDING_FILE) . 'includes/class-swiss-5-cent-rounding-settings.php';
        Swiss_Rounding_Settings_Tab::init();
    }

    /**
     * Init hooks
     */
    private function init_hooks() {
        register_activation_hook(SWISS_ROUNDING_FILE, array($this, 'check_dependency'));

        add_action('plugins_loaded', array($this, 'load_text_domain'));
        add_filter('plugin_action_links_' . plugin_basename(SWISS_ROUNDING_FILE), array($this, 'plugin_action_links'), 99, 1);

        add_filter('woocommerce_calc_tax', array($this, 'round_tax_price'), 999, 2);
        add_filter('woocommerce_calc_shipping_tax', array($this, 'round_tax_shipping_price'), 99, 2);
        add_filter('woocommerce_coupon_get_discount_amount', array($this, 'round_discount_price'), 99, 1);
    }

    /**
     * Check the WooCommerce dependency
     */
    public function check_dependency() {
        if ( !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {

            // Throw an error in the wordpress admin console
            $error_message = __(sprintf('This plugin requires <a href="%s">WooCommerce </a>plugin to be active!', 'https://wordpress.org/plugins/woocommerce/'), 'swiss-5-cent-rounding');
            die($error_message);

        }
    }

    /**
     * Load text domain
     */
    public function load_text_domain() {

        load_plugin_textdomain('swiss-5-cent-rounding',
            '',
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/');
    }

    /**
     * Add plugin settings
     *
     * @param $actions
     * @return array
     */
    public function plugin_action_links( $actions ) {
        $new_actions = array(
            'settings' => '<a href="' . admin_url('admin.php?page=wc-settings&tab=settings_tab_swiss_rounding') . '" aria-label="' . esc_attr(__('View Swiss Rounding settings', 'swiss-5-cent-rounding')) . '">' . __('Settings', 'swiss-5-cent-rounding') . '</a>',
        );

        return array_merge($new_actions, $actions);
    }

    /**
     * Round the tax price
     * Interestingly WC sends the tax price differently for frontend tax calculation and "recalculate" in order edit page
     *
     * @param $taxes
     * @return mixed
     */
    public function round_tax_price( $taxes, $price ) {
        // If the setting is not enabled, return
        if ( get_option('sr_vat_price_rounding', '') == 'no' ) {
            return $taxes;
        }

        // Order Edit page, Tax recalculation
        if ( is_admin() ) {
            foreach ( $taxes as &$item ) {
                $item = round($item * 20, 0) / 20;
            }
        } else {
            // Normal cart calculation

            foreach ( $taxes as &$item ) {
                $item = round($item / 5) * 5;
            }
        }

        return $taxes;
    }

    /**
     * Round the shipping tax price
     *
     * @param $taxes
     * @return mixed
     */
    public function round_tax_shipping_price( $taxes ) {
        // If the setting is not enabled, return
        if ( get_option('sr_vat_price_rounding', '') == 'no' ) {
            return $taxes;
        }

        foreach ( $taxes as &$item ) {
            $item = round($item * 20, 0) / 20;
        }

        return $taxes;
    }

    /**
     * return rounding discount price
     *
     * @param $discount
     * @return float|int
     */
    public function round_discount_price( $discount ) {
        // if the setting is not enabled, return
        if ( get_option('sr_discount_price_rounding', '') == 'no' ) {
            return $discount;
        }
        return round($discount / 5, 2) * 5;
    }
}
