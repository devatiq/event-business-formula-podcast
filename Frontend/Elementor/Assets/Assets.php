<?php 
/**
 * Assets.php
 * Handles the frontend assets for the Elementor extension.
 *
 * This file contains the class `EBFP\Frontend\Elementor\Assets\Assets` which is responsible for
 * registering the frontend assets for the Elementor extension.
 *
 * @package EBFP\Frontend\Elementor\Assets
 * @since 1.0.0
 */
namespace EBFP\Frontend\Elementor\Assets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Assets class for handling frontend assets.
 *
 * This class is responsible for registering and enqueuing the necessary
 * JavaScript and CSS files required for the Elementor extension.
 *
 * @package EBFP\Frontend\Elementor\Assets
 * @since 1.0.0
 */

class Assets {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    public function register_assets() {
        wp_register_style('ebfp-style', EBFP_ELEMENTOR_ASSETS . '/css/style.css');
    }
}