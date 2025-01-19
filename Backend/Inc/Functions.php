<?php
/**
 * Functions.php
 *
 * This file contains the functions for the plugin that are used in the admin area.
 *
 * @package EBFP\Backend\Inc
 * @since 1.0.0
 */
namespace EBFP\Backend\Inc;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Class Functions
 *
 * Handles the functions used in the admin area.
 *
 * @package EBFP\Backend\Inc
 * @since 1.0.0
 */

class Functions{
    /**
     * Constructor for the Functions class.
     *
     * This method hooks into WordPress to register AJAX actions for loading more podcasts.
     * It sets up AJAX handlers for both logged-in and non-logged-in users.
     *
     * @since 1.0.0
     */

    public function __construct()
    {
        add_action('wp_ajax_load_more_podcasts', [$this, 'load_more_podcasts']);
        add_action('wp_ajax_nopriv_load_more_podcasts', [$this, 'load_more_podcasts']);
        add_filter('single_template', [$this, 'ebfp_load_custom_single_template']);
    }

    /**
     * Handles the AJAX request for loading more podcasts.
     *
     * This function verifies the request nonce, gets the current page number
     * and the number of posts per page, and then queries for the next page of
     * podcasts. If there are more posts, it renders the next page of podcasts
     * and returns the HTML and a flag indicating whether there are more posts.
     * If there are no more posts, it returns a JSON error response.
     *
     * @since 1.0.0
     */
   public function load_more_podcasts() {
        check_ajax_referer('ebfp_load_more_nonce', 'nonce'); // Security check
    
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $posts_per_page = 12;
    
        $podcast_query = new \WP_Query([
            'post_type' => 'ebfp_podcast',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
        ]);
    
        if ($podcast_query->have_posts()) {
            ob_start(); 
    
            while ($podcast_query->have_posts()) : $podcast_query->the_post(); ?>
                <!-- Single Podcast -->
                <div class="ebfp-podcast-grid-item">
                    <div class="ebfp-podcast-single-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="Podcast Thumbnail">
                        </a>
                    </div>
                    <div class="ebfp-podcast-grid-item-content">
                        <h3 class="ebfp-podcast-grid-item-content-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
            <?php endwhile;
    
            $html = ob_get_clean(); // Get the buffer content and clear it
            $more_posts = $paged < $podcast_query->max_num_pages;
    
            wp_send_json_success([
                'html' => $html,
                'more' => $more_posts,
            ]);
        } else {
            wp_send_json_error(['more' => false]);
        }
    
        wp_reset_postdata();
        wp_die();
    }    
        
    public function ebfp_load_custom_single_template($single_template) {
        global $post;
    
        if ($post->post_type === 'ebfp_podcast') {
            $plugin_template = EBFP_ADMIN_PATH . 'Templates/single-ebfp-podcast.php';
    
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
    
        return $single_template;
    }  
    
}