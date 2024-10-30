<?php
/*
Plugin Name: Joyn for WooCommerce
Plugin URI: https://www.joyn.be
Description: With the Joyn for WooCommerce plug-in, your customers can easily save Joyn points through your webshop.
Version: 1.0.0
Author: Joyn loyalty
License: GPL v2 or later
Text Domain: joyn-for-woocommerce
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( plugin_dir_path(__FILE__) . '/vendor/autoload.php');

use Joyn\JoynPlugin;
use Joyn\Util\Logger;
use Joyn\Util\WebsiteInfo;
use Joyn\Core\Constants;

function wp_joyn_wc_load_plugin() {
    $plugin = new JoynPlugin();
    $plugin->load();
}

function wp_joyn_wc_get_domain_name() {
    return WebsiteInfo::get_domain_name();
}

function wp_joyn_wc_txt_domain() {
    return Constants::DOMAIN;
}

Logger::write_log("load_plugin");
wp_joyn_wc_load_plugin();