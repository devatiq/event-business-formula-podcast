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

class Backend
{

    protected $podcast;
    protected $podcast_metabox;

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
    }

}
