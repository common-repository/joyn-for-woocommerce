<?php

namespace Joyn\Core;

abstract class BaseLoader
{
    abstract function load();

    protected function load_view_file($base_directory, $file_name, $data = array()) {
        if ($this->wc_include_exists()) {
            $this->use_wc_include($base_directory, $file_name, $data);
        } else {
            $this->regular_include($base_directory, $file_name);
        }
    }

    private function wc_include_exists(): bool {
        return function_exists('wc_get_template');
    }

    private function use_wc_include($base_directory, $file_name, $data = array()) {
        wc_get_template(
            $file_name,
            $data,
            '',
            $base_directory
        );
    }

    private function regular_include($base_directory, $file_name) {
        $file_path = $base_directory . $file_name;
        include $file_path;
    }
}