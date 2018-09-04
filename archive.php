<?php
/**
 * Archives
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header();
?>
<header class="page-header">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="page-title">
                <?php if (is_day()) : ?>
                    <?php printf(__('Daily Archives: %s', 'jobify'), '<span>' . get_the_date() . '</span>'); ?>
                <?php elseif (is_month()) : ?>
                    <?php printf(__('Monthly Archives: %s', 'jobify'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'jobify')) . '</span>'); ?>
                <?php elseif (is_year()) : ?>
                    <?php printf(__('Yearly Archives: %s', 'jobify'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'jobify')) . '</span>'); ?>
                <?php elseif (is_author()) : ?>
                    <?php the_post(); ?>
                    <?php printf(__('Author: %s', 'jobify'), '<span class="vcard">' . get_the_author()); ?>
                    <?php rewind_posts(); ?>
                <?php elseif (is_tax() || is_category() || is_tag()) : ?>
                    <?php single_term_title(); ?>
                <?php else : ?>
                    <?php _e('Blog Archives', 'jobify'); ?>
                <?php endif; ?>
            </h1>
        </div>
    </div>
</header>
<div id="primary">
    <div class="row">
        <div id="content" role="main">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('medium-4 columns'); ?>>
                        <header class="entry-header">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image">
                                <?php the_post_thumbnail('content-grid'); ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </a>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                        </header><!-- .entry-header -->
                    </article><!-- #post -->                    <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; ?>
        </div><!-- #content -->
        <?php do_action('jobify_loop_after'); ?>
    </div><!-- #primary -->
</div>

<?php get_footer(); ?>