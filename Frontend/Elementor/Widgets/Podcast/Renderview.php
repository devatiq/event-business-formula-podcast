<!-- Podcast Grid Area -->
<div class="ebfp-podcast-grid-area">
    <div class="ebfp-podcast-grid">
        <?php
        $podcast = new WP_Query([
            'post_type' => 'ebfp_podcast',
            'posts_per_page' => 4
        ]);

        if ($podcast->have_posts()):
            while ($podcast->have_posts()):
                $podcast->the_post();
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
        endif;
        ?>
    </div>

    <?php 
        if('yes' == $settings['load_more_button']) :
    ?>
    <!-- Load More Button -->
    <div class="ebfp-podcast-button">
        <a href="javascript:void(0);" class="ebfp-podcast-load-more">
            <?php echo esc_html__('Load More', 'event-business-formula'); ?>
        </a>
    </div><!--/ Load More Button -->
    <?php endif; ?>

</div><!--/ Podcast Grid Area -->