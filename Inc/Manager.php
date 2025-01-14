<?php
/**
 * Manager.php
 *
 * This file contains the Manager class, which is responsible for handling
 * the initialization of the required configurations and functionalities
 * for the Event Business Formula Podcast plugin.
 *
 * @package EBFP\Inc
 * @since 1.0.0
 */

namespace EBFP;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use EBFP\Backend\Backend;
use EBFP\Frontend\Frontend;

/**
 * The manager class for EBFP.
 *
 * This class handles the initialization of the required configurations and functionalities
 * for the Event Business Formula Podcast plugin. The class is responsible for setting up
 * the admin and frontend functionalities and registering the text domain.
 *
 * @package EBFP\Inc
 * @since 1.0.0
 */
class Manager
{
    protected $backend_manager;
    protected $frontend;

    /**
     * Constructor for the Manager class.
     *
     * This method initializes the EBFP Manager by calling the init method.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->init();
        $this->register_textdomain();
    }

    /**
     * Initialize the EBFP Manager.
     *
     * This method sets up the admin and frontend functionality.
     *
     * @since 1.0.0
     */
    public function init()
    {
        $this->backend_manager = new Backend();
        $this->frontend = new Frontend();
    }

    /**
     * Register the text domain for translation.
     *
     * This method loads the plugin's translated strings from the specified directory.
     *
     * @since 1.0.0
     */
    protected function register_textdomain()
    {
        load_plugin_textdomain('event-business-formula', false, dirname(plugin_basename(__DIR__, 2)) . '/languages');
    }
}