<?php if ( ! defined( 'WPINC' ) ) { die;}

/** Wordpress Admin custom Notifications

=========== How To Use thsi notice in my custom Theme or plugin?===============

 Step-1: Just Include the 'plugin.php' to use as to plugin notices.
	Example ===== include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

2nd Step: Include the our custom notice Class 
Example ===== require_once plugin_dir_path( __FILE__ ) . 'inc/your_class_file_name.php';

Just Make sure that you have included the class with your theme or plugin 

============= Call the notification functions any where  ==================

Example Use below : >>>>>>>>>>>>>>>>>>>>>>


add_action('admin_init', function() {

echo '<style>.update-nag, .updated { display: none; }</style>'; // Hide default wp notice.


we have 4 types of notifications function that just need to call with Paranmeters .


Syntax :  wp_simple_notices_add_info($message_string );


	wp_simple_notices_add_info('are really');  // just pass one string as a parameter

	wp_simple_notices_add_success('easy to');
	wp_simple_notices_add_warning('easy to');
	wp_simple_notices_add_error('easy to');


=============================== End instractions =========================================
 * Class Wp_Simple_Notes_Admin_Notices
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
 */

class Wp_Simple_Notes_Admin_Notices
{
    const NOTICES_OPTION_KEY = 'wp_backend_notices_key';

    public static function init()
    {
        add_action('admin_notices', [__CLASS__, 'echo_notices']);

    }

    /**
     * Checks for any stored notices and outputs them. Hooked to admin_notices action.
     */
    public static function echo_notices()
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
 public function __construct() {

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

Wp_Simple_Notes_Admin_Notices::init();

function wp_simple_notices_add_success($message)
{
    Wp_Simple_Notes_Admin_Notices::add_success($message);
}

function wp_simple_notices_add_error($message)
{
    Wp_Simple_Notes_Admin_Notices::add_error($message);
}

function wp_simple_notices_add_warning($message)
{
    Wp_Simple_Notes_Admin_Notices::add_warning($message);
}

function wp_simple_notices_add_info($message)
{
    Wp_Simple_Notes_Admin_Notices::add_info($message);
}