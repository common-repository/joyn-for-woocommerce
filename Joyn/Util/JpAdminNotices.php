<?php


namespace Joyn\Util;

use Joyn\Settings\Settings;

/**
 * Class JpAdminNotices
 *
 * Handles setting and displaying dismissible admin notices.
 *
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
 */
class JpAdminNotices
{
    const NOTICES_OPTION_KEY = Settings::ADMIN_NOTICES;

    public static function load()
    {
        add_action('admin_notices', [__CLASS__, 'output_notices']);
    }

    /**
     * Checks for any stored notices and outputs them. Hooked to admin_notices action.
     */
    public static function output_notices()
    {
        $notices = self::get_notices();
        if (empty($notices)) {
            return;
        }

        // Iterate over stored notices and output them.
        foreach ($notices as $type => $messages) {
            foreach ($messages as $message) {
                printf('<div class="notice notice-%1$s is-dismissible">
                    <p>%2$s</p>
                </div>',
                    $type,
                    $message
                );
            }
        }

        // All stored notices have been output. Update the stored array of notices to be an empty array.
        self::update_notices([]);
    }

    /**
     * Retrieves any stored notices.
     *
     * @return array|void
     */
    private static function get_notices()
    {
        $notices = get_option(self::NOTICES_OPTION_KEY, []);

        return $notices;
    }

    /**
     * Update the stored notices in the options table with a new array.
     *
     * @param array $notices
     */
    private static function update_notices(array $notices)
    {
        update_option(self::NOTICES_OPTION_KEY, $notices);
    }

    /**
     * Adds a notice to the stored notices to be displayed the next time the admin_notices action runs.
     *
     * @param $message
     * @param string $type
     */
    private static function add_notice($message, $type = 'success')
    {
        $notices = self::get_notices();

        $notices[$type][] = $message;

        self::update_notices($notices);
    }

    /**
     * Success messages are green
     *
     * @param $message
     */
    public static function add_success($message)
    {
        self::add_notice($message, 'success');
    }

    /**
     * Errors are red
     *
     * @param $message
     */
    public static function add_error($message)
    {
        self::add_notice($message, 'error');
    }

    /**
     * Warnings are yellow
     *
     * @param $message
     */
    public static function add_warning($message)
    {
        self::add_notice($message, 'warning');
    }

    /**
     * Info is blue
     *
     * @param $message
     */
    public static function add_info($message)
    {
        self::add_notice($message, 'info');
    }
}