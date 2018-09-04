<?php
/**
 * Testimonials
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header();
?>
<header class="page-header">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="page-title"><?php echo apply_filters('jobify_testimonial_page_title', post_type_archive_title('', false)); ?></h1>
        </div>
    </div>
</header>

<div id="primary">
    <div class="row">
        <div id="content" class="medium-8 columns" role="main">
            <div class="blog-archive">        

                <?php
                // WP_Query arguments
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'testimonial',
                    'testimonial-category' => 'testimonials',
                    'posts_per_page' => '10',
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'paged' => $paged
                );

// The Query
                $query = new WP_Query($args);

// The Loop
                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?> 
                        <article class="hentry">
                            <div class="entry">
                                <h3 class="entry-title"><a><?php the_title(); ?></a></h3>
                                    <?php echo get_the_date(); ?>
                                <div class="entry-summary">
        <?php the_content(); ?>

                                </div>
                            </div>
                            <header class="entry-header">
                                <div class="entry-author">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('thumbnail');
                                    } else {
                                        echo '<img src="' . get_bloginfo('stylesheet_directory') . '/images/thumbnail-default.jpg" />';
                                    }
                                    ?>
                                </div>

                                <div class="entry-meta">
        <?php get_template_part('parts/content', 'share'); ?>



                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->
                        </article>        

                        <?php
                    }
                } else {
                    // no posts found
                }
                ?>
                <?php
                if (function_exists("pagination")) {
                    pagination($custom_query->max_num_pages);
                }
                ?>
<?php
// Restore original Post Data
wp_reset_postdata();
?>
            </div><!-- #content -->
        </div>
        <div id="blog-sidebar" class="medium-4 columns">
<?php get_sidebar('widget-area-blog'); // sidebar 2; ?>        
        </div>
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>