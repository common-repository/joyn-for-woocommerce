<?php


namespace Joyn\Api\QRCode;


class QRCodeRequestBody
{
    private $amount;
    private $transaction_reference;

    function __construct($amount, $transaction_reference)
    {
        $this->amount = $amount;
        $this->transaction_reference = $transaction_reference;
    }

    function to_array() {
        return [
            'amount' => $this->amount,
            'transactionReference' => $this->transaction_reference
        ];
    }

    function to_json() {
        return json_encode($this->to_array());
    }
}