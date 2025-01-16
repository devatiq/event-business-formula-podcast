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

use EBFP\Frontend\Elementor\Configurations;

class Frontend
{
    protected $configuration;
    public function __construct()
    {
        $this->init();
       
    }

   public function init()
    {
        $this->configuration = Configurations::instance();
        $this->configuration->init();
    }


}