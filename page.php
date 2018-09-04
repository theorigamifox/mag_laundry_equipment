<?php
/**
 * Single Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>


    <div id="primary">
        <div class="row">
            <div id="content" class="large-12 columns" role="main">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php get_template_part('content', 'page'); ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>

<?php endwhile; ?>
<?php get_footer(); ?>