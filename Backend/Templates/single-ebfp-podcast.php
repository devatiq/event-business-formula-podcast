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
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>
        </div>
        <div class="ebfp-podcast-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
