<?php

namespace Joyn\Api\QRCode;


class QRCodeResponse
{
    private const AMOUNT_KEY = 'amount';
    private const EXPIRATION_DATE_KEY = 'expirationDate';
    private const POINTS_KEY = 'points';
    private const QR_CODE_URL_KEY = 'qrCodeUrl';
    private const SHOP_NAME_KEY = 'shopName';
    private const TOKEN_URL_KEY = 'tokenUrl';
    private const TRANSACTION_REFERENCE_KEY = 'transactionReference';
    private const VALIDITY_PERIOD_KEY = 'validityPeriod';

    private $amount;
    private $expiration_date;
    private $points;
    private $qr_code_url;
    private $shop_name;
    private $token_url;
    private $transaction_reference;
    private $validity_period;

    /**
     * QRCodeResponse constructor.
     * @param $amount
     * @param $expiration_date
     * @param $points
     * @param $qr_code_url
     * @param $shop_name
     * @param $token_url
     * @param $transaction_reference
     * @param $validity_period
     */
    private function __construct($amount, $expiration_date, $points, $qr_code_url, $shop_name, $token_url, $transaction_reference, $validity_period)
    {
        $this->amount = $amount;
        $this->expiration_date = $expiration_date;
        $this->points = $points;
        $this->qr_code_url = $qr_code_url;
        $this->shop_name = $shop_name;
        $this->token_url = $token_url;
        $this->transaction_reference = $transaction_reference;
        $this->validity_period = $validity_period;
    }

    static function create($data) {
        $amount = $data[self::AMOUNT_KEY];
        $expiration_date = $data[self::EXPIRATION_DATE_KEY];
        $points = $data[self::POINTS_KEY];
        $qr_code_url = $data[self::QR_CODE_URL_KEY];
        $shop_name = $data[self::SHOP_NAME_KEY];
        $token_url = $data[self::TOKEN_URL_KEY];
        $transaction_reference = $data[self::TRANSACTION_REFERENCE_KEY];
        $validity_period = $data[self::VALIDITY_PERIOD_KEY];
        return new QRCodeResponse(
            $amount,
            $expiration_date,
            $points,
            $qr_code_url,
            $shop_name,
            $token_url,
            $transaction_reference,
            $validity_period
        );
    }

    private static function array_has_all_keys($array): bool {
        $has_all_keys = true;
        foreach (self::get_all_keys() as $key) {
            $has_all_keys &= array_key_exists($key, $array);
        }
        return $has_all_keys;
    }

    private static function get_all_keys() {
        return [
            self::AMOUNT_KEY,
            self::EXPIRATION_DATE_KEY,
            self::POINTS_KEY,
            self::QR_CODE_URL_KEY,
            self::SHOP_NAME_KEY,
            self::TOKEN_URL_KEY,
            self::TRANSACTION_REFERENCE_KEY,
            self::VALIDITY_PERIOD_KEY
        ];
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expiration_date;
    }

    /**
     * @param mixed $expiration_date
     */
    public function setExpirationDate($expiration_date): void
    {
        $this->expiration_date = $expiration_date;
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points): void
    {
        $this->points = $points;
    }

    /**
     * @return mixed
     */
    public function getQrCodeUrl()
    {
        return $this->qr_code_url;
    }

    /**
     * @param mixed $qr_code_url
     */
    public function setQrCodeUrl($qr_code_url): void
    {
        $this->qr_code_url = $qr_code_url;
    }

    /**
     * @return mixed
     */
    public function getShopName()
    {
        return $this->shop_name;
    }

    /**
     * @param mixed $shop_name
     */
    public function setShopName($shop_name): void
    {
        $this->shop_name = $shop_name;
    }

    /**
     * @return mixed
     */
    public function getTokenUrl()
    {
        return $this->token_url;
    }

    /**
     * @param mixed $token_url
     */
    public function setTokenUrl($token_url): void
    {
        $this->token_url = $token_url;
    }

    /**
     * @return mixed
     */
    public function getTransactionReference()
    {
        return $this->transaction_reference;
    }

    /**
     * @param mixed $transaction_reference
     */
    public function setTransactionReference($transaction_reference): void
    {
        $this->transaction_reference = $transaction_reference;
    }

    /**
     * @return mixed
     */
    public function getValidityPeriod()
    {
        return $this->validity_period;
    }

    /**
     * @param mixed $validity_period
     */
    public function setValidityPeriod($validity_period): void
    {
        $this->validity_period = $validity_period;
    }


}