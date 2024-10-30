<?php

namespace Joyn\QRCode;

use Joyn\Api\JoynApiClient;
use Joyn\Core\BaseLoader;
use Joyn\Settings\Settings;
use Joyn\Util\Logger;

class QRCodeLoader extends BaseLoader
{
    private Settings $settings;
    private JoynApiClient $api_client;

    public function __construct()
    {
        $this->settings = new Settings();
        $this->api_client = new JoynApiClient();
    }

    function load() {
        Logger::write_log("QRCodeLoader::load");
        $this->register_actions();
    }

    private function register_actions() {
        Logger::write_log("QRCodeLoader::register_actions");
        if ($this->settings->show_qr_on_order()) {
            // Load QR-code after the customer details on the order details.
            // We want the default view to be loaded first, which has priority 10, so our priority needs to be > 10
            add_action('woocommerce_view_order', array($this, 'load_in_order'), 15, 1);
        }
        if ($this->settings->show_qr_on_thank_you()) {
            // We want the default view to be loaded first, which has priority 10, so our priority needs to be > 10
            add_action('woocommerce_thankyou', array($this, 'load_in_order'), 15, 1);
        }
        if ($this->settings->show_qr_on_email()) {
            // Load QR-code in email from the order.
            // We want the default view to be loaded first, which has priority 10 or 20, so our priority needs to be > 20
            add_action('woocommerce_email_customer_details', array($this, 'load_email_view'), 25, 4);
        }
    }

    /**
     * @param WC_Order $order
     * @param $sent_to_admin
     * @param $plain_text
     * @param $email
     */
    function load_email_view($order, $sent_to_admin, $plain_text, $email) {
        $response = $this->get_qr_code($order);
        if (is_null($response)) {
            $this->load_view(null);
            return;
        }
        $this->load_view($response->getQrCodeUrl(), $response->getPoints());
    }

    /**
     * @param int $order_id
     */
    function load_in_order($order_id) {
        $order = wc_get_order( $order_id );
        $response = $this->get_qr_code($order);
        if (is_null($response)) {
            $this->load_view(null);
            return;
        }
        $this->load_view($response->getQrCodeUrl(), $response->getPoints());
    }

    private function get_qr_code($order) {
        $id = $order->get_id();
        $total = $order->get_total();
        return $this->api_client->get_qr_code($total, $id);
    }

    private function load_view($qr_code_url, $points) {
        Logger::write_log("QRCodeLoader::load_view");
        $data = $this->get_view_data($qr_code_url, $points);
        $this->load_view_file(plugin_dir_path(__FILE__), 'QRCodeView.php', $data);
    }

    private function get_view_data($qr_code_url, $points) {
        return [
            'qr_code_url' => $qr_code_url,
            'points' => $points,
        ];
    }

}