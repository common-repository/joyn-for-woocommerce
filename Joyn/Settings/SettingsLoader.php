<?php

namespace Joyn\Settings;

use Joyn\Api\JoynApiClient;
use Joyn\Core\BaseLoader;
use Joyn\Util\JpAdminNotices;
use Joyn\Util\Logger;

class SettingsLoader extends BaseLoader
{
    private Settings $settings;
    private JoynApiClient $client;

    public function __construct()
    {
        $this->settings = new Settings();
        $this->client = new JoynApiClient();
    }

    function load() {
        Logger::write_log("SettingsLoader::load");
        $this->load_menu();
        add_action('admin_init',  array($this, 'register_settings'));
        add_action('add_option_' . Settings::API_KEY,  array($this, 'added_option'), 10, 2);
        add_action('update_option_' . Settings::API_KEY,  array($this, 'updated_option'), 10, 3);
    }

    private function load_menu() {
        Logger::write_log("SettingsLoader::load_menu");
        add_options_page('Joyn', 'Joyn', 'manage_options', 'joyn', array($this, 'load_view'));
    }

    function added_option($option, $value) {
        if ($option !== Settings::API_KEY) {
            return;
        }
        $this->updated_option('', $value, $option);
    }

    function updated_option($old_value, $value, $option) {
        if ($option !== Settings::API_KEY) {
            return;
        }
        $this->check_api_key($value);
    }

    function register_settings() {
        Logger::write_log("SettingsLoader::register_settings");
        $this->settings->register_all_settings();
    }

    function load_view() {
        Logger::write_log("SettingsLoader::load_view");
        $this->load_view_file(plugin_dir_path(__FILE__), 'SettingsView.php');
    }

    function check_api_key($api_key) {
        $result = $this->client->is_valid_api_key();
        $this->show_message(!$result);
    }

    private function show_message($is_error) {
        $message = translate($this->get_message($is_error), wp_joyn_wc_txt_domain());
        if ($is_error) {
            JpAdminNotices::add_error($message);
        } else {
            JpAdminNotices::add_info($message);
        }
    }

    private function get_message($is_error) {
        return $is_error ? $this->get_error_message() : $this->get_success_message();
    }

    private function get_error_message() {
        return "API Key invalid. Try again.";
    }

    private function get_success_message() {
        return "Link active.";
    }
}