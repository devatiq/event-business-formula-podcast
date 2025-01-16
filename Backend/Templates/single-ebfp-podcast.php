<?php
/**
 * Template for single Podcast posts.
 *
 * @package EventBusinessFormula
 */

get_header(); ?>

<div class="ebfp-podcast-single-page-area">
    <div class="ebfp-podcast-single-page">
        <div class="ebfp-podcast-single-heading">
            <h2 class="ebfp-podcast-title"><?php the_title(); ?></h2>
        </div>
        <div class="ebfp-podcast-single-info ebfp-container">
            <div class="ebfp-podcast-author">
                <?php $author_id = get_post_field( 'post_author', get_the_ID() ); ?>
                <div class="ebfp-author-image">
                    <?php echo get_avatar( $author_id, 100 ); ?>
                </div>
                <div class="ebfp-author-name">By
                    <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"> 
                        <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?>
                    </a>
                </div>
            </div>
            <div class="ebfp-podcast-date">
                <?php echo get_the_date('F j, Y'); ?>
            </div>
        </div>
        <div class="ebfp-podcast-thumbnail ebfp-container">
            <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
        <div class="ebfp-podcast-player ebfp-container">
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
        <div class="ebfp-podcast-content ebfp-container">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>