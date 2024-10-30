<?php


namespace Joyn\Core;


class TranslationsLoader extends BaseLoader
{

    function load()
    {
        add_action( 'init', array($this, 'load_correct_language_translation') );
    }

    function load_correct_language_translation() {
        $domain = Constants::DOMAIN;
        $mo_file = WP_LANG_DIR . '/plugins/' . $domain . '-' . get_locale() . '.mo';
        load_textdomain( $domain, $mo_file );
        load_plugin_textdomain( $domain, false, $domain . '/languages' );
    }
}