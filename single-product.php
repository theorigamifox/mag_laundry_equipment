<?php
/**
 * Single Products
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
        <header id="product-header">
            <div class="row">
                <div class="large-12 columns">
                    <h1><?php the_title(); ?></h1>
                    <?php
                    $terms = get_the_terms($post->ID, 'product-type');
                    if ($terms):
                        foreach ($terms as $term) {
                            echo "<h2>" . $term->name . "</h2>";
                        }
                    endif;
                    ?>
                    <div class="product-cta">
                        Call us on <a href="tel:08000 288 525">08000 288 525</a><br> or fill in the <a href="#productform">form below</a>
                    </div>
                </div>
            </div>
        </header>
        <section id="content">
            <div class="row">
                <?php
                $features = get_field('key_features');
                $options = get_field('options');
                $video_section = get_field('video_section');
                $brochure_download = get_field('brochure_download');
                $spec_download = get_field('technical_specification_download');
                $technical_data = get_field('techinical_specification');
                $brochure = get_field('brochure_embed');
                ?>
                <div class="large-5 columns right">
                    <div class="product-image-wrapper">
                        <div class="product-image">
                            <a href="<?php the_post_thumbnail_url('full'); ?>" rel="prettyPhoto[pp_gal]">
                                <?php the_post_thumbnail('full'); ?>
                            </a>
                        </div>

                        <?php if (have_rows('image_container')): ?>
                            <div class="product-extra-images">
                                <?php
                                while (have_rows('image_container')): the_row();
                                    ?>
                                    <ul>
                                        <?php
                                        $image1 = get_sub_field('image_1');
                                        $image2 = get_sub_field('image_2');
                                        $image3 = get_sub_field('image_3');
                                        $image4 = get_sub_field('image_4');
                                        if ($image1):
                                            ?>
                                            <li>
                                                <a href="<?php echo $image1['url']; ?>" rel="prettyPhoto[pp_gal]">
                                                    <img src="<?php echo $image1['sizes']['thumbnail']; ?>" alt="<?php echo $image1['alt']; ?>">
                                                </a>
                                            </li>
                                        <?php
                                        endif;
                                        if ($image2):
                                            ?>
                                            <li>
                                                <a href="<?php echo $image2['url']; ?>" rel="prettyPhoto[pp_gal]">
                                                    <img src="<?php echo $image2['sizes']['thumbnail']; ?>" alt="<?php echo $image2['alt']; ?>">
                                                </a>
                                            </li>
                                        <?php
                                        endif;
                                        if ($image3):
                                            ?>
                                            <li>
                                                <a href="<?php echo $image3['url']; ?>" rel="prettyPhoto[pp_gal]">
                                                    <img src="<?php echo $image3['sizes']['thumbnail']; ?>" alt="<?php echo $image3['alt']; ?>">
                                                </a>
                                            </li>
                                        <?php
                                        endif;
                                        if ($image4):
                                            ?>
                                            <li>
                                                <a href="<?php echo $image4['url']; ?>" rel="prettyPhoto[pp_gal]">
                                                    <img src="<?php echo $image4['sizes']['thumbnail']; ?>" alt="<?php echo $image4['alt']; ?>">
                                                </a>
                                            </li>
                                    <?php endif; ?>       
                                    </ul>
                            <?php endwhile;
                            ?>
                            </div>
        <?php
    endif;
    ?>
                    </div>
                </div>
                <div class="large-7 columns left">
                    <?php if(get_the_content()):?>
                    <div class="product-description">
                        <h3>Product Description</h3>
                        <?php the_content(); ?>
                    </div>
                    <?php endif;?>
                    <div class="key-features">
                        <h3>Key Features:</h3>
                        <?php echo $features; ?>
                    </div>
                    <div id="product-buttons">                              
    <?php if ($brochure_download): ?><a class="pdf-download" target="_blank" href="<?php echo $brochure_download; ?>"><i class="icon-down-circled"></i>Download <span>Brochure</span></a><?php endif; ?>
                    <?php if ($spec_download): ?><a class="pdf-download" target="_blank" href="<?php echo $spec_download; ?>"><i class="icon-down-circled"></i>Download <span>Technical Spec</span></a><?php endif; ?>
                    </div>
                    <!--                    <div class="options">
                                            <h3>Options:</h3>
    <?php //echo $options;      ?>
                                        </div>-->
                </div>
            </div>
        </section>
        <a id="productform"></a>
        <?php if($video_section):?>
        <section id="video-section">
            <div class="row">
                <div class="large-12 columns">
    <?php echo $video_section; ?>
                </div>
            </div>
        </section>
        <?php endif;?>
        <section id="brochure">
            <div class="row">
                <div class="large-12 columns"><h3>Get a quote for <?php the_title(); ?></div>
                <div class="large-5 columns">
                    <?php echo do_shortcode('[gravityform id=3 title=false description=false ajax=true tabindex=49]'); ?>
                </div>
                <div class="large-7 columns">
    <?php echo $brochure; ?>
                </div>
            </div>
        </section>
    </div>
    <!-- #content -->
<?php endwhile; ?>
<?php get_footer(); ?>