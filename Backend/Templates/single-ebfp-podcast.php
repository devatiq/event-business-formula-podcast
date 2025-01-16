<?php
/**
 * Template for single Podcast posts.
 *
 * @package EventBusinessFormula
 */

get_header(); ?>

<div class="ebfp-podcast-single-page">
    <div class="container">
        <h1 class="ebfp-podcast-title"><?php the_title(); ?></h1>
        <div class="ebfp-podcast-thumbnail">
            <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
        <div class="ebfp-podcast-player">
            <?php
            // Retrieve the iframe code from the post meta
            $iframe_code = get_post_meta(get_the_ID(), '_ebfp_podcast_iframe_code', true);

            // Define allowed HTML tags and attributes
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

            // Output the iframe code, sanitized with wp_kses
            if (!empty($iframe_code)) {
                echo wp_kses($iframe_code, $allowed_html);
            } else {
                echo '<p>' . esc_html__('No embed code available for this podcast.', 'event-business-formula') . '</p>';
            }
            ?>

        </div>
        <div class="ebfp-podcast-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>