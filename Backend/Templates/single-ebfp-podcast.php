<?php
/**
 * Template for single Podcast posts.
 *
 * @package EventBusinessFormula
 */

get_header();

$author_id = get_post_field('post_author', get_the_ID());
$facebook_url = get_the_author_meta('facebook', $author_id);
$x_url = get_the_author_meta('x', $author_id);

?>

<div class="ebfp-podcast-single-page-area">
    <div class="ebfp-podcast-single-page">
        <!-- Podcast Heading -->
        <div class="ebfp-podcast-single-heading">
            <h2 class="ebfp-podcast-title"><?php the_title(); ?></h2>
        </div><!--/ Podcast Heading -->
        <!-- Podcast Info -->
        <div class="ebfp-podcast-single-info ebfp-container">
            <div class="ebfp-podcast-author">                
                <div class="ebfp-author-image">
                    <?php echo get_avatar($author_id, 100); ?>
                </div>
                <div class="ebfp-author-name">By
                    <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                        <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                    </a>
                </div>
            </div>
            <div class="ebfp-podcast-date">
                <?php echo get_the_date('F j, Y'); ?>
            </div>
        </div><!--/ Podcast Info -->

        <!-- Podcast Thumbnail -->
        <div class="ebfp-podcast-thumbnail ebfp-container">
            <?php if (has_post_thumbnail()): ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div><!--/ Podcast Thumbnail -->
        <!-- Podcast Player -->
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

        </div><!--/ Podcast Player -->
        <!-- Podcast Content -->
        <div class="ebfp-podcast-content ebfp-container">
            <?php the_content(); ?>
        </div><!--/ Podcast Content -->

        <!--Podcast Author -->
        <div class="ebfp-podcast-footer-author-area ebfp-container">
            <div class="ebfp-podcast-footer-author">
                <div class="ebfp-podcast-author-image">                    
                    <?php echo get_avatar($author_id, 250); ?>
                    <div class="ebfp-podcast-author-social">
                    <?php if ($facebook_url): ?>
                        <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer">
                            <svg class="ebfp-facebook" version="1.1" id="fi_20837" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 155.139 155.139"
                                style="enable-background:new 0 0 155.139 155.139;" xml:space="preserve">
                                <g>
                                    <path id="f_1_" style="fill:#010002;" d="M89.584,155.139V84.378h23.742l3.562-27.585H89.584V39.184
        c0-7.984,2.208-13.425,13.67-13.425l14.595-0.006V1.08C115.325,0.752,106.661,0,96.577,0C75.52,0,61.104,12.853,61.104,36.452
        v20.341H37.29v27.585h23.814v70.761H89.584z"></path>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($x_url): ?>
                        <a href="<?php echo esc_url($x_url); ?>" target="_blank" rel="noopener noreferrer">
                            <svg id="fi_5969020" enable-background="new 0 0 1227 1227" viewBox="0 0 1227 1227"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m613.5 0c-338.815 0-613.5 274.685-613.5 613.5s274.685 613.5 613.5 613.5 613.5-274.685 613.5-613.5-274.685-613.5-613.5-613.5z">
                                    </path>
                                    <path
                                        d="m680.617 557.98 262.632-305.288h-62.235l-228.044 265.078-182.137-265.078h-210.074l275.427 400.844-275.427 320.142h62.239l240.82-279.931 192.35 279.931h210.074l-285.641-415.698zm-335.194-258.435h95.595l440.024 629.411h-95.595z"
                                        fill="#fff"></path>
                                </g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                                <g></g>
                            </svg>
                        </a>
                    <?php endif; ?>

                    </div>
                </div>
                <div class="ebfp-podcast-author-details">
                    <div class="ebfp-podcast-author-name">
                        <h4>About the author</h4>
                        <h2><?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></h2>
                    </div>
                    <div class="ebfp-podcast-author-description">
                        <p>For two decades, Eric Rozenberg has consulted with Fortune 500 companies and produced
                            conferences
                            in more than 50 countries across diverse industries. His focus is creating meetings that are
                            not
                            only breathtakingly memorable but which bring corporate strategies to life and amplify team
                            motivation/performance.</p>
                        <?php echo get_the_author_meta('description', $author_id); ?>
                    </div>
                </div>
            </div>
        </div><!--/ Podcast Author -->
    </div>
</div>

<?php get_footer(); ?>