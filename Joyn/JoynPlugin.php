<?php

namespace Joyn;

use Joyn\Core\BaseLoader;
use Joyn\Core\Constants;
use Joyn\QRCode\QRCodeLoader;
use Joyn\Settings\SettingsLoader;
use Joyn\Util\JpAdminNotices;
use Joyn\Util\Logger;
use Joyn\Core\TranslationsLoader;

class JoynPlugin extends BaseLoader
{
    function load() {
        Logger::write_log("JoynPlugin::load");
        $this->load_settings_loader();
        $this->load_qrcode_loader();
        $this->load_admin_notices();
        $this->load_translations();
    }

    private function load_qrcode_loader() {
        $qrcode = new QRCodeLoader();
        $qrcode->load();
    }

    private function load_settings_loader() {
        Logger::write_log("JoynPlugin::register_actions");
        $settings = new SettingsLoader();
        add_action('admin_menu', array($settings, 'load'));
    }

    private function load_admin_notices() {
        JpAdminNotices::load();
    }

    private function load_translations() {
        $translation_loader = new TranslationsLoader();
        $translation_loader->load();
    }
}