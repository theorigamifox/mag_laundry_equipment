<?php
/**
 * Template Name: Mag Social
 */
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div id="primary">
        <div class="row">
            <div class="large-12 columns">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <section id="instagram">
        <div class="row">
            <div class="large-12 columns">
                <?php dynamic_sidebar('instagram-bar'); ?>
            </div>
        </div>
    </section>
    <section id="twitter-section">
        <div class="row">
            <div class="large-12 columns">
                <?php dynamic_sidebar('twitter-bar'); ?>
            </div>
        </div>
    </section>
    <?php get_template_part('parts/content', 'recent-posts'); ?>
<?php endwhile; ?>
<div id="callout-container">
    <div class="row">
        <div class="large-12 columns">
            <?php dynamic_sidebar('widget-area-front-page'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>