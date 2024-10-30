<?php

namespace Joyn\Api;

abstract class AbstractJsonClient {
    private $base_url;
    private $token_scheme;

    public function __construct($base_url, $token_scheme = 'Bearer')
    {
        $this->base_url = $base_url;
        $this->token_scheme = $token_scheme;
    }

    protected function get($url, $token, $data = null) {
        return $this->json_call("GET", $token, $url, $data);
    }

    protected function post($url, $token, $data = null) {
        return $this->json_call("POST", $token, $url, $data);
    }

    protected function put($url, $token, $data = null) {
        return $this->json_call("PUT", $token, $url, $data);
    }

    protected function delete($url, $token, $data = null) {
        return $this->json_call("DELETE", $token, $url, $data);
    }

    protected function construct_url($endpoint) {
        return $this->base_url . $endpoint;
    }

    private function json_call($method, $token, $url, $data)
    {
        // add_action( 'http_api_debug',array($this, 'debug_http'),10,5);
        $arguments = $this->get_arguments($method, $token, $data);
        $response = wp_remote_request($url, $arguments);
        if ($this->has_unhandle_error($response)) {
            return null;
        }
        return $this->get_body($response);
    }

    private function get_arguments($method, $token, $data) {
        $arguments = array(
            "method" => $method,
            "headers" => $this->get_headers($token)
        );
        if (!is_null($data)) {
            $arguments["body"] = $data;
        }
        return $arguments;
    }

    private function get_body($response) {
        $result = wp_remote_retrieve_body($response);
        return $this->decode_json_response($result);
    }

    private function has_unhandle_error($response) {
        if (is_wp_error($response)) {
            return true;
        }
        if (wp_remote_retrieve_response_code($response) == 401) {
            return true;
        }
        return false;
    }

    private function get_headers($token) {
        return array(
            'Authorization' => $this->token_scheme . ' ' . $token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        );
    }

    private function decode_json_response($response) {
        return json_decode($response, true);
    }

    function debug_http( $response, $response_test, $class, $args, $url ){
        echo '<h2>HTTP API DEBUG</h2>';
        echo '<h3>Response</h3>';
        echo '<pre>';
        var_dump($response);
        echo '</pre>';
        echo '<h3>Transport used</h3>';
        echo '<pre>';
        var_dump($class);
        echo '</pre>';
        echo '<h3>http arguments</h3>';
        echo '<pre>';
        var_dump($args);
        echo '</pre>';

        return $response;
    }
}