<section id="posts-section">
    <div class="row">
        <h3><span>Recent Posts</span></h3>
        <div class="blog-slider">
            <?php
            $atQuery = new WP_Query(
                    array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
                    )
            );
            //print_r($cwwp_query);
            if ($atQuery->have_posts()) :
                while ($atQuery->have_posts()) :
                    $atQuery->the_post();
                    ?>
                    <div class="large-4 medium-6 columns" data-aos="fade" data-aos-duration="800">
                        <div class="list-wrapper">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" class="featured-image">
                                <?php the_post_thumbnail('content-grid'); ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </a>
                            <h4 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h4>
                            <a class="button" href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

