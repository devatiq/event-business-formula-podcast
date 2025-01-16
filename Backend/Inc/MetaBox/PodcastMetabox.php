<?php
/**
 * PodcastMetabox.php
 *
 * Handles the registration of a custom metabox for the 'podcast' post type.
 *
 * @package EBFP\Backend\Inc\MetaBox
 * @since 1.0.0
 */

namespace EBFP\Backend\Inc\MetaBox;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class PodcastMetabox
{
    /**
     * Constructor for the PodcastMetabox class.
     *
     * This method hooks into WordPress to register the metabox.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_metabox']);
        add_action('save_post', [$this, 'save_metabox_data']);
    }

    /**
     * Registers the metabox for the 'podcast' post type.
     *
     * @since 1.0.0
     */
    public function register_metabox()
    {
        add_meta_box(
            'ebfp_podcast_iframe',                         // Metabox ID
            __('Podcast Embed Code', 'event-business-formula'), // Metabox title
            [$this, 'render_metabox'],                     // Callback function to render the metabox
            'ebfp_podcast',                                // Post type
            'normal',                                      // Context (normal, side, advanced)
            'high'                                         // Priority
        );
    }

    /**
     * Renders the metabox HTML.
     *
     * @param WP_Post $post The current post object.
     *
     * @since 1.0.0
     */
    public function render_metabox($post)
    {
        // Retrieve the current value of the iframe code.
        $iframe_code = get_post_meta($post->ID, '_ebfp_podcast_iframe_code', true);

        // Add a nonce field for security.
        wp_nonce_field('ebfp_podcast_metabox_nonce', 'ebfp_podcast_nonce');

        // Render the input field.
        echo '<label for="ebfp_podcast_iframe_code">' . esc_html__('Enter the iframe embed code for the podcast:', 'event-business-formula') . '</label>';
        echo '<textarea id="ebfp_podcast_iframe_code" name="ebfp_podcast_iframe_code" rows="5" style="width: 100%;">' . esc_textarea($iframe_code) . '</textarea>';
    }

    /**
     * Saves the metabox data when the post is saved.
     *
     * @param int $post_id The ID of the current post.
     *
     * @since 1.0.0
     */
    /**
     * Saves the metabox data when the post is saved.
     *
     * @param int $post_id The ID of the current post.
     *
     * @since 1.0.0
     */
    public function save_metabox_data($post_id)
    {
        // Verify nonce.
        if (!isset($_POST['ebfp_podcast_nonce']) || !wp_verify_nonce($_POST['ebfp_podcast_nonce'], 'ebfp_podcast_metabox_nonce')) {
            return;
        }

        // Check if the current user has permission to edit the post.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check for auto-save.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check if the iframe code field is set.
        if (isset($_POST['ebfp_podcast_iframe_code'])) {
            // Define allowed HTML tags and attributes for iframe.
            $allowed_html = [
                'iframe' => [
                    'style' => [],
                    'title' => [],
                    'src' => [],
                    'width' => [],
                    'height' => [],
                    'scrolling' => [],
                    'allowfullscreen' => [],
                ],
            ];

            // Sanitize the iframe code using wp_kses.
            $iframe_code = wp_kses($_POST['ebfp_podcast_iframe_code'], $allowed_html);

            // Save the sanitized iframe code to post meta.
            update_post_meta($post_id, '_ebfp_podcast_iframe_code', $iframe_code);
        }
    }

}