<?php 
namespace EBFP\Backend\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Assets class for handling admin assets.
 *
 * This class is responsible for registering and enqueuing the necessary
 * JavaScript and CSS files required for the admin area.
 *
 * @package EBFP\Backend\Assets
 * @since 1.0.0
 */
class Assets {
 
    /**
     * Initializes the Assets class.
     *
     * This method defines the constants required by the class and hooks into the
     * 'wp_enqueue_scripts' action to enqueue the necessary JavaScript and CSS files.
     *
     * @since 1.0.0
     */
   public function __construct() {
        $this->define_constants();
        add_action('wp_enqueue_scripts', [$this, 'ebfp_enqueue_scripts']);

    }

    /**
     * Enqueues the necessary JavaScript and CSS files for the admin area.
     *
     * This function enqueues the JavaScript file 'ebfp-load-more.js' and
     * localizes the 'ebfpAjax' script with the AJAX URL and a nonce.
     *
     * @since 1.0.0
     */
   public function ebfp_enqueue_scripts() {
        wp_enqueue_script('ebfp-load-more', EBFP_BACKEND_ASSETS_URL . 'js/ebfp-load-more.js', ['jquery'], '1.0', true);
    
        wp_localize_script('ebfp-load-more', 'ebfpAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ebfp_load_more_nonce'),
        ]);
    }
    

    /**
     * Defines constants used in the Assets class.
     *
     * This method defines two constants: EBFP_BACKEND_ASSETS_PATH and
     * EBFP_BACKEND_ASSETS_URL. These constants are used to refer to the
     * plugin's path and URL, respectively, in the admin area.
     *
     * @since 1.0.0
     */
    public function define_constants() {
         // Define Plugin Path.
         define('EBFP_BACKEND_ASSETS_PATH', plugin_dir_path(__FILE__));

         // Define Plugin URL.
         define('EBFP_BACKEND_ASSETS_URL', plugin_dir_url(__FILE__));
    }
       
    
}