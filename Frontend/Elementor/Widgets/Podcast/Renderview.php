<!-- Podcast Grid Area -->
<div class="ebfp-podcast-grid-area">
    <!--Grid Area -->
    <div class="ebfp-podcast-grid">
        <?php
        $post_per_page = isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 8;
        $podcast = new WP_Query([
            'post_type' => 'ebfp_podcast',
            'posts_per_page' => $post_per_page,
        ]);

        if ($podcast->have_posts()):
            while ($podcast->have_posts()):
                $podcast->the_post();
                ?>
                <!-- Single Podcast -->
                <div class="ebfp-podcast-grid-item">
                    <div class="ebfp-podcast-single-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        </a>
                    </div>
                    <div class="ebfp-podcast-grid-item-content">
                        <h3 class="ebfp-podcast-grid-item-content-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div><!--/ Grid Area-->

    <?php if('yes' == $settings['load_more_button']) : ?>
        <!--Button -->
        <div class="ebfp-podcast-button">
            <a href="javascript:void(0);" class="ebfp-podcast-load-more">
                <?php echo esc_html__('Load More', 'event-business-formula'); ?>
            </a>
        </div><!--/ Button -->

    <?php endif; ?>
</div><!--/ Podcast Grid Area-->
