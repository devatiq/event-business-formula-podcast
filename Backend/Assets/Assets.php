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
 
   public function __construct() {
        $this->define_constants();
        add_action('wp_enqueue_scripts', [$this, 'ebfp_enqueue_scripts']);

    }

   public function ebfp_enqueue_scripts() {
        wp_enqueue_script('ebfp-load-more', EBFP_BACKEND_ASSETS_URL . 'js/ebfp-load-more.js', ['jquery'], '1.0', true);
    
        wp_localize_script('ebfp-load-more', 'ebfpAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ebfp_load_more_nonce'),
        ]);
    }
    

    public function define_constants() {
         // Define Plugin Path.
         define('EBFP_BACKEND_ASSETS_PATH', plugin_dir_path(__FILE__));

         // Define Plugin URL.
         define('EBFP_BACKEND_ASSETS_URL', plugin_dir_url(__FILE__));
    }
       
    
}