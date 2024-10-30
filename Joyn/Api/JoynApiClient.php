<?php


namespace Joyn\Api;


use Joyn\Api\QRCode\QRCodeRequestBody;
use Joyn\Api\QRCode\QRCodeResponse;
use Joyn\Core\Constants;
use Joyn\Settings\Settings;

class JoynApiClient extends AbstractJsonClient
{
    const BASE_URL = Constants::BASE_URL;
    const TOKEN_SCHEME = Constants::TOKEN_SCHEME;

    private Settings $settings;

    public function __construct()
    {
        $this->settings = new Settings();
        parent::__construct(self::BASE_URL, self::TOKEN_SCHEME);
    }

    function is_valid_api_key() {
        return $this->get_qr_code(1, date('YmdHis')) != null;
    }

    function get_qr_code($amount, $transaction_reference): ?QRCodeResponse {
        $api_key = $this->settings->get_api_key();
        $url = $this->construct_url('/tokens');
        $request = new QRCodeRequestBody($amount, $transaction_reference);
        $response = $this->post($url, $api_key, $request->to_json());
        if (is_null($response)) {
            return null;
        }
        return QRCodeResponse::create($response);
    }
}