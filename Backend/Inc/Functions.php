<?php
namespace EBFP\Backend\Inc;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Functions.php
 *
 * This file contains the functions for the plugin.
 *
 * @package EBFP\Backend\Inc
 * @since 1.0.0
 */

class Functions
{
    public function __construct()
    {
        add_action('wp_ajax_load_more_podcasts', [$this, 'load_more_podcasts']);
        add_action('wp_ajax_nopriv_load_more_podcasts', [$this, 'load_more_podcasts']);
    }


    public function load_more_podcasts() {
        check_ajax_referer('ebfp_load_more_nonce', 'nonce'); // Security check
    
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
        $podcast_query = new \WP_Query([
            'post_type' => 'ebfp_podcast',
            'posts_per_page' => 4,
            'paged' => $paged,
        ]);
    
        if ($podcast_query->have_posts()) :
            while ($podcast_query->have_posts()) : $podcast_query->the_post();
                ?>
                <!--Single Podcast-->
                <div class="ebfp-podcast-grid-item">
                    <div class="ebfp-podcast-single-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="Podcast Thumbnail">
                        </a>
                    </div>
                    <div class="ebfp-podcast-grid-item-content">
                        <h3 class="ebfp-podcast-grid-item-content-title"><a
                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                </div><!--/ Single Podcast-->
                <?php
            endwhile;
        else:
            // No more posts
            echo '';
        endif;
    
        wp_reset_postdata();
        wp_die();
    }
    

}