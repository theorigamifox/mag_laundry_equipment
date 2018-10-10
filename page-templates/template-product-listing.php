<?php
/**
 * Template Name: Mag Product Listing
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
    <section id="product-listing">
        <div class="row">
            <div class="large-12 columns">
                <?php
                $productListTitle = get_field('product_list_title');
                $termtypes = get_field('term_selection');
                $taxonomy = 'product-type';
                usort($termtypes, function($a, $b) use ($taxonomy) {
                    return get_field('sort_order', $taxonomy . '_' . $a->term_id) - get_field('sort_order', $taxonomy . '_' . $b->term_id);
                });
                if ($productListTitle): echo "<h2><span>" . $productListTitle . "</span></h2>";
                endif;

                foreach ($termtypes as $termtype):
                    $_posts = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'id',
                                'terms' => $termtype,
                            ),
                        ),
                        'orderby' => 'menu_order',
                        'order' => 'DESC'
                    ));

                    if ($_posts->have_posts()) :
                        $thumbnail = get_field('category_image', $termtype->taxonomy . '_' . $termtype->term_id);
                        //print_r($_posts);
                        ?>
                        <section class="product-type">
                            <div class="product-list clearfix">
<!--                                <div class="product-image">
                                    <img src="<?php echo $thumbnail['sizes']['medium']; ?>">
                                </div>-->
                                <div class="product-description">
                                        <h3><a href="<?php echo $termtype->slug; ?>"><span><?php echo $termtype->name; ?></span></a></h3>
            <?php echo $termtype->description; ?>
                                </div>
                                <ul class="product-titles">
            <?php while ($_posts->have_posts()) : $_posts->the_post(); ?>
                                        <li>
                                            <div class="product-quick-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
                                            <p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Primer <?php the_title(); ?></a></p>
                                            <p><a href="<?php the_permalink();?>" class="button">View full product</a></p>
                                        </li>
            <?php endwhile; ?>
                                </ul>
                            </div>
                        </section>
                        <?php
                    endif;
                    wp_reset_postdata();
                endforeach;
//                    
                ?>
            </div>
        </div>
    </section>
    <?php
endwhile;
?>
<div id="callout-container">
    <div class="row">
        <div class="large-12 columns">
<?php dynamic_sidebar('widget-area-front-page'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>