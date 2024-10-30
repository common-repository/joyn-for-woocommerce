<?php


namespace Joyn\Settings;


class Settings
{
    // default values
    const SHOW_QR_DEFAULT = true;
    // Setting option keys
    const API_KEY = 'joyn_api_key';
    const SHOW_QR_THANK_YOU = 'joyn_show_on_thankyou';
    const SHOW_QR_ORDER = 'joyn_show_on_order';
    const SHOW_QR_MAIL = 'joyn_show_in_mail';
    const ADMIN_NOTICES = 'joyn_admin_notices';

    function get_api_key() {
        return get_option(self::API_KEY);
    }

    function show_qr_on_thank_you(): bool {
        $value = get_option(self::SHOW_QR_THANK_YOU, self::SHOW_QR_DEFAULT);
        return $this->to_boolean($value);
    }

    function show_qr_on_order(): bool {
        $value = get_option(self::SHOW_QR_ORDER, self::SHOW_QR_DEFAULT);
        return $this->to_boolean($value);
    }

    function show_qr_on_email(): bool {
        $value = get_option(self::SHOW_QR_MAIL, self::SHOW_QR_DEFAULT);
        return $this->to_boolean($value);
    }

    private function to_boolean($value): bool {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    function register_all_settings() {
        register_setting('joyn_plugin_settings', self::API_KEY);
        register_setting('joyn_plugin_settings', self::SHOW_QR_THANK_YOU);
        register_setting('joyn_plugin_settings', self::SHOW_QR_ORDER);
        register_setting('joyn_plugin_settings', self::SHOW_QR_MAIL);
    }
}