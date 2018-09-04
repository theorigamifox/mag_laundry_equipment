<?php
/**
 * Archives
 *
 * @package Jobify
 * @since Jobify 1.0
 */
get_header();
?>
<div class="container" id="featured-products">
    <div class="row">
        <div id="part-header" class="large-12 columns">
        <div class="large-4 columns">
            <?php $catbrand = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );?>
            <img src="<?php the_field('category_image', $catbrand); ?>">
        </div>
        <div class="large-8 columns">
             <?php if (is_tax() || is_category() || is_tag()) : ?>
            <h2><?php single_term_title(); ?></h2>
            <?php else : ?>
                <?php _e('Part Type', 'jobify'); ?>
            <?php endif; ?>
            <?php if($cattype->description != ""){?>
            <p><?php echo $cattype->description;?></p>
            <?php };?>        </div>
        </div>
    </div>
    <div class="row">
        <div id="parts-selector" class="large-3 columns">
            <h3 class="heading-center-custom">Types</h3>

            <ul id="part-types">
                <?php
                $taxonomy = 'part-type';
                $orderby = 'name';
                $show_count = 0;      // 1 for yes, 0 for no
                $pad_counts = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title = '';
                $empty = 0;

                $args = array(
                    'taxonomy' => $taxonomy,
                    'orderby' => $orderby,
                    'order' => 'DESC',
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                $all_categories = get_categories($args);

                $filter_flag = false;
                ?>
                <?php foreach ($all_categories as $cat): ?>
                    <?php if ($cat): ?>
                        <?php $category_name = $cat->name; ?>
                        <?php $category_slug = $cat->slug; ?>
                        <?php $category_term = seoUrl($category_slug); ?>
                        <li>
                            <a href="<?php bloginfo('url');?>/part-type/<?php echo $category_term; ?>">
                                <span class="cat-img"><img src="<?php the_field('category_image', $cat); ?>" alt="<?php echo $category_name; ?>"></span>
                                <div><?php echo $category_name; ?></div></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <h3 class="heading-center-custom">Brands</h3>
            <ul id="parts-brands">
                <?php
                $taxonomy2 = 'part-brand';
                $orderby = 'name';
                $show_count = 0;      // 1 for yes, 0 for no
                $pad_counts = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title = '';
                $empty = 0;

                $args2 = array(
                    'taxonomy' => $taxonomy2,
                    'orderby' => $orderby,
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                $all_categories2 = get_categories($args2);

                $filter_flag = false;
                ?>
                <?php foreach ($all_categories2 as $cat2): ?>
                    <?php if ($cat2): ?>
                        <?php $category_name2 = $cat2->name; ?>
                        <?php $category_slug2 = $cat2->slug; ?>
                        <?php $category_term2 = seoUrl($category_slug2); ?>
                        <?php if (get_field('category_image', $cat2) != "") { ?>
                            <li>
                                <a href="<?php bloginfo('url');?>/part-brand/<?php echo $category_term2; ?>">
                                    <span class="cat-img">
                                        <img src="<?php the_field('category_image', $cat2); ?>" alt="<?php echo $category_name2; ?>"></span>
                                </a>
                            </li>
                        <?php }; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>            
        </div>
        <div class="large-9 columns">
            <?php if (have_posts()) : ?>
                <ul class="parts row">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part( 'content', 'parts'); ?>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; ?>
        </div>

    </div><!-- #content -->

    <?php do_action('jobify_loop_after'); ?>
</div><!-- #primary -->

<?php get_footer(); ?>