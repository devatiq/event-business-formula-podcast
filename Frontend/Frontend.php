<?php
/**
 * Frontend.php
 *
 * Handles the frontend-specific functionality for the plugin.
 *
 * @package EBFP\Frontend
 * @since 1.0.0
 */

namespace EBFP\Frontend;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Frontend
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
    }

    public function enqueue_frontend_scripts()
    {
       
    }
}