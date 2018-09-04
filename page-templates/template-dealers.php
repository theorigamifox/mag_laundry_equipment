<?php
/**
 * Template Name: Mag Dealers
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
                        'posts_per_page' => 10, //important for a PHP memory limit warning
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'id',
                                'terms' => $termtype,
                            ),
                        ),
                    ));

                    if ($_posts->have_posts()) :
                        $thumbnail = get_field('category_image', $termtype->taxonomy . '_' . $termtype->term_id);
                        //print_r($_posts);
                        ?>
                        <section class="product-type">
                            <div class="product-list clearfix">
                                <div class="product-image">
                                    <img src="<?php echo $thumbnail['sizes']['medium']; ?>">
                                </div>
                                <div class="product-description">
                                    <h3><!--<a href="<?php echo $termtype->slug; ?>">--><span><?php echo $termtype->name; ?></span><!--</a>--></h3>
                                    <ul class="product-titles">
                                        <?php
                                        while ($_posts->have_posts()) : $_posts->the_post();
                                            $spec_download = get_field('technical_specification_download');
                                            $brochure_download = get_field('brochure_download');
                                            $parts_download = get_field('parts_download');
                                            $operations_manual = get_field('operations_manual');
                                            $user_manual = get_field('user_manual');
                                            ?>
                                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                <ul>
                                                    <?php if ($brochure_download): ?><li><a href="<?php echo $brochure_download; ?>" target="_blank">Product Information</a></li><?php endif; ?>
                                                    <?php if ($spec_download): ?><li><a href="<?php echo $spec_download; ?>" target="_blank">Technical Specification</a></li><?php endif; ?>
                                                    <?php if ($parts_download): ?><li><a href="<?php echo $parts_download; ?>" target="_blank">Parts Manual</a></li><?php endif; ?>           
                                                    <?php if ($operations_manual): ?><li><a href="<?php echo $operations_manual; ?>" target="_blank">Operations Manual</a></li><?php endif; ?>    
                                                    <?php if ($user_manual): ?><li><a href="<?php echo $user_manual; ?>" target="_blank">User Manual</a></li><?php endif; ?>                                                                                                                                                            
                                                </ul></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>

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
$_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 10, //important for a PHP memory limit warning
    'cat' => 4190
        ));
if ($_posts->have_posts()) :
    ?>
    <section id="technical-updates">
        <div class="row">
            <div class="large-12 columns">
                <h3><span>Technical Updates</span></h3>
                <?php while ($_posts->have_posts()) : $_posts->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('medium-4 columns'); ?>>
                        <header class="entry-header">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image">
                                <?php the_post_thumbnail('content-grid'); ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </a>
                            <h4>
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h4>
                        </header><!-- .entry-header -->
                    </article><!-- #post -->      
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<div id="callout-container">
    <div class="row">
        <div class="large-12 columns">
            <?php dynamic_sidebar('widget-area-front-page'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>