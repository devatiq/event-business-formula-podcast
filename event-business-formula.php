<?php
/**
 * Plugin Name: Event Business Formula Podcast
 * Plugin URI: https://supreox.com
 * Description: A WordPress plugin for managing and displaying podcasts for the Event Business Formula.
 * Version: 1.0
 * Author: SupreoX Limited
 * Author URI: https://supreox.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: event-business-formula
 * Domain Path: /languages
 * Namespace: EBFP
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

final class EBFP_Plugin {

    // Singleton instance.
    private static $instance = null;

    /**
     * Initializes the EBFP plugin by defining constants, including necessary files, and initializing hooks.
     */
    private function __construct() {
        $this->define_constants();
        $this->include_files();
        $this->init_hooks();
    }

    /**
     * Retrieves the singleton instance of the plugin.
     *
     * @return EBFP_Plugin The singleton instance of the plugin.
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Defines plugin constants.
     */
    private function define_constants() {
        // Define Plugin Version.
        define('EBFP_VERSION', '1.0');

        // Define Plugin Path.
        define('EBFP_PATH', plugin_dir_path(__FILE__));

        // Define Plugin URL.
        define('EBFP_URL', plugin_dir_url(__FILE__));

        // Define Plugin Name.
        define('EBFP_NAME', esc_html__('Event Business Formula Podcast', 'event-business-formula'));

        // Define Plugin Basename.
        define('EBFP_BASENAME', plugin_basename(__FILE__));

        // Define Plugin File.
        define('EBFP_FILE', __FILE__);
    }

    /**
     * Includes necessary files.
     */
    private function include_files() {
        // Include Composer autoload if available.
        if (file_exists(EBFP_PATH . 'vendor/autoload.php')) {
            require_once EBFP_PATH . 'vendor/autoload.php';
        }
    }

    /**
     * Initializes hooks.
     */
    private function init_hooks() {
        add_action('plugins_loaded', array($this, 'plugin_loaded'));
        register_activation_hook(EBFP_FILE, array('EBFP\Activate', 'activate'));
        register_deactivation_hook(EBFP_FILE, array('EBFP\Deactivate', 'deactivate'));
    }

    /**
     * Called when the plugin is loaded.
     */
    public function plugin_loaded() {
        if (class_exists('EBFP\Manager')) {
            new \EBFP\Manager();
        }
    }
}

/**
 * Initializes the EBFP plugin.
 */
if (!function_exists('ebfp_initialize')) {
    function ebfp_initialize() {
        return EBFP_Plugin::get_instance();
    }

    ebfp_initialize();
}