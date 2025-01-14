<?php
/**
 * AdminManager.php
 *
 * Handles the admin-specific functionality for the plugin.
 *
 * @package EBFP\Backend
 * @since 1.0.0
 */

namespace EBFP\Backend;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use EBFP\Backend\Inc\CustomPostType;

class Backend
{

    protected $custom_post_type;

    public function __construct()    
    {
        $this->init();       
    }
    /**
     * Initializes the admin functionality.
     *
     * @since 1.0.0
     */
    public function init()
    {
        $this->custom_post_type = new CustomPostType();
    }

}
