<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header();
?>
<header class="page-header">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="page-title"><?php echo get_option('page_for_posts') ? get_the_title(get_option('page_for_posts')) : _x('Blog', 'blog page title', 'jobify'); ?></h1>
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