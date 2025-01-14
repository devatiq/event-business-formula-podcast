<?php
/**
 * Podcast.php
 *
 * This file contains the Podcast class for registering the custom post type 'podcast'.
 *
 * @package EBFP\Backend\Inc\CPT
 * @since 1.0.0
 */

namespace EBFP\Backend\Inc\CPT;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Podcast
{
    public function __construct()
    {
        add_action('init', [$this, 'register_podcast_post_type']);
    }

    /**
     * Registers the custom post type 'podcast'.
     *
     * @since 1.0.0
     */
    public function register_podcast_post_type()
    {
        $labels = [
            'name'               => __('Podcasts', 'event-business-formula'),
            'singular_name'      => __('Podcast', 'event-business-formula'),
            'menu_name'          => __('Podcasts', 'event-business-formula'),
            'add_new'            => __('Add New', 'event-business-formula'),
            'add_new_item'       => __('Add New Podcast', 'event-business-formula'),
            'edit_item'          => __('Edit Podcast', 'event-business-formula'),
            'new_item'           => __('New Podcast', 'event-business-formula'),
            'view_item'          => __('View Podcast', 'event-business-formula'),
            'all_items'          => __('All Podcasts', 'event-business-formula'),
            'search_items'       => __('Search Podcasts', 'event-business-formula'),
            'not_found'          => __('No podcasts found.', 'event-business-formula'),
            'not_found_in_trash' => __('No podcasts found in Trash.', 'event-business-formula'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'has_archive'        => true,
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest'       => true, // Enable Gutenberg editor
            'menu_icon'          => 'dashicons-microphone',
            'rewrite'            => ['slug' => 'podcast'],
        ];

        register_post_type('ebfp_podcast', $args);
    }
}