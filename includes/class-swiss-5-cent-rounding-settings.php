<?php
if ( !defined('ABSPATH') ) {
    exit();
}

class Swiss_Rounding_Settings_Tab {

    /**
     * Add new settings tab in WooCommerce settings
     */
    public static function init() {
        add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
        add_action('woocommerce_settings_tabs_settings_tab_swiss_rounding', __CLASS__ . '::settings_tab');
        add_action('woocommerce_update_options_settings_tab_swiss_rounding', __CLASS__ . '::update_settings');
    }

    /**
     * Add a new settings tab to the WooCommerce settings tabs array.hp
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     *
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_tab_swiss_rounding'] = esc_html__('Swiss Rounding', 'swiss-5-cent-rounding');

        return $settings_tabs;
    }

    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields(self::get_settings());
    }

    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options(self::get_settings());
    }

    /**
     * Get all the settings for this plugin for @return array Array of settings for @see woocommerce_admin_fields() function.
     * @see woocommerce_admin_fields() function.
     *
     */
    public static function get_settings() {
        return [
            'section_title' => [
                'name' => esc_html__('Swiss Rounding Settings', 'swiss-5-cent-rounding'),
                'type' => 'title',
                'desc' => '',
                'id' => 'swiss_rounding_settings_title',
            ],
            'sr_round_discount_amounts' => [
                'name' => esc_html__('Round Discount Amounts', 'swiss-5-cent-rounding'),
                'css' => 'width:600px;height:200px',
                'type' => 'checkbox',
                'default' => 'yes',
                'desc' => esc_html__('Please check this box to enable the 5 cent rounding of discount amounts', 'swiss-5-cent-rounding'),
                'id' => 'sr_discount_price_rounding',
            ],
            'sr_round_vat_amounts' => [
                'name' => esc_html__('Round VAT Amounts', 'swiss-5-cent-rounding'),
                'css' => 'width:600px;height:200px',
                'type' => 'checkbox',
                'default' => 'yes',
                'desc' => esc_html__('Please check this box to enable the 5 cent rounding of VAT amounts', 'swiss-5-cent-rounding'),
                'id' => 'sr_vat_price_rounding',
            ],

            'section_end' => [
                'type' => 'sectionend',
                'id' => 'swiss_rounding_settings_section_end',
            ],
        ];

    }
}
