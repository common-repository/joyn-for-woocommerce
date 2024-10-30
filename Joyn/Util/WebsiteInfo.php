<?php


namespace Joyn\Util;


class WebsiteInfo
{
    static function get_domain_name() {
        $protocols = array('http://', 'http://');
        $invalid_subdomains = array("www.");
        $value = get_site_url();
        $value = str_replace($protocols, '', $value);
        $value = str_replace($invalid_subdomains, '', $value);
        return $value;
    }
}