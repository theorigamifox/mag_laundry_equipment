<?php
/**
 * Single Parts
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
            <div id="content" class="large-12 columns">
                <div id="product_meta">
                    <?php
                    $terms = get_the_terms($post->ID, 'part-brand');
                    foreach ($terms as $term) {
                        $image = get_field('category_image', $term);
                        echo "<img src='" . $image . "' alt='" . $term->name . "'>";
                    }
                    ?>
                    <h1>Commercial Washing Machines</h1>
                    <h2><?php the_title(); ?></h2>

                    <?php $terms = get_the_terms($post->ID, 'part-tag'); ?>
                    <?php
                    if ($terms != "") {
                        echo "<p>";
                        foreach ($terms as $term) {
                            $image = get_field('category_image', $term);
                            echo "<a href='" . get_bloginfo('url') . '/part-tag/' . $term->slug . "'>" . $term->name . "</a> ";
                        }
                        echo "</p>";
                    }
                    ?>
                </div>

                <div class="product-title clearfix">
                    <?php
                    $terms = get_the_terms($post->ID, 'part-type');
                    foreach ($terms as $term) {
                        echo "<span>" . $term->name . "</span>";
                    }
                    ?>
                    <h2 class="parts-title"><?php the_title(); ?></h2>
                </div>
                <div class="row">
                    <div class="large-8 columns">
                        <div class="entry-summary">
                            <table id="part-info">
                                <tr>
                                    <td width="25%">Part Title</td>
                                    <td width="75%">
                                        <?php the_title(); ?>
                                    </td>
                                </tr>
                                <?php if (get_the_content() != "") { ?>
                                    <tr>
                                        <td>Part Description</td>
                                        <td><?php the_content(); ?></td>
                                    </tr>
                                <?php }; ?>
                                <tr>
                                    <td>Part Number</td>
                                    <td><?php the_field('sku'); ?></td>
                                </tr> 
                                 <?php if (get_field('machine_compatible') != "") { ?>
                                <tr>
                                    <td>Machine Compatible</td>
                                    <td><?php the_field('machine_compatible'); ?></td>
                                </tr>        
                                 <?php };?>
                                <tr>
                                    <td>Part Price</td>
                                    <td><p class="part-price"><?php the_field('part_price'); ?><br>
                                            <strong>(Postage subject to service, location and weight)</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Warranty</td>
                                    <td><p><span style="color: #ff0000;">ALL PARTS COME WITH A FULL 12 MONTHS WARRANTY </span></p></td>
                                </tr>  
                            </table>
                            <p class="order-now">To order call our parts department 08000 288 525 or fill in the form below.</p>
                        </div>
                        </article><!-- #post -->
                    </div>
                    <div class="large-4 columns prod-image">
                        <?php if (is_singular() || has_post_thumbnail()) : ?>
                            <a href="<?php the_post_thumbnail_url('full'); ?>" data-rel="prettyPhoto[product-gallery]">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div id="product-quote" class="large-8 columns">
                        <?php echo do_shortcode('[gravityform id="4" name="Get a Quote" title="true" description="false" ajax="true"]'); ?>
                    </div>
                    <div class="large-4 columns">
                        <div id="downloads">
                            <h4>Share this product</h4>
                            <?php get_template_part('parts/content', 'share'); ?>
                            <div class="clear"></div>      
                        </div>
                    </div>
                </div>
            </div>
            <!-- #content -->
        </div>
    </div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer(); ?>