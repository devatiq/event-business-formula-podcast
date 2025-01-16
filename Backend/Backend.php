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

class Backend
{

    protected $podcast;
    protected $podcast_metabox;
    protected $assets;
    protected $functions;

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
        $this->podcast = new Podcast();
        $this->podcast_metabox = new PodcastMetabox();
        $this->assets = new Assets();
        $this->functions = new Functions();
    }

}
