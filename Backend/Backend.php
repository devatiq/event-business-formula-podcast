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

use EBFP\Backend\Inc\CPT\Podcast;
use EBFP\Backend\Inc\MetaBox\PodcastMetabox;
use EBFP\Backend\Assets\Assets;
use EBFP\Backend\Inc\Functions;
use EBFP\Backend\Inc\UserProfile;

class Backend
{

    protected $podcast;
    protected $podcast_metabox;
    protected $assets;
    protected $functions;
    protected $user_profile;

    /**
     * Constructor for the Backend class.
     *
     * This method initializes the admin-specific functionality
     * by calling the init method.
     *
     * @since 1.0.0
     */

    public function __construct()    
    {
        $this->define_admin_constants();
        $this->init();       
    }
    /**
     * Initializes the admin functionality.
     *
     * @since 1.0.0
     */
    public function init()
    {
        $this->podcast = new Podcast();
        $this->podcast_metabox = new PodcastMetabox();
        $this->assets = new Assets();
        $this->functions = new Functions();
        $this->user_profile = new UserProfile();
    }

    /**
     * Define constants for the admin panel.
     *
     * @since 1.0.0
     */
    private function define_admin_constants()
    {
        define('EBFP_ADMIN_PATH', plugin_dir_path(__FILE__));
        define('EBFP_ADMIN_URL', plugin_dir_url(__FILE__));
    }


}
